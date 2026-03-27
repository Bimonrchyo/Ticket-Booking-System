<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Booking;
use App\Models\Transportasi;
use Illuminate\Http\Request;

class TransportController extends Controller
{
    // --- BAGIAN TRANSPORTASI (ARMADA) ---

    public function index($type)
    {
        $data = Transportasi::where('tipe', $type)->get();
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
            'kapasitas' => 'required|integer|min:1'
        ]);

        Transportasi::create([
            'tipe' => $type,
            'nama_brand' => $request->nama_brand,
            'kode_identitas' => $request->kode_identitas,
            'kapasitas' => $request->kapasitas,
            'admin_id' => auth('web')->id(),
        ]);
        return redirect()->route('transportasi.index', $type);
    }

    // --- BAGIAN JADWAL ---

    public function indexJadwal($type)
    {
        $data = Jadwal::whereHas('transportasi', function ($q) use ($type) {
            $q->where('tipe', $type);
        })->with('transportasi')->get();

        return view('admin.index', compact('data', 'type'));
    }

    public function createJadwal($type)
    {
        // Ambil daftar armada sesuai tipe untuk dipilih di dropdown form jadwal
        $armada = Transportasi::where('tipe', $type)->get();
        return view('admin.create', compact('type', 'armada'));
    }

    public function storeJadwal(Request $request, $type)
    {
        Jadwal::create([
            'transportasi_id' => $request->transportasi_id,
            'titik_asal' => $request->asal,
            'titik_tujuan' => $request->tujuan,
            'waktu_berangkat' => $request->waktu,
            'harga' => $request->harga,
            'info_lokasi' => $request->lokasi,
            'stok_tersedia' => $request->stok
        ]);
        return redirect()->route('jadwal.index', $type)->with('success', 'Jadwal berhasil dibuat');
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
                $q->where('status', '!=', 'verified');
            })
            ->orderByDesc('created_at')
            ->get();

        return view('admin.verifikasi', compact('payments'));
    }

    public function approvePayment($id)
    {
        $booking = Booking::where('status', 'pending')->findOrFail($id);
        $booking->update(['status' => 'paid']);
        return redirect()->back()->with('success', 'Pembayaran dikonfirmasi!');
    }
}
