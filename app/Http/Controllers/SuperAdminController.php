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
    public function index(Request $request)
    {
        $search = $request->filled('search') ? $request->search : '';
        $admins = User::where('role', 'admin')
            ->with('company')
            ->when($search, function ($query, $search) {
                return $query->where('nama', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10);
        $admins->appends($request->only('search'));
        return view('superadmin.daftar_admin', compact('admins', 'search'));
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
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
            'status' => 'active',
            'company_id' => null,
        ]);

        return redirect()->back()->with('success', 'Admin baru berhasil didaftarkan.');
    }

    // Laporan Pendapatan Gabungan
    public function report()
    {
        $totalPendapatan = Booking::where('status', 'paid')->sum('total_harga');
        $platformRevenue = Booking::where('status', 'paid')->sum(DB::raw('total_harga * 0.3')); // Platform takes 30% commission

        // Break down per kategori transportasi

        $laporanPerModa = Booking::join('jadwal', 'bookings.jadwal_id', '=', 'jadwal.id')
            ->join('transportasi', 'jadwal.transportasi_id', '=', 'transportasi.id')
            ->where('bookings.status', 'paid')
            ->selectRaw('transportasi.tipe, SUM(bookings.total_harga) as total')
            ->groupBy('transportasi.tipe')
            ->get();


        return view('superadmin.laporan_global', compact('totalPendapatan', 'laporanPerModa'));
    }

    public function destroy(User $user)
    {
        if ($user->role !== 'admin') {
            return back()->with('error', 'Hanya admin yang bisa dihapus.');
        }
        $user->delete();
        return back()->with('success', 'Admin berhasil dihapus.');
    }
}