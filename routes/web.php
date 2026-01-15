<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\TransportController;
use App\Http\Controllers\SuperAdminController;

// --- AUTH ---
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// --- USER ROLE (Pelanggan) ---
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/home', [BookingController::class, 'index']);
    Route::get('/cari/{type}', [BookingController::class, 'search']); // type: pesawat/bus/dll
    Route::post('/booking/{type}', [BookingController::class, 'store']);
    Route::get('/pembayaran/{id}', [BookingController::class, 'payment']);
    Route::get('/history', [BookingController::class, 'history']);

    // Cetak
    Route::get('/cetak/struk/{id}', [BookingController::class, 'printInvoice']);
    Route::get('/cetak/tiket/{id}', [BookingController::class, 'printTicket']);
});

// --- ADMIN ROLE ---
Route::middleware(['auth', 'role:admin,superadmin'])->prefix('admin')->group(function () {

    // 1. Kelola Armada (Bus, Pesawat, dll)
    // Menggunakan resource agar hemat baris untuk Index, Create, Store, Edit, Delete
    Route::resource('/transportasi/{type}', TransportController::class)->parameters([
        '{type}' => 'transportasi' // Mengamankan parameter agar tidak bentrok
    ]);

    // 2. Kelola Jadwal (Manual Route)
    // Karena kita butuh method khusus 'storeJadwal'
    Route::get('/jadwal/{type}', [TransportController::class, 'indexJadwal'])->name('jadwal.index');
    Route::get('/jadwal/{type}/create', [TransportController::class, 'createJadwal'])->name('jadwal.create');
    Route::post('/jadwal/{type}', [TransportController::class, 'storeJadwal'])->name('jadwal.store');

    // 3. Verifikasi Pembayaran
    Route::get('/konfirmasi-pembayaran', [TransportController::class, 'listPayments'])->name('admin.payments');
    Route::patch('/konfirmasi-pembayaran/{id}', [TransportController::class, 'approvePayment'])->name('admin.approve');
});

// --- SUPERADMIN ROLE ---
Route::middleware(['auth', 'role:superadmin'])->prefix('super')->group(function () {
    Route::resource('/manage-admin', SuperAdminController::class);
    Route::get('/laporan-global', [SuperAdminController::class, 'report']);
});
