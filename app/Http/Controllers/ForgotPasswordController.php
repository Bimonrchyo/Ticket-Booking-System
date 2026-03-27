<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
  public function showForm()
  {
    return view('auth.forgot-password');
  }

  public function sendReset(Request $request)
  {
    $request->validate([
      'email' => 'required|email|exists:users,email'
    ], [
      'email.required' => 'Email wajib diisi.',
      'email.email' => 'Format email tidak valid.',
      'email.exists' => 'Email tidak terdaftar di sistem kami.'
    ]);

    // Generate token unik
    $token = Str::random(64);
    $email = $request->email;

    // Simpan token ke database (atau bisa langsung email)
    DB::table('password_reset_tokens')->updateOrInsert(
      ['email' => $email],
      [
        'token' => bcrypt($token),
        'created_at' => now()
      ]
    );

    // TODO: Jika ada email config, bisa gunakan Mail::send() untuk kirim email
    // Untuk dev, bisa redirect langsung ke reset form dengan token di URL
    session()->flash('success', 'Silakan cek email Anda untuk link reset password.');

    return redirect()->route('password.reset.form', ['token' => $token, 'email' => $email]);
  }

  public function showResetForm($token, $email)
  {
    // Validasi token (optional, bisa ditambah security lebih)
    return view('auth.reset-password', compact('token', 'email'));
  }

  public function resetPassword(Request $request)
  {
    $request->validate([
      'email' => 'required|email|exists:users,email',
      'password' => 'required|min:8|confirmed',
      'token' => 'required'
    ], [
      'password.confirmed' => 'Konfirmasi password tidak cocok.'
    ]);

    $user = User::where('email', $request->email)->first();

    if (! $user) {
      return back()->withErrors('Email tidak ditemukan.');
    }

    // Update password
    $user->update(['password' => $request->password]);

    // Hapus reset token
    DB::table('password_reset_tokens')->where('email', $request->email)->delete();

    return redirect()->route('login')->with('success', 'Password berhasil direset. Silakan login dengan password baru Anda.');
  }
}
