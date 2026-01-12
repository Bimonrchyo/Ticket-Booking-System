<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SuperAdminController extends Controller
{
    // Menampilkan daftar Admin
    public function index()
    {
        $admins = User::where('role', 'admin')->get();
        return view('superadmin.kelola-admin.index', compact('admins'));
    }

    // Tambah Admin Baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:6',
        ]);

        User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
        ]);

        return redirect()->back()->with('success', 'Admin baru berhasil didaftarkan');
    }

    // Laporan Pendapatan Gabungan
    public function report()
    {
        $totalPendapatan = Booking::where('status', 'paid')->sum('total_harga');

        // Break down per kategori transportasi
        $laporanPerModa = Booking::join('jadwal', 'bookings.jadwal_id', '=', 'jadwal.id')
            ->join('transportasi', 'jadwal.transportasi_id', '=', 'transportasi.id')
            ->where('bookings.status', 'paid')
            ->selectRaw('transportasi.tipe, SUM(bookings.total_harga) as total')
            ->groupBy('transportasi.tipe')
            ->get();

        return view('superadmin.laporan-global', compact('totalPendapatan', 'laporanPerModa'));
    }
}
