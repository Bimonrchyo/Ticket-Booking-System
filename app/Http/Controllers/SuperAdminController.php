<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Booking;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SuperAdminController extends Controller
{
    // Menampilkan daftar Admin
    public function index()
    {
        $admins = User::where('role', 'admin')->with('company')->get();
        return view('superadmin.daftar_admin', compact('admins'));
    }

    public function companyRequests()
    {
        $companies = Company::with('users')->where('status', 'pending')->get();
        return view('superadmin.company_requests', compact('companies'));
    }

    public function approveCompany(Company $company)
    {
        $company->update(['status' => 'approved']);
        $company->users()->where('role', 'admin')->update(['status' => 'active']);

        return back()->with('success', 'Perusahaan disetujui dan admin diaktifkan.');
    }

    public function rejectCompany(Company $company)
    {
        $company->update(['status' => 'rejected']);
        $company->users()->where('role', 'admin')->update(['status' => 'rejected']);

        return back()->with('success', 'Perusahaan ditolak dan admin ditolak.');
    }

    // Halaman tambah admin (tambah_admin.blade.php)
    public function create()
    {
        return view('superadmin.tambah_admin');
    }

    // Superadmin dashboard
    public function dashboard()
    {
        $totalUsers = User::where('role', 'user')->count();
        $totalBookings = Booking::count();
        $totalIncome = Booking::where('status', 'paid')->sum('total_harga');

        return view('superadmin.laporan_global', compact('totalUsers', 'totalBookings', 'totalIncome'));
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
            'status' => 'active',
        ]);

        return redirect()->back()->with('success', 'Admin baru berhasil didaftarkan');
    }

    // Laporan Pendapatan Gabungan
    public function report()
    {
        $totalPendapatan = Booking::where('status', 'paid')->sum('total_harga');

        // Break down per kategori transportasi
        $laporanPerModa = Booking::join('jadwal', 'pemesanan.jadwal_id', '=', 'jadwal.id')
            ->join('transportasi', 'jadwal.transportasi_id', '=', 'transportasi.id')
            ->where('pemesanan.status', 'paid')
            ->selectRaw('transportasi.tipe, SUM(pemesanan.total_harga) as total')
            ->groupBy('transportasi.tipe')
            ->get();

        return view('superadmin.laporan_global', compact('totalPendapatan', 'laporanPerModa'));
    }
}
