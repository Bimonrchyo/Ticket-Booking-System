<!DOCTYPE html>
<html lang="id">

	<head>
		<meta charset="UTF-8">
		<title>Verifikasi Bayar - HubTrans</title>
		<script src="https://cdn.tailwindcss.com"></script>
		<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
	</head>

	<body class="bg-gray-100 font-sans" x-data="{ openArmada: false, openJadwal: false }">
		<aside class="fixed left-0 top-0 hidden min-h-screen w-64 bg-slate-900 text-gray-300 shadow-2xl lg:block">
			<div class="border-b border-slate-700 p-6">
				<h1 class="text-2xl font-black uppercase italic tracking-tighter text-white">Hub<span
						class="text-blue-500">Admin</span></h1>
				<p class="mt-2 text-[9px] font-black uppercase tracking-widest text-slate-400">Admin Panel</p>
			</div>
			<nav class="mt-6 space-y-2 px-4" x-data="{ openArmada: false, openJadwal: false }">
				<a
					class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-bold transition hover:bg-slate-800 hover:text-white"
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
					<a class="block rounded-lg px-4 py-2 text-xs transition hover:bg-slate-800" href="{{ route('pesawat.index') }}">✈️
						Pesawat</a>
					<a class="block rounded-lg px-4 py-2 text-xs transition hover:bg-slate-800" href="{{ route('bus.index') }}">🚌
						Bus</a>
					<a class="block rounded-lg px-4 py-2 text-xs transition hover:bg-slate-800" href="{{ route('kereta.index') }}">🚂
						Kereta</a>
					<a class="block rounded-lg px-4 py-2 text-xs transition hover:bg-slate-800" href="{{ route('kapal.index') }}">⛴️
						Kapal</a>
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
					class="relative flex items-center gap-3 rounded-xl border-l-4 border-green-500 bg-green-600/20 px-4 py-3 text-sm font-bold text-green-400 transition hover:bg-slate-800"
					href="{{ route('admin.payments') }}">
					<i class="fas fa-check-circle w-5"></i> Verifikasi Bayar
					<span class="absolute right-4 rounded-full bg-red-500 px-1.5 text-[10px] text-white"
						x-text="paymentCount || '0'">0</span>
				</a>
			</nav>
		</aside>

		<main class="ml-64 p-8">
			<div class="mb-10">
				<h2 class="text-2xl font-black uppercase tracking-tighter text-slate-800">Verifikasi Transaksi</h2>
				<p class="text-xs font-bold uppercase tracking-widest text-gray-400">Validasi Bukti Transfer Pengguna</p>
			</div>

			@if ($payments->isEmpty())
				<div class="rounded-3xl border border-gray-100 bg-white p-12 text-center shadow-sm">
					<i class="fas fa-check-circle mb-4 text-6xl text-green-500"></i>
					<p class="text-lg font-bold text-gray-800">Semua Pembayaran Sudah Terverifikasi!</p>
					<p class="mt-2 text-sm text-gray-500">Tidak ada pembayaran yang menunggu verifikasi.</p>
				</div>
			@else
				<div class="space-y-4">
					@foreach ($payments as $payment)
						@php
							$bookingPayment = $payment->payment;
						@endphp
						<div
							class="group flex items-center justify-between rounded-[2rem] border border-gray-100 bg-white p-6 shadow-sm transition hover:border-blue-200">
							<div class="flex flex-1 items-center gap-6">
								<!-- Preview bukti transfer -->
								<div
									class="group relative flex h-16 w-16 cursor-zoom-in items-center justify-center overflow-hidden rounded-2xl border border-gray-100 bg-gray-50 text-gray-300">
									@if ($bookingPayment && $bookingPayment->bukti_transfer)
										<img class="h-full w-full object-cover" src="{{ asset('storage/' . $bookingPayment->bukti_transfer) }}"
											alt="Bukti Transfer">
										<span
											class="absolute inset-0 flex items-center justify-center bg-blue-600/80 text-[8px] font-black text-white opacity-0 transition group-hover:opacity-100">LIHAT
											BUKTI</span>
									@else
										<i class="fas fa-image fa-2x"></i>
										<span
											class="absolute inset-0 flex items-center justify-center bg-blue-600/80 text-[8px] font-black text-white opacity-0 transition group-hover:opacity-100">TIDAK
											ADA</span>
									@endif
								</div>

								<div>
									<h4 class="text-sm font-black uppercase tracking-tight text-slate-800">{{ $payment->user->nama ?? 'User' }}
									</h4>
									<p class="mb-1 text-[10px] font-bold tracking-widest text-gray-400">KODE BOOKING: {{ $payment->kode_booking }}
									</p>
									<p class="text-lg font-black text-orange-500">Rp {{ number_format($payment->total_harga, 0, ',', '.') }}
										@if ($bookingPayment)
											<span class="ml-1 text-[10px] font-normal italic tracking-normal text-gray-400">(via
												{{ $bookingPayment->metode_bayar ?? 'Transfer' }})</span>
										@endif
									</p>
								</div>
							</div>

							<div class="flex gap-3">
								<form style="display:inline;" action="{{ route('admin.approve', $payment->id) }}" method="POST">
									@csrf
									@method('PATCH')
									<button
										class="rounded-xl bg-green-500 px-8 py-3 text-[10px] font-black uppercase tracking-widest text-white shadow-lg shadow-green-100 transition hover:bg-green-600"
										type="submit" onclick="return confirm('Konfirmasi pembayaran ini?')">
										<i class="fas fa-check mr-2"></i> Konfirmasi
									</button>
								</form>
								<button
									class="rounded-xl bg-red-50 px-6 py-3 text-[10px] font-black uppercase tracking-widest text-red-600 transition hover:bg-red-600 hover:text-white"
									onclick="alert('Fitur penolakan akan datang')">
									<i class="fas fa-times mr-2"></i> Tolak
								</button>
							</div>
						</div>
					@endforeach
				</div>
			@endif
		</main>
	</body>

</html>
