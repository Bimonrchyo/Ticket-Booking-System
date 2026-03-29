<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function showCompanyRegister()
    {
        return view('auth.register-company');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::create([
            'nama' => $data['nama'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'user',
            'status' => 'active',
        ]);

        Auth::login($user);

        return redirect('/home');
    }

    public function registerCompany(Request $request)
    {
        $data = $request->validate([
            'company_name' => 'required|string|max:255',
            'company_address' => 'nullable|string|max:1000',
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        $company = Company::create([
            'name' => $data['company_name'],
            'slug' => str()->slug($data['company_name']).'-'.uniqid(),
            'address' => $data['company_address'],
            'status' => 'pending',
        ]);

        $admin = User::create([
            'nama' => $data['nama'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'admin',
            'company_id' => $company->id,
            'status' => 'pending',
        ]);

        return redirect()->route('login')->with('success', 'Permohonan admin perusahaan dikirim. Menunggu persetujuan superadmin.');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();
            if ($user->role === 'admin') {
                if ($user->status !== 'active' || ($user->company_id !== null && optional($user->company)->status !== 'approved')) {
                    return back()->withErrors(['email' => 'Akun admin perusahaan Anda belum disetujui.']);
                }
                return redirect('/admin/dashboard');
            }

            if ($user->role === 'superadmin') {
                return redirect('/super/dashboard');
            }

            return redirect('/home');
        }

        return back()->withErrors(['email' => 'Email atau Password salah!']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
