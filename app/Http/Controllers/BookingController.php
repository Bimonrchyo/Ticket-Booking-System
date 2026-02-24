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

    // 2. Fungsi Pencarian Jadwal
    public function search(Request $request, $type)
    {
        // Cari jadwal berdasarkan tipe transportasi, asal, dan tujuan
        $jadwals = Jadwal::whereHas('transportasi', function ($query) use ($type) {
            $query->where('tipe', $type);
        })
            ->where('titik_asal', 'like', "%{$request->asal}%")
            ->where('titik_tujuan', 'like', "%{$request->tujuan}%")
            ->where('stok_tersedia', '>', 0)
            ->with('transportasi')
            ->get();

        return view('user.pencarian', compact('jadwals', 'type'));
    }

    // 3. Fungsi Simpan Booking (Store)
    public function store(Request $request, $type)
    {
        $request->validate([
            'jadwal_id' => 'required',
            'nomor_kursi' => 'required',
        ]);

        DB::transaction(function () use ($request, $type) {
            $jadwal = Jadwal::where('id', $request->jadwal_id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($jadwal->stok_tersedia <= 0) {
                throw new \Exception('Stok habis');
            }

            $jadwal->decrement('stok_tersedia');

            Booking::create([
                'kode_booking' => $kodeBooking,
                'user_id' => auth('web')->id(),
                'jadwal_id' => $request->jadwal_id,
                'nomor_kursi' => $request->nomor_kursi,
                'total_harga' => $jadwal->harga,
                'status' => 'pending'
            ]);
        });

        return redirect()->route('pembayaran', $booking->id)->with('success', 'Booking berhasil, silakan bayar!');
    }

    // 4. Halaman Pembayaran (Instruksi Upload Bukti)
    public function payment($id)
    {
        $booking = Booking::with('jadwal.transportasi')->findOrFail($id);
        return view('user.pembayaran', compact('booking'));
    }
    // Histori Pemesanan User
    public function history()
    {
        $histori = Booking::where('user_id', auth('web')->id())
            ->with('jadwal.transportasi')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.riwayat', compact('histori'));
    }

    // Proses Cetak Tiket ke PDF
    public function printTicket($id)
    {
        $booking = Booking::with('jadwal.transportasi', 'user')->findOrFail($id);

        // Cek apakah sudah bayar
        abort_if($booking->user_id !== Auth::id(), 403);

        $pdf = Pdf::loadView('pdf.tiket-pdf', compact('booking'));
        return $pdf->download('Tiket-'.$booking->kode_booking.'.pdf');
    }

    // Proses Cetak Struk ke PDF
    public function printInvoice($id)
    {
        $booking = Booking::with('payment', 'user')->findOrFail($id);

        $pdf = Pdf::loadView('pdf.invoice-pdf', compact('booking'));
        return $pdf->stream('Invoice-'.$booking->kode_booking.'.pdf');
    }
}
