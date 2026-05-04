<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TransportController;
use App\Http\Controllers\SuperAdminController;

// --- PUBLIC ---
Route::get('/', function () {
    return view('auth.login');
});

// --- AUTH ---
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/register-company', [AuthController::class, 'showCompanyRegister'])->name('register.company');
Route::post('/register-company', [AuthController::class, 'registerCompany'])->name('register.company.store');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// --- FORGOT PASSWORD ---
Route::get('/forgot-password', [ForgotPasswordController::class, 'showForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendReset'])->name('password.email');
Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset.form');
Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('password.reset');

// --- DASHBOARD REDIRECTS ---
Route::middleware(['auth', 'role:admin,superadmin'])->group(function () {
    Route::get('/admin/dashboard', [TransportController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/dashboard', [TransportController::class, 'dashboard'])->name('shared.dashboard');
});

Route::middleware(['auth', 'role:superadmin'])->group(function () {
    Route::get('/super/dashboard', [SuperAdminController::class, 'dashboard'])->name('super.dashboard');
    Route::get('/laporan', [SuperAdminController::class, 'report'])->name('super.laporan');
    Route::get('/daftar', [SuperAdminController::class, 'index'])->name('super.daftar');
    Route::get('/tambah', [SuperAdminController::class, 'create'])->name('super.tambah');
});

// --- USER ROLE (Pelanggan) ---
Route::middleware(['auth', 'role:user'])->group(function () {

    Route::get('/home', [HomeController::class, 'index'])
        ->name('home');

    Route::get('/pencarian', [SearchController::class, 'index'])
        ->name('pencarian');

    Route::get('/booking/{jadwal}', [BookingController::class, 'create'])
        ->name('booking.create');

    Route::get('/checkout/{jadwal}', [BookingController::class, 'checkout'])
        ->name('checkout');

    Route::post('/checkout/{jadwal}', [BookingController::class, 'store'])
        ->name('booking.store');

    Route::get('/pembayaran/{booking}', [BookingController::class, 'payment'])
        ->name('pembayaran');

    Route::post('/pembayaran/{booking}/upload', [BookingController::class, 'uploadBukti'])
        ->name('upload.bukti');

    Route::post('/pembayaran/{booking}/konfirmasi', [BookingController::class, 'konfirmasiPembayaran'])
        ->name('konfirmasi.pembayaran');

    Route::post('/pembayaran/{booking}/ulang', [BookingController::class, 'retryPayment'])
        ->name('pembayaran.ulang');

    // Halaman sukses pembayaran (lebih ringkas dan user friendly)
    Route::get('/pembayaran-sukses', [BookingController::class, 'paymentSuccess'])
        ->name('pembayaran.sukses');

    // Legacy alias agar URL lama masih tetap aman
    Route::get('/pembayaran/sukses', function () {
        return redirect()->route('pembayaran.sukses');
    });

    Route::get('/history', [BookingController::class, 'history'])
        ->name('history');

    Route::get('/cetak/struk/{booking}', [BookingController::class, 'printInvoice'])
        ->name('invoice.print');

    Route::get('/cetak/tiket/{booking}', [BookingController::class, 'printTicket'])
        ->name('ticket.print');
});

// --- ADMIN ROLE ---
Route::middleware(['auth', 'role:admin,superadmin'])->prefix('admin')->group(function () {

    // 1. Kelola Armada (Bus, Pesawat, dll)
    // Manual routes karena kita butuh parameter type saja, bukan resource ID
    Route::get('/transportasi/{type}', [TransportController::class, 'index'])->name('transportasi.index');
    Route::get('/transportasi/{type}/create', [TransportController::class, 'create'])->name('transportasi.create');
    Route::post('/transportasi/{type}', [TransportController::class, 'store'])->name('transportasi.store');
    Route::get('/transportasi/{type}/{transportasi}/edit', [TransportController::class, 'edit'])->name('transportasi.edit');
    Route::patch('/transportasi/{type}/{transportasi}', [TransportController::class, 'update'])->name('transportasi.update');
    Route::delete('/transportasi/{type}/{transportasi}', [TransportController::class, 'destroy'])->name('transportasi.destroy');

    // 2. Kelola Jadwal (Manual Route)
    // Karena kita butuh method khusus 'storeJadwal'
    Route::get('/jadwal/{type}', [TransportController::class, 'indexJadwal'])->name('jadwal.index');
    Route::get('/jadwal/{type}/create', [TransportController::class, 'createJadwal'])->name('jadwal.create');
    Route::post('/jadwal/{type}', [TransportController::class, 'storeJadwal'])->name('jadwal.store');
    Route::get('/jadwal/{type}/{jadwal}/edit', [TransportController::class, 'editJadwal'])->name('jadwal.edit');
    Route::patch('/jadwal/{type}/{jadwal}', [TransportController::class, 'updateJadwal'])->name('jadwal.update');
    Route::delete('/jadwal/{type}/{jadwal}', [TransportController::class, 'destroyJadwal'])->name('jadwal.destroy');

    // 3. Verifikasi Pembayaran
    Route::get('/konfirmasi-pembayaran', [TransportController::class, 'listPayments'])->name('admin.payments');
    Route::patch('/konfirmasi-pembayaran/{id}/approve', [TransportController::class, 'approvePayment'])->name('admin.approve');
    Route::patch('/konfirmasi-pembayaran/{id}/reject', [TransportController::class, 'rejectPayment'])->name('admin.reject');
});

// --- SUPERADMIN ROLE ---
Route::middleware(['auth', 'role:superadmin'])->prefix('super')->group(function () {
    Route::get('/dashboard', [SuperAdminController::class, 'dashboard'])->name('super.dashboard');
    Route::get('/daftar', [SuperAdminController::class, 'index'])->name('super.daftar');
    Route::get('/tambah', [SuperAdminController::class, 'create'])->name('super.tambah');
    Route::post('/tambah', [SuperAdminController::class, 'store'])->name('super.store');
    Route::delete('/admin/{user}', [SuperAdminController::class, 'destroy'])->name('super.destroy');
    Route::get('/laporan-global', [SuperAdminController::class, 'report'])->name('super.laporan');
    Route::get('/company-requests', [SuperAdminController::class, 'companyRequests'])->name('super.company.requests');
    Route::patch('/company-requests/{company}/approve', [SuperAdminController::class, 'approveCompany'])->name('super.company.approve');
    Route::patch('/company-requests/{company}/reject', [SuperAdminController::class, 'rejectCompany'])->name('super.company.reject');
});
