<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TransportController;
use App\Http\Controllers\SuperAdminController;

// --- AUTH ---
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout']);

// --- USER ROLE (Pelanggan) ---
Route::middleware(['auth', 'role:user'])->group(function () {

    Route::get('/home', [HomeController::class, 'index']);

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
