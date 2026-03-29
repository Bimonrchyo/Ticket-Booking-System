<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Booking;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function create(Jadwal $jadwal)
    {
        $jadwal->load(['transportasi', 'asal', 'tujuan']);

        return view('user.detail-jadwal', compact('jadwal'));
    }

    public function checkout(Request $request, Jadwal $jadwal)
    {
        $request->validate([
            'seat' => 'required|string|max:5'
        ]);

        return view('user.checkout', [
            'jadwal' => $jadwal->load(['transportasi', 'asal', 'tujuan']),
            'seat' => $request->seat
        ]);
    }

    // 3. Fungsi Simpan Booking (Store)
    public function store(Request $request, Jadwal $jadwal)
    {
        $request->validate([
            'nomor_kursi' => 'required|string|max:5',
            'nama_penumpang' => 'required|string|max:255',
            'nik' => 'required|digits:16'
        ]);

        $booking = DB::transaction(function () use ($request, $jadwal) {

            $jadwalLocked = Jadwal::where('id', $jadwal->id)
                ->lockForUpdate()
                ->first();

            if ($jadwalLocked->stok_tersedia <= 0) {
                throw new \Exception('Stok habis');
            }

            $seatTaken = Booking::where('jadwal_id', $jadwalLocked->id)
                ->where('nomor_kursi', $request->nomor_kursi)
                ->exists();

            if ($seatTaken) {
                throw new \Exception('Kursi sudah dibooking');
            }

            $kodeBooking = 'HT-'.strtoupper(Str::random(8));

            $jadwalLocked->decrement('stok_tersedia');

            return Booking::create([
                'kode_booking' => $kodeBooking,
                'user_id' => Auth::id(),
                'jadwal_id' => $jadwalLocked->id,
                'nomor_kursi' => $request->nomor_kursi,
                'nama_penumpang' => $request->nama_penumpang,
                'expired_at' => now()->addMinutes(30),
                'nik' => $request->nik,
                'status' => 'pending',
                'qr_code_data' => $kodeBooking,
                'total_harga' => $jadwalLocked->harga
            ]);
        });

        return redirect()
            ->route('pembayaran', $booking->id)
            ->with('success', 'Booking berhasil, silakan bayar.');
    }

    public function uploadBukti(Request $request, Booking $booking)
    {
        $request->validate([
            'bukti_transfer' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048'
        ]);

        $path = $request->file('bukti_transfer')->store('bukti-transfer', 'public');

        // Tetapkan status payment ke pending, status booking tetap pending sampai diverifikasi admin
        $booking->update(['status' => 'pending']);

        $payment = $booking->payment;

        $data = [
            'metode_bayar' => 'transfer',
            'bukti_transfer' => $path,
            'nominal_bayar' => $booking->total_harga,
            'status' => 'pending',
            'payment_time' => now(),
            'verified_at' => null,
        ];

        if ($payment) {
            $payment->update($data);
        } else {
            $booking->payment()->create($data);
        }

        return back()->with('success', 'Bukti berhasil diupload. Menunggu verifikasi admin.');
    }

    public function konfirmasiPembayaran(Request $request, $id)
    {
        $request->validate([
            'bukti_transfer' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $booking = Booking::findOrFail($id);

        if ($request->hasFile('bukti_transfer')) {
            $path = $request->file('bukti_transfer')->store('bukti_pembayaran', 'public');

            $booking->update(['status' => 'pending']);

            $booking->payment()->updateOrCreate(
                ['pemesanan_id' => $booking->id],
                [
                    'metode_bayar' => 'transfer',
                    'bukti_transfer' => $path,
                    'nominal_bayar' => $booking->total_harga,
                    'status' => 'pending',
                    'payment_time' => now(),
                    'verified_at' => null,
                ]
            );
        }

        return redirect()->route('pembayaran.sukses')->with('success', 'Bukti berhasil dikirim! Menunggu verifikasi admin.');
    }
    // 4. Halaman Pembayaran (Instruksi Upload Bukti)
    public function payment(Booking $booking)
    {
        abort_if($booking->user_id !== Auth::id(), 403);

        $booking->load(['jadwal.transportasi', 'payment']);

        // Jika belum ada expired_at, buat baru (30 menit dari sekarang)
        if (! $booking->expired_at) {
            $booking->expired_at = now()->addMinutes(30);
            $booking->saveQuietly();
        }

        // Hitung sisa waktu: expired_at dikurangi waktu sekarang
        // diffInSeconds dengan parameter kedua 'false' agar menghasilkan angka negatif jika sudah lewat
        $timeLeft = now()->diffInSeconds($booking->expired_at, false);

        // Jika sudah lewat (negatif), set jadi 0
        $timeLeft = $timeLeft > 0 ? $timeLeft : 0;

        return view('user.pembayaran', compact('booking', 'timeLeft'));
    }

    public function paymentSuccess()
    {
        return view('user.pembayaran-sukses');
    }

    // Histori Pemesanan User
    public function history()
    {
        $histori = Booking::where('user_id', Auth::id())
            ->with(['jadwal' => function ($q) {
                $q->with(['transportasi', 'asal', 'tujuan']);
            }])
            ->latest()
            ->get();

        return view('user.riwayat', compact('histori'));
    }

    public function retryPayment(Booking $booking)
    {
        abort_if($booking->user_id !== Auth::id(), 403);

        // Hanya bisa diulang pada status rejected atau unpaid
        if (! in_array($booking->status, ['pending', 'canceled', 'rejected'])) {
            return redirect()->back()->with('error', 'Hanya pesanan dengan status pending/rejected/canceled dapat diulang pembayaran.');
        }

        $booking->update(['status' => 'pending']);

        if ($booking->payment) {
            $booking->payment->update(['status' => 'pending']);
        } else {
            $booking->payment()->create([
                'status' => 'pending',
                'metode_bayar' => 'transfer',
                'nominal_bayar' => $booking->total_harga,
                'payment_time' => now(),
            ]);
        }

        return redirect()->route('pembayaran', $booking->id)
            ->with('success', 'Pembayaran diulang. Silakan upload bukti lagi untuk diverifikasi.');
    }

    // Proses Cetak Tiket ke PDF
    public function printTicket(Booking $booking)
    {
        abort_if($booking->user_id !== Auth::id(), 403);
        abort_if($booking->status !== 'paid', 403);

        $booking->load(['jadwal.transportasi', 'user']);

        $pdf = Pdf::loadView('pdf.tiket-pdf', compact('booking'));

        return $pdf->download('Tiket-'.$booking->kode_booking.'.pdf');
    }

    // Proses Cetak Struk ke PDF
    public function printInvoice($id)
    {
        $booking = Booking::where('id', $id)
            ->where('user_id', Auth::id())
            ->with('payment', 'user')
            ->firstOrFail();

        $pdf = Pdf::loadView('pdf.invoice-pdf', compact('booking'));
        return $pdf->stream('Invoice-'.$booking->kode_booking.'.pdf');
    }
}