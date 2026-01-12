<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Transportasi;
use Illuminate\Http\Request;

class TransportController extends Controller
{
    // Menampilkan daftar transportasi berdasarkan tipe (pesawat/bus/dll)
    public function index($type)
    {
        $data = Transportasi::where('tipe', $type)->get();
        return view('admin.transportasi.index', compact('data', 'type'));
    }

    // Menyimpan Jadwal Baru
    public function storeJadwal(Request $request, $type)
    {
        Jadwal::create([
            'transportasi_id' => $request->transportasi_id,
            'titik_asal' => $request->asal,
            'titik_tujuan' => $request->tujuan,
            'waktu_berangkat' => $request->waktu,
            'harga' => $request->harga,
            'info_lokasi' => $request->lokasi, // Gate/Peron
            'stok_tersedia' => $request->kapasitas
        ]);

        return redirect()->back()->with('success', "Jadwal $type berhasil dibuat!");
    }
}
