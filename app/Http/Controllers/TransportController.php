<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Booking;
use App\Models\Lokasi;
use App\Models\Transportasi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransportController extends Controller
{
    // --- BAGIAN TRANSPORTASI (ARMADA) ---

    public function index($type)
    {
        $data = Transportasi::where('tipe', $type)
            ->where('user_id', Auth::id())
            ->get();
        return view('admin.index', compact('data', 'type'));
    }

    public function create($type)
    {
        return view('admin.create', compact('type'));
    }

    public function store(Request $request, $type)
    {
        $request->validate([
            'nama_brand' => 'required|string|max:100',
            'kode_identitas' => 'required|string|max:50',
            'kapasitas' => 'required|integer|min:1',
            'seat_layout' => 'required|string',
            'fasilitas' => 'nullable|array'
        ]);

        $layouts = [
            'bus' => ['type' => 'bus', 'seats_per_row' => 4, 'left' => ['A', 'B'], 'right' => ['C', 'D'], 'aisle_after' => 2, 'rows' => 12, 'desc' => 'AKAP Standar 2-2'],
            'kereta' => ['type' => 'kereta', 'seats_per_row' => 4, 'left' => ['A', 'B'], 'right' => ['C', 'D'], 'aisle_after' => 2, 'rows' => 20, 'desc' => 'KAI Eksekutif 2-2 Facing'],
            'pesawat' => ['type' => 'pesawat', 'seats_per_row' => 6, 'left' => ['A', 'B', 'C'], 'right' => ['D', 'E', 'F'], 'aisle_after' => 3, 'rows' => 30, 'desc' => 'Narrow Body 3-3'],
            'kapal' => ['type' => 'kapal', 'seats_per_row' => 4, 'left' => ['A', 'B'], 'right' => ['C', 'D'], 'aisle_after' => 2, 'rows' => 25, 'desc' => 'Ferry Ekonomi 2-2'],
        ];

        Transportasi::create([
            'tipe' => $type,
            'nama_brand' => $request->nama_brand,
            'kode_identitas' => $request->kode_identitas,
            'kapasitas' => $request->kapasitas,
            'seat_layout' => $layouts[$request->seat_layout] ?? $layouts['bus'],
            'fasilitas' => $request->fasilitas,
            'user_id' => auth('web')->id(),
        ]);
        return redirect()->route('transportasi.index', $type)->with('success', 'Transportasi berhasil ditambahkan');
    }

    public function edit($type, Transportasi $transportasi)
    {
        // Pastikan transportasi milik user yang login
        if ($transportasi->user_id !== Auth::id()) {
            abort(403);
        }

        return view('admin.edit', compact('type', 'transportasi'));
    }

    public function update(Request $request, $type, Transportasi $transportasi)
    {
        // Pastikan transportasi milik user yang login
        if ($transportasi->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'nama_brand' => 'required|string|max:100',
            'kode_identitas' => 'required|string|max:50',
            'kapasitas' => 'required|integer|min:1'
        ]);

        $transportasi->update([
            'nama_brand' => $request->nama_brand,
            'kode_identitas' => $request->kode_identitas,
            'kapasitas' => $request->kapasitas,
        ]);

        return redirect()->route('transportasi.index', $type)->with('success', 'Transportasi berhasil diupdate');
    }

    public function destroy($type, Transportasi $transportasi)
    {
        // Pastikan transportasi milik user yang login
        if ($transportasi->user_id !== Auth::id()) {
            abort(403);
        }

        // Cek apakah ada jadwal yang menggunakan transportasi ini
        if ($transportasi->jadwals()->exists()) {
            return redirect()->back()->with('error', 'Tidak dapat menghapus transportasi yang masih memiliki jadwal aktif');
        }

        $transportasi->delete();

        return redirect()->route('transportasi.index', $type)->with('success', 'Transportasi berhasil dihapus');
    }

    // --- BAGIAN JADWAL ---

    public function indexJadwal($type)
    {
        $data = Jadwal::whereHas('transportasi', function ($q) use ($type) {
            $q->where('tipe', $type)
                ->where('user_id', Auth::id());
        })->with('transportasi')->get();

        return view('admin.index', compact('data', 'type'));
    }

    public function createJadwal($type)
    {
        // Ambil daftar armada sesuai tipe untuk dipilih di dropdown form jadwal
        $lokasis = Lokasi::orderBy('nama')->get();
        $armada = Transportasi::where('tipe', $type)
            ->where('user_id', Auth::id())
            ->get();
        return view('admin.create', compact('type', 'armada', 'lokasis'));
    }

    public function storeJadwal(Request $request, $type)
    {
        $request->validate([
            'transportasi_id' => 'required|exists:transportasi,id',
            'asal' => 'required|exists:lokasi,id',
            'tujuan' => 'required|exists:lokasi,id',
            'waktu' => 'required|date',
            'harga' => 'required|numeric|min:0',
            'lokasi' => 'required|string|max:1000',
            'stok' => 'required|integer|min:1',
        ]);

        $transportasi = Transportasi::where('id', $request->transportasi_id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        Jadwal::create([
            'transportasi_id' => $transportasi->id,
            'asal_id' => $request->asal,
            'tujuan_id' => $request->tujuan,
            'waktu_berangkat' => $request->waktu,
            'waktu_tiba' => Carbon::parse($request->waktu)->addHours(2),
            'harga' => $request->harga,
            'info_lokasi' => $request->lokasi,
            'stok_tersedia' => $request->stok,
        ]);

        return redirect()->route('jadwal.index', $type)->with('success', 'Jadwal berhasil dibuat');
    }

    public function editJadwal($type, Jadwal $jadwal)
    {
        // Pastikan jadwal milik user yang login (melalui transportasi)
        if ($jadwal->transportasi->user_id !== Auth::id()) {
            abort(403);
        }
        $lokasis = Lokasi::orderBy('nama')->get();
        $armada = Transportasi::where('tipe', $type)
            ->where('user_id', Auth::id())
            ->get();
        return view('admin.edit', compact('type', 'jadwal', 'armada', 'lokasis'));
    }

    public function updateJadwal(Request $request, $type, Jadwal $jadwal)
    {
        // Pastikan jadwal milik user yang login
        if ($jadwal->transportasi->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'transportasi_id' => 'required|exists:transportasi,id',
            'asal' => 'required|exists:lokasi,id',
            'tujuan' => 'required|exists:lokasi,id',
            'waktu' => 'required|date',
            'harga' => 'required|numeric|min:0',
            'lokasi' => 'required|string|max:1000',
            'stok' => 'required|integer|min:1',
        ]);

        $transportasi = Transportasi::where('id', $request->transportasi_id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $jadwal->update([
            'transportasi_id' => $transportasi->id,
            'asal_id' => $request->asal,
            'tujuan_id' => $request->tujuan,
            'waktu_berangkat' => $request->waktu,
            'waktu_tiba' => Carbon::parse($request->waktu)->addHours(2),
            'harga' => $request->harga,
            'info_lokasi' => $request->lokasi,
            'stok_tersedia' => $request->stok,
        ]);

        return redirect()->route('jadwal.index', $type)->with('success', 'Jadwal berhasil diupdate');
    }

    public function destroyJadwal($type, Jadwal $jadwal)
    {
        // Pastikan jadwal milik user yang login
        if ($jadwal->transportasi->user_id !== Auth::id()) {
            abort(403);
        }

        // Cek apakah ada booking yang menggunakan jadwal ini
        if ($jadwal->bookings()->exists()) {
            return redirect()->back()->with('error', 'Tidak dapat menghapus jadwal yang masih memiliki booking aktif');
        }

        $jadwal->delete();

        return redirect()->route('jadwal.index', $type)->with('success', 'Jadwal berhasil dihapus');
    }

    // --- BAGIAN PEMBAYARAN ---

    public function dashboard()
    {
        $totalPending = Booking::where('status', 'pending')->count();
        $totalPaid = Booking::where('status', 'paid')->count();
        $totalRevenue = Booking::where('status', 'paid')->sum('total_harga');

        return view('admin.dashboard', compact('totalPending', 'totalPaid', 'totalRevenue'));
    }

    public function listPayments()
    {
        $payments = Booking::with(['user', 'jadwal.transportasi', 'payment'])
            ->whereHas('payment', function ($q) {
                $q->where('status', 'pending');
            })
            ->orderByDesc('created_at')
            ->get();

        return view('admin.verifikasi', compact('payments'));
    }

    public function approvePayment($id)
    {
        $booking = Booking::where('status', 'pending')->with('payment')->findOrFail($id);

        $booking->update(['status' => 'paid']);

        if ($booking->payment) {
            $booking->payment->update([
                'status' => 'paid',
                'verified_at' => now(),
            ]);
        }

        return redirect()->back()->with('success', 'Pembayaran telah diverifikasi dan booking di-update.');
    }
}
