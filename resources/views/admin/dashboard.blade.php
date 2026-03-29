@extends('layouts.app')

@section('title', 'Admin Dashboard | PastiTravel')

@section('nav-links')
	<a class="border-b-2 border-orange-400 text-orange-400" href="{{ route('admin.dashboard') }}">Dashboard</a>
	<a class="hover:text-blue-200" href="{{ route('admin.payments') }}">Verifikasi</a>
@endsection

@section('content')
	<div class="bg-gray-50 font-sans" x-data="{ openArmada: false, openJadwal: false }">

		<div class="flex">
			<aside class="fixed left-0 top-0 hidden min-h-screen w-64 bg-slate-900 text-gray-300 lg:block">
				<div class="p-6">
					<h1 class="text-2xl font-black uppercase italic tracking-tighter text-white">Pasti<span
							class="text-blue-500">Admin</span></h1>
				</div>
				<nav class="mt-6 space-y-2 px-4">
					<a
						class="flex items-center gap-3 rounded-xl bg-slate-800 px-4 py-3 text-sm font-bold text-white transition hover:bg-slate-700"
						href="{{ route('admin.dashboard') }}">
						<i class="fas fa-chart-pie w-5"></i> Dashboard
					</a>
					<div class="px-4 pb-2 pt-6 text-[10px] font-black uppercase tracking-widest text-slate-500">Manajemen</div>
					<a
						class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-bold transition hover:bg-slate-800 hover:text-white"
						href="#" @click="openArmada = !openArmada">
						<i class="fas fa-bus w-5"></i> Kelola Armada
						<i class="fas fa-chevron-down ml-auto w-3" :class="openArmada && 'rotate-180'"></i>
					</a>
					<div class="ml-4 space-y-1 text-sm" x-show="openArmada">
						<a class="block rounded-lg px-4 py-2 text-xs transition hover:bg-slate-800"
							href="{{ route('transportasi.index', 'pesawat') }}">✈️ Pesawat</a>
						<a class="block rounded-lg px-4 py-2 text-xs transition hover:bg-slate-800"
							href="{{ route('transportasi.index', 'bus') }}">🚌 Bus</a>
						<a class="block rounded-lg px-4 py-2 text-xs transition hover:bg-slate-800"
							href="{{ route('transportasi.index', 'kereta') }}">🚂 Kereta</a>
						<a class="block rounded-lg px-4 py-2 text-xs transition hover:bg-slate-800"
							href="{{ route('transportasi.index', 'kapal') }}">⛴️ Kapal</a>
					</div>
					<a
						class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-bold transition hover:bg-slate-800 hover:text-white"
						href="#" @click="openJadwal = !openJadwal">
						<i class="fas fa-calendar-alt w-5"></i> Kelola Jadwal
						<i class="fas fa-chevron-down ml-auto w-3" :class="openJadwal && 'rotate-180'"></i>
					</a>
					<div class="ml-4 space-y-1 text-sm" x-show="openJadwal">
						<a class="block rounded-lg px-4 py-2 text-xs transition hover:bg-slate-800"
							href="{{ route('jadwal.index', 'pesawat') }}">✈️ Pesawat</a>
						<a class="block rounded-lg px-4 py-2 text-xs transition hover:bg-slate-800"
							href="{{ route('jadwal.index', 'bus') }}">🚌 Bus</a>
						<a class="block rounded-lg px-4 py-2 text-xs transition hover:bg-slate-800"
							href="{{ route('jadwal.index', 'kereta') }}">🚂 Kereta</a>
						<a class="block rounded-lg px-4 py-2 text-xs transition hover:bg-slate-800"
							href="{{ route('jadwal.index', 'kapal') }}">⛴️ Kapal</a>
					</div>
					<a
						class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-bold transition hover:bg-slate-800 hover:text-white"
						href="{{ route('admin.payments') }}">
						<i class="fas fa-check-circle w-5"></i> Verifikasi Bayar
					</a>
				</nav>
			</aside>

			<main class="flex-1 p-8 lg:ml-64">
				<div class="mx-auto max-w-6xl">

					<div class="mb-8">
						<h1 class="text-3xl font-black uppercase tracking-tighter text-slate-800">Dashboard Admin</h1>
						<p class="text-lg font-bold uppercase tracking-widest text-gray-400">Kelola sistem PastiTravel</p>
					</div>

					<div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
						<div
							class="group relative overflow-hidden rounded-2xl border border-gray-200 bg-white p-6 shadow-lg shadow-gray-100/50 transition hover:shadow-xl hover:shadow-gray-200/50">
							<div class="absolute -right-4 -top-4 h-16 w-16 rounded-full bg-orange-100 transition group-hover:scale-110"></div>
							<div class="relative">
								<i class="fas fa-clock text-2xl text-orange-500"></i>
								<p class="mt-4 text-sm font-semibold uppercase tracking-wider text-gray-500">Booking Pending</p>
								<p class="mt-2 text-4xl font-black text-orange-600">{{ number_format($totalPending) }}</p>
								<p class="mt-2 text-xs text-gray-500">Jumlah pemesanan yang menunggu konfirmasi pembayaran</p>
							</div>
						</div>

						<div
							class="group relative overflow-hidden rounded-2xl border border-gray-200 bg-white p-6 shadow-lg shadow-gray-100/50 transition hover:shadow-xl hover:shadow-gray-200/50">
							<div class="absolute -right-4 -top-4 h-16 w-16 rounded-full bg-green-100 transition group-hover:scale-110"></div>
							<div class="relative">
								<i class="fas fa-check-circle text-2xl text-green-500"></i>
								<p class="mt-4 text-sm font-semibold uppercase tracking-wider text-gray-500">Booking Paid</p>
								<p class="mt-2 text-4xl font-black text-green-600">{{ number_format($totalPaid) }}</p>
								<p class="mt-2 text-xs text-gray-500">Jumlah pemesanan yang berhasil dibayar</p>
							</div>
						</div>

						<div
							class="group relative overflow-hidden rounded-2xl border border-gray-200 bg-white p-6 shadow-lg shadow-gray-100/50 transition hover:shadow-xl hover:shadow-gray-200/50">
							<div class="absolute -right-4 -top-4 h-16 w-16 rounded-full bg-blue-100 transition group-hover:scale-110"></div>
							<div class="relative">
								<i class="fas fa-dollar-sign text-2xl text-blue-500"></i>
								<p class="mt-4 text-sm font-semibold uppercase tracking-wider text-gray-500">Revenue</p>
								<p class="mt-2 text-4xl font-black text-blue-600">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
								<p class="mt-2 text-xs text-gray-500">Total pendapatan dari pemesanan terbayar</p>
							</div>
						</div>

						<div
							class="group relative overflow-hidden rounded-2xl border border-gray-200 bg-white p-6 shadow-lg shadow-gray-100/50 transition hover:shadow-xl hover:shadow-gray-200/50">
							<div class="absolute -right-4 -top-4 h-16 w-16 rounded-full bg-indigo-100 transition group-hover:scale-110"></div>
							<div class="relative">
								<i class="fas fa-tasks text-2xl text-indigo-500"></i>
								<p class="mt-4 text-sm font-semibold uppercase tracking-wider text-gray-500">Verifikasi</p>
								<p class="mt-2 text-4xl font-black text-indigo-600">{{ number_format($totalPending) }}</p>
								<p class="mt-2 text-xs text-gray-500">Masuk ke menu verifikasi untuk validasi bukti transfer</p>
							</div>
						</div>
					</div>

				</div>
			</main>
		</div>

	</div>
@endsection
