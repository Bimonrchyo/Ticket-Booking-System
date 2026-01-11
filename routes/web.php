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