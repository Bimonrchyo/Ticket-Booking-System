<?php

use Illuminate\Support\Facades\Route;

route::get('/login', function () {
    return view('auth.login');
});

route::get('/register', function () {
    return view('auth.register');
});

route::get('/history', function () {
    return view('user.history');
});

Route::get('/home', function () {
    return view('user.home');
});

Route::get('/pencarian', function () {
    return view('user.pencarian');
});

route::get('/eticket', function () {
    return view('user.e-ticket');
});

route::get('/struck', function () {
    return view('user.struk');
});

route::get('/checkout', function () {
    return view('user.checkout');
});

route::get('/detail_jadwal', function () {
    return view('user.detail-jadwal');
});

route::get('/pembayaran', function () {
    return view('user.pembayaran');
});

route::get('/dashboard', function () {
    return view('admin.dashboard');
});

route::get('/index', function () {
    return view('admin.index');
});

route::get('/create', function () {
    return view('admin.create');
});

route::get('/verifikasi', function () {
    return view('admin.verifikasi');
});

route::get('/daftar', function () {
    return view('superadmin.daftar_admin');
});

route::get('/tambah', function () {
    return view('superadmin.tambah_admin');
});

route::get('/laporan', function () {
    return view('superadmin.laporan_global');
});