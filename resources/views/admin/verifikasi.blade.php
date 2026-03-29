@extends('layouts.app')

@section('title', 'Verifikasi Pembayaran | PastiTravel')

@section('nav-links')
	<a class="hover:text-blue-200" href="{{ route('admin.dashboard') }}">Dashboard</a>
	<a class="border-b-2 border-orange-400 text-orange-400" href="{{ route('admin.payments') }}">Verifikasi</a>
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
						class="flex items-center gap-3 rounded-xl bg-slate-800 px-4 py-3 text-sm font-bold text-white transition hover:bg-slate-700"
						href="{{ route('admin.payments') }}">
						<i class="fas fa-check-circle w-5"></i> Verifikasi Bayar
						@if (isset($payments) && $payments->count() > 0)
							<span class="ml-auto rounded-full bg-red-500 px-1.5 text-[10px] text-white">{{ $payments->count() }}</span>
						@endif
					</a>
				</nav>
			</aside>

			<main class="flex-1 p-8 lg:ml-64">
				<div class="mx-auto max-w-7xl">

					<div class="mb-8">
						<h1 class="text-3xl font-black uppercase tracking-tighter text-slate-800">Verifikasi Pembayaran</h1>
						<p class="text-lg font-bold uppercase tracking-widest text-gray-400">Validasi bukti transfer pelanggan</p>
					</div>

					@if (session('success'))
						<div class="mb-6 rounded-xl border border-green-200 bg-green-50 p-4">
							<div class="flex items-center gap-3">
								<i class="fas fa-check-circle text-green-600"></i>
								<p class="text-green-800">{{ session('success') }}</p>
							</div>
						</div>
					@endif

					@if (session('error'))
						<div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4">
							<div class="flex items-center gap-3">
								<i class="fas fa-exclamation-triangle text-red-600"></i>
								<p class="text-red-800">{{ session('error') }}</p>
							</div>
						</div>
					@endif

					<div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-xl shadow-gray-200/50">
						@if (isset($payments) && $payments->count() > 0)
							<div class="overflow-x-auto">
								<table class="w-full">
									<thead class="border-b border-gray-200 bg-gray-50">
										<tr>
											<th class="px-6 py-4 text-left text-xs font-black uppercase tracking-wider text-gray-500">Pelanggan</th>
											<th class="px-6 py-4 text-left text-xs font-black uppercase tracking-wider text-gray-500">Transportasi</th>
											<th class="px-6 py-4 text-left text-xs font-black uppercase tracking-wider text-gray-500">Rute</th>
											<th class="px-6 py-4 text-left text-xs font-black uppercase tracking-wider text-gray-500">Total Bayar</th>
											<th class="px-6 py-4 text-left text-xs font-black uppercase tracking-wider text-gray-500">Bukti Transfer</th>
											<th class="px-6 py-4 text-left text-xs font-black uppercase tracking-wider text-gray-500">Aksi</th>
										</tr>
									</thead>
									<tbody class="divide-y divide-gray-200">
										@foreach ($payments as $booking)
											<tr class="transition hover:bg-gray-50">
												<td class="px-6 py-4">
													<div class="flex items-center gap-3">
														<div class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-100">
															<i class="fas fa-user text-blue-600"></i>
														</div>
														<div>
															<p class="font-semibold text-gray-900">{{ $booking->user->name }}</p>
															<p class="text-sm text-gray-500">{{ $booking->user->email }}</p>
														</div>
													</div>
												</td>
												<td class="px-6 py-4">
													<div>
														<p class="font-semibold text-gray-900">{{ $booking->jadwal->transportasi->nama_brand }}</p>
														<p class="text-sm text-gray-500">{{ $booking->jadwal->transportasi->kode_identitas }}</p>
													</div>
												</td>
												<td class="px-6 py-4">
													<div>
														<p class="font-semibold text-gray-900">{{ $booking->jadwal->titik_asal }} →
															{{ $booking->jadwal->titik_tujuan }}</p>
														<p class="text-sm text-gray-500">
															{{ \Carbon\Carbon::parse($booking->jadwal->waktu_berangkat)->format('d/m/Y H:i') }}</p>
													</div>
												</td>
												<td class="px-6 py-4">
													<p class="text-lg font-bold text-green-600">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</p>
												</td>
												<td class="px-6 py-4">
													@if ($booking->payment && $booking->payment->bukti_transfer)
														<a
															class="inline-flex items-center gap-2 rounded-lg bg-blue-100 px-3 py-2 text-sm font-semibold text-blue-700 transition hover:bg-blue-200"
															href="{{ asset('storage/' . $booking->payment->bukti_transfer) }}" target="_blank">
															<i class="fas fa-image"></i>
															Lihat Bukti
														</a>
													@else
														<span class="text-gray-400">Tidak ada bukti</span>
													@endif
												</td>
												<td class="px-6 py-4">
													<div class="flex gap-2">
														<form class="inline" action="{{ route('admin.approve', $booking->id) }}" method="POST">
															@csrf
															@method('PATCH')
															<button
																class="inline-flex items-center gap-2 rounded-lg bg-green-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-green-700"
																type="submit" onclick="return confirm('Yakin ingin menyetujui pembayaran ini?')">
																<i class="fas fa-check"></i>
																Setujui
															</button>
														</form>
														<button
															class="inline-flex items-center gap-2 rounded-lg bg-red-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-red-700"
															type="button" onclick="alert('Fitur tolak pembayaran akan ditambahkan nanti')">
															<i class="fas fa-times"></i>
															Tolak
														</button>
													</div>
												</td>
											</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						@else
							<div class="py-16 text-center">
								<div class="mx-auto mb-4 flex h-24 w-24 items-center justify-center rounded-full bg-gray-100">
									<i class="fas fa-check-circle text-4xl text-gray-400"></i>
								</div>
								<h3 class="mb-2 text-lg font-semibold text-gray-900">Tidak ada pembayaran pending</h3>
								<p class="text-gray-500">Semua pembayaran sudah diverifikasi atau belum ada yang upload bukti transfer.</p>
							</div>
						@endif
					</div>

				</div>
			</main>
		</div>

	</div>
@endsection
