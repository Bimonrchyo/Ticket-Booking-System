<!DOCTYPE html>
<html lang="id">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Histori Pesanan - HubTrans</title>
		<script src="https://cdn.tailwindcss.com"></script>
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
	</head>

	<body class="bg-gray-50 font-sans">

		<nav class="sticky top-0 z-50 bg-blue-700 p-4 shadow-md">
			<div class="container mx-auto flex items-center justify-between">
				<a class="flex items-center gap-2 text-xl font-bold text-white" href="{{ route('home') }}">
					<i class="fas fa-route"></i> HubTrans
				</a>
				<div class="hidden items-center space-x-6 text-sm font-semibold text-white md:flex">
					<a class="hover:text-blue-200" href="{{ route('home') }}">Beranda</a>
					<a class="border-b-2 border-orange-400 text-orange-400" href="{{ route('history') }}">Histori</a>
					<div class="flex items-center gap-2 rounded-xl bg-blue-800 px-3 py-1.5">
						<i class="fas fa-user-circle text-lg"></i>
						<span>{{ auth()->user()->nama }}</span>
					</div>
				</div>
			</div>
		</nav>

		<div class="mx-auto max-w-4xl space-y-4 p-6">
			<div class="mb-8 flex items-end justify-between">
				<div>
					<h2 class="text-2xl font-black uppercase tracking-tighter text-gray-800">Histori Pesanan</h2>
					<p class="text-xs text-gray-400">Pantau semua aktivitas perjalanan dan transaksi Anda.</p>
				</div>
			</div>

			@forelse($histori as $booking)
				@php
					$statusColor = match ($booking->status) {
					    'pending' => 'yellow',
					    'paid' => 'green',
					    'cancelled' => 'red',
					    default => 'gray',
					};
					$statusLabel = match ($booking->status) {
					    'pending' => 'Menunggu Pembayaran',
					    'paid' => 'Selesai',
					    'cancelled' => 'Dibatalkan',
					    default => 'Unknown',
					};
					$modaIcon = match ($booking->jadwal->transportasi->tipe) {
					    'pesawat' => 'fa-plane',
					    'kereta' => 'fa-train',
					    'bus' => 'fa-bus',
					    'kapal' => 'fa-ship',
					    default => 'fa-ticket-alt',
					};
				@endphp

				<div
					class="border-l-{{ $statusColor }}-500 relative flex flex-col items-center gap-6 overflow-hidden rounded-3xl border border-l-4 border-gray-200 bg-white p-6 shadow-lg ring-1 ring-gray-50 md:flex-row">

					<div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gray-50 text-xl text-blue-600 shadow-inner">
						<i class="fas {{ $modaIcon }}"></i>
					</div>

					<div class="flex-1 text-center md:text-left">
						<div class="mb-1 flex items-center justify-center gap-2 md:justify-start">
							<span class="text-[9px] font-black uppercase tracking-widest text-gray-400">{{ $booking->kode_booking }}</span>

							@if ($booking->status === 'pending')
								<span
									class="rounded bg-yellow-100 px-2 py-0.5 text-[9px] font-black uppercase italic text-yellow-700">{{ $statusLabel }}</span>
							@elseif($booking->status === 'paid')
								<span
									class="rounded bg-green-100 px-2 py-0.5 text-[9px] font-black uppercase italic text-green-700">{{ $statusLabel }}</span>
							@else
								<span
									class="rounded bg-red-100 px-2 py-0.5 text-[9px] font-black uppercase italic text-red-700">{{ $statusLabel }}</span>
							@endif
						</div>
						<h4 class="text-lg font-black text-gray-800">{{ $booking->jadwal->asal->nama }} &rarr;
							{{ $booking->jadwal->tujuan->nama }}</h4>
						<p class="text-[10px] font-bold uppercase tracking-wide text-gray-400">
							{{ \Carbon\Carbon::parse($booking->jadwal->waktu_berangkat)->translatedFormat('d M Y, H:i') }} WIB
						</p>
					</div>

					<div class="hidden border-r border-gray-50 px-6 text-right md:block">
						<p class="text-[9px] font-black uppercase text-gray-300">Total Bayar</p>
						<p class="font-black tracking-tighter text-blue-700">IDR {{ number_format($booking->total_harga, 0, ',', '.') }}
						</p>
					</div>

					<div class="flex w-full flex-row gap-3 md:w-40 md:flex-col">
						@if ($booking->status === 'pending')
							<a
								class="group flex w-full items-center justify-center gap-2 py-2 text-[10px] font-black uppercase tracking-widest text-blue-600 transition hover:text-blue-800"
								href="{{ route('pembayaran', $booking->id) }}">
								Detail & Bayar
								<i class="fas fa-chevron-right text-[8px] transition-transform group-hover:translate-x-1"></i>
							</a>
						@elseif($booking->status === 'paid')
							<a
								class="flex flex-1 items-center justify-center gap-2 rounded-xl bg-green-500 px-4 py-2.5 text-[10px] font-black uppercase tracking-widest text-white shadow-lg shadow-green-100 transition hover:bg-green-600"
								href="{{ route('ticket.print', $booking->id) }}">
								<i class="fas fa-download"></i> E-Tiket
							</a>
							<a
								class="flex-1 rounded-xl border-2 border-gray-100 px-4 py-2.5 text-[10px] font-black uppercase tracking-widest text-gray-500 transition hover:bg-gray-50"
								href="{{ route('invoice.print', $booking->id) }}">
								Struk
							</a>
						@else
							<button
								class="flex-1 cursor-not-allowed rounded-xl border border-gray-100 px-4 py-2 text-[10px] font-black uppercase tracking-widest text-gray-400 transition">
								Detail
							</button>
						@endif
					</div>
				</div>
			@empty
				<div class="rounded-3xl border border-gray-200 bg-white p-12 text-center shadow-lg">
					<div class="mx-auto mb-4 flex h-20 w-20 items-center justify-center rounded-full bg-gray-100">
						<i class="fas fa-inbox text-4xl text-gray-300"></i>
					</div>
					<h3 class="mb-2 text-xl font-black text-gray-700">Belum Ada Pesanan</h3>
					<p class="mb-6 text-sm text-gray-400">Mulai pesan tiket perjalanan Anda sekarang!</p>
					<a class="inline-block rounded-xl bg-blue-600 px-6 py-3 text-sm font-black text-white transition hover:bg-blue-700"
						href="{{ route('home') }}">
						Cari Perjalanan
					</a>
				</div>
			@endforelse

		</div>

		<div class="fixed bottom-0 left-0 right-0 z-50 flex justify-around border-t bg-white py-3 md:hidden">
			<a class="flex flex-col items-center text-gray-400" href="{{ route('home') }}">
				<i class="fas fa-search text-xl"></i>
				<span class="mt-1 text-[10px] font-bold">Cari</span>
			</a>
			<a class="flex flex-col items-center text-blue-600" href="{{ route('history') }}">
				<i class="fas fa-history text-xl"></i>
				<span class="mt-1 text-[10px]">Histori</span>
			</a>
			<form class="flex flex-col items-center text-gray-400" method="POST" action="{{ route('logout') }}">
				@csrf
				<button class="flex w-full flex-col items-center" type="submit">
					<i class="fas fa-sign-out-alt text-xl"></i>
					<span class="mt-1 text-[10px] font-bold">Keluar</span>
				</button>
			</form>
		</div>

	</body>

</html>
