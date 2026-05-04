@extends('layouts.app')

@section('title', 'Multi-Transport Hub | Pesan Tiket Mudah')

@section('nav-links')
	<a class="border-b-2 border-orange-400 text-orange-400" href="{{ route('home') }}">Beranda</a>
	<a class="hover:text-blue-200" href="{{ route('history') }}">Histori</a>
@endsection

@section('content')
	<header class="h-65 relative flex items-center justify-center bg-blue-600 px-4 text-center text-white md:h-60">
		<div class="z-10">
			<h1 class="mb-2 text-3xl font-extrabold md:text-5xl">Mau Pergi ke Mana?</h1>
			<p class="text-sm text-blue-100 md:text-lg">Cari tiket pesawat, bus, kereta, dan kapal dalam satu aplikasi.</p>
		</div>
		<i
			class="fas fa-plane pointer-events-none fixed right-4 top-8 z-0 text-[120px] opacity-20 md:right-10 md:top-6 md:text-[200px]"></i>
	</header>

	<main class="container mx-auto -mt-8 px-4 pb-12 md:-mt-12">
		<div class="rounded-2xl bg-white p-6 shadow-xl md:p-8">

			<div class="no-scrollbar mb-6 mt-10 flex gap-4 overflow-x-auto border-b pb-4">

				@foreach ($modas as $moda)
					@php
						$activeClass =
							$active_moda == $moda['id']
							? 'text-blue-600 border-b-2 border-blue-600'
							: 'text-gray-500 hover:text-blue-500';
					@endphp

					<a class="{{ $activeClass }} flex min-w-[80px] flex-col items-center pb-2 transition"
						href="?type={{ $moda['id'] }}">
						<div class="mb-1 flex h-12 w-12 items-center justify-center rounded-full bg-gray-100">
							<i class="fas {{ $moda['icon'] }} text-xl"></i>
						</div>
						<span class="text-xs font-bold uppercase tracking-wider">
							{{ $moda['label'] }}
						</span>
					</a>
				@endforeach
			</div>

			<form class="grid grid-cols-1 gap-6 md:grid-cols-4" action="{{ route('pencarian') }}" method="GET">
				<input name="moda" type="hidden" value="{{ $active_moda }}">

				<div class="flex flex-col">
					<label class="mb-1 text-sm font-semibold italic text-gray-600">Asal</label>
					<div class="relative">
						<i class="fas fa-map-marker-alt absolute left-3 top-3.5 text-gray-400"></i>
						<select
							class="w-full rounded-xl border border-gray-200 bg-gray-50 py-3 pl-10 pr-4 outline-none focus:ring-2 focus:ring-blue-500"
							name="asal">
							@foreach ($lokasis as $lokasi)
								<option value="{{ $lokasi->id }}">{{ $lokasi->nama }}</option>
							@endforeach
						</select>
					</div>
				</div>

				<div class="flex flex-col">
					<label class="mb-1 text-sm font-semibold italic text-gray-600">Tujuan</label>
					<div class="relative">
						<i class="fas fa-location-arrow absolute left-3 top-3.5 text-gray-400"></i>
						<select
							class="w-full rounded-xl border border-gray-200 bg-gray-50 py-3 pl-10 pr-4 outline-none focus:ring-2 focus:ring-blue-500"
							name="tujuan">
							@foreach ($lokasis as $lokasi)
								<option value="{{ $lokasi->id }}">{{ $lokasi->nama }}</option>
							@endforeach
						</select>
					</div>
				</div>

				<div class="flex flex-col">
					<label class="mb-1 text-sm font-semibold italic text-gray-600">Tanggal Pergi</label>
					<div class="relative">
						<i class="fas fa-calendar-alt absolute left-3 top-3.5 text-gray-400"></i>
						<input
							class="w-full rounded-xl border border-gray-200 bg-gray-50 py-3 pl-10 pr-4 outline-none focus:ring-2 focus:ring-blue-500"
							name="tanggal" type="date" required>
					</div>
				</div>

				<div class="flex flex-col justify-end">
					<button
						class="w-full transform rounded-xl bg-orange-500 py-3.5 font-bold text-white shadow-lg transition hover:bg-orange-600 active:scale-95"
						type="submit">
						CARI TIKET
					</button>
				</div>
			</form>
		</div>

		<section class="mt-12">
			<h2 class="mb-6 flex items-center gap-2 text-xl font-bold">
				<span class="h-8 w-2 rounded-full bg-blue-600"></span>
				Rekomendasi Rute Terpopuler
			</h2>
			<div class="grid grid-cols-1 gap-6 md:grid-cols-3">
				@forelse ($popularRoutes as $route)
					<div class="overflow-hidden rounded-xl bg-white shadow-sm transition hover:shadow-md">
						<div
							class="flex h-40 w-full items-center justify-center bg-gradient-to-r from-blue-500 to-blue-600 text-white">
							<div class="text-center">
								<i
									class="fas {{ $route->transportasi->tipe == 'pesawat' ? 'fa-plane' : ($route->transportasi->tipe == 'bus' ? 'fa-bus' : ($route->transportasi->tipe == 'kereta' ? 'fa-train' : 'fa-ship')) }} text-4xl opacity-30"></i>
								<p class="mt-2 text-xs font-bold uppercase tracking-widest">
									{{ ucfirst($route->transportasi->tipe) }}
								</p>
							</div>
						</div>
						<div class="p-4">
							<p class="text-xs font-bold uppercase text-blue-600"><i
									class="fas fa-heart mr-1 text-orange-500"></i>Favorit
								Travelers</p>
							<h3 class="text-lg font-bold text-gray-800">{{ $route->asal->nama ?? 'N/A' }} →
								{{ $route->tujuan->nama ?? 'N/A' }}
							</h3>
							<p class="mb-4 text-sm text-gray-500">Mulai dari <span class="text-lg font-bold text-orange-500">Rp
									{{ number_format($route->harga, 0, ',', '.') }}</span></p>
							<a class="inline-block w-full rounded-lg border border-blue-600 py-2 text-center text-sm font-semibold text-blue-600 transition hover:bg-blue-50"
								href="{{ route('pencarian', ['asal' => $route->asal_id, 'tujuan' => $route->tujuan_id, 'moda' => $route->transportasi->tipe]) }}">
								Cek Jadwal
							</a>
						</div>
					</div>
				@empty
					<style>
						.fallback-container {
							text-align: center;
							padding: 3rem;
							color: #6b7;
						}
					</style>
					<div style="text-align:center;padding:3rem">
						<i class="fas fa-route" style="font-size:3rem;color:#d1d5db;margin-bottom:1rem"></i>
						<p style="font-size:1.125rem;font-weight:600">Belum ada rute populer</p>
						<p style="font-size:0.875rem;margin-bottom:1rem;color:#9ca3af">Jadilah yang pertama memesan tiket!</p>
						<a href="{{ route('pencarian', ['moda' => 'pesawat']) }}"
							style="display:inline-block;border-radius:0.5rem;background:#2563eb;padding:0.5rem 1.5rem;font-size:0.875rem;font-weight:600;color: white">Cari
							Tiket</a>
					</div>
				@endforelse
			</div>
		</section>
	</main>

	<div class="fixed bottom-0 left-0 right-0 z-50 flex justify-around border-t bg-white py-3 md:hidden">
		<a class="flex flex-col items-center text-blue-600" href="{{ route('home') }}">
			<i class="fas fa-search text-xl"></i>
			<span class="mt-1 text-[10px] font-bold">Cari</span>
		</a>
		<a class="flex flex-col items-center text-gray-400" href="{{ route('history') }}">
			<i class="fas fa-history text-xl"></i>
			<span class="mt-1 text-[10px]">Histori</span>
		</a>
		<a class="flex flex-col items-center text-gray-400" href="{{ route('login') }}">
			<i class="fas fa-user text-xl"></i>
			<span class="mt-1 text-[10px]">Akun</span>
		</a>
	</div>
@endsection