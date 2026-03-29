<!DOCTYPE html>
<html lang="id">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Laporan Global - HubTrans Owner</title>
		<script src="https://cdn.tailwindcss.com"></script>
		<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
	</head>

	<body class="bg-slate-50 font-sans">
		<div class="flex">
			@include('superadmin.partials.sidebar')

			<main class="ml-64 flex-1 p-10">
				@if (session('success'))
					<div class="mb-6 rounded-2xl bg-green-100 p-4 text-green-800">
						{{ session('success') }}
					</div>
				@endif

				<div class="mb-10 flex items-end justify-between">
					<div>
						<h2 class="text-3xl font-black uppercase tracking-tighter text-slate-800">Laporan Finansial Global</h2>
						<p class="mt-1 text-sm font-bold uppercase tracking-widest text-indigo-500">Ringkasan Pendapatan Seluruh Moda</p>
					</div>
					<div class="flex gap-3">
						<div class="flex items-center gap-3 rounded-xl border border-slate-200 bg-white px-4 py-2 shadow-sm">
							<i class="fas fa-calendar-alt text-indigo-500"></i>
							<span class="text-xs font-black uppercase text-slate-600">Bulan Berjalan</span>
						</div>
						<button
							class="rounded-xl bg-slate-900 px-6 py-3 text-[10px] font-black uppercase tracking-[0.2em] text-white shadow-lg transition hover:bg-slate-800"
							onclick="window.print()">
							<i class="fas fa-file-export mr-2"></i> Ekspor PDF
						</button>
					</div>
				</div>

				<div class="mb-10 grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
					<div class="group relative overflow-hidden rounded-[2.5rem] border border-slate-100 bg-white p-8 shadow-sm">
						<div
							class="absolute -right-4 -top-4 h-24 w-24 rounded-full bg-indigo-50 transition duration-500 group-hover:scale-110">
						</div>
						<p class="relative z-10 mb-3 text-[10px] font-black uppercase tracking-widest text-indigo-500">Total Pendapatan
						</p>
						<h3 class="relative z-10 text-2xl font-black tracking-tighter text-slate-800">IDR
							{{ number_format($totalPendapatan ?? 0, 0, ',', '.') }}</h3>
						<p class="relative z-10 mt-2 text-[10px] font-bold text-green-500"><i class="fas fa-arrow-up mr-1"></i>
							{{ $totalBookings ?? 0 }} transaksi</p>
					</div>

					<div class="group relative overflow-hidden rounded-[2.5rem] border border-slate-100 bg-white p-8 shadow-sm">
						<p class="mb-3 text-[10px] font-black uppercase tracking-widest text-emerald-500">Total Users</p>
						<h3 class="text-2xl font-black tracking-tighter text-slate-800">{{ $totalUsers ?? 0 }} <span
								class="text-xs text-slate-300">Orang</span></h3>
						<div class="mt-4 h-1.5 w-full rounded-full bg-slate-100">
							<div class="h-1.5 w-[{{ ($totalUsers / 1000) * 100 }}%] rounded-full bg-emerald-500"
								style="width: {{ min(($totalUsers / 1000) * 100, 100) }}%;"></div>
						</div>
					</div>

					<div class="rounded-[2.5rem] border border-slate-100 bg-white p-8 shadow-sm">
						<p class="mb-3 text-[10px] font-black uppercase tracking-widest text-blue-500">Total Tiket Terjual</p>
						<div class="flex items-center gap-3">
							<div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
								<i class="fas fa-ticket-alt"></i>
							</div>
							<h3 class="text-xl font-black uppercase tracking-tight text-slate-800">{{ $totalBookings ?? 0 }}</h3>
						</div>
					</div>

					<div class="rounded-[2.5rem] border border-slate-100 bg-white p-8 shadow-sm">
						<p class="mb-3 text-[10px] font-black uppercase tracking-widest text-indigo-500">Total Income</p>
						<h3 class="text-2xl font-black tracking-tighter text-slate-800">IDR
							{{ number_format($totalIncome ?? 0, 0, ',', '.') }}</h3>
						<p class="mt-2 text-[9px] font-bold uppercase tracking-tighter text-slate-400">{{ $totalUsers ?? 0 }} users aktif
						</p>
					</div>
				</div>

				<div class="overflow-hidden rounded-[3rem] border border-slate-100 bg-white shadow-xl shadow-slate-200/50">
					<div class="flex items-center justify-between border-b border-slate-50 p-8">
						<h3 class="text-sm font-black uppercase tracking-widest text-slate-800">Pendapatan per Moda Transportasi</h3>
						<span class="rounded-full bg-indigo-100 px-3 py-1 text-[9px] font-black uppercase italic text-indigo-600">Data
							Terverifikasi</span>
					</div>
					@if (isset($laporanPerModa) && $laporanPerModa->count() > 0)
						<div class="overflow-x-auto">
							<table class="w-full">
								<thead>
									<tr class="bg-slate-50/50">
										<th class="p-6 text-[10px] font-black uppercase tracking-widest text-slate-400">Moda</th>
										<th class="p-6 text-[10px] font-black uppercase tracking-widest text-slate-400">Pendapatan</th>
										<th class="p-6 text-right text-[10px] font-black uppercase tracking-widest text-slate-400">Persentase</th>
									</tr>
								</thead>
								<tbody class="divide-y divide-slate-50">
									@foreach ($laporanPerModa as $item)
										<tr class="group transition hover:bg-slate-50">
											<td class="p-6">
												<div class="flex items-center gap-3">
													<i class="fas fa-{{ strtolower(str_replace(' ', '-', $item->tipe)) }} text-lg text-indigo-500"></i>
													<span class="font-semibold uppercase tracking-tighter text-slate-800">{{ $item->tipe }}</span>
												</div>
											</td>
											<td class="p-6 font-mono text-slate-800">IDR {{ number_format($item->total, 0, ',', '.') }}</td>
											<td class="p-6 text-right">
												<span class="rounded-lg bg-green-100 px-3 py-1 text-[10px] font-black uppercase text-green-600">
													{{ round(($item->total / $totalPendapatan) * 100, 1) }}%
												</span>
											</td>
										</tr>
									@endforeach
								</tbody>
								<tfoot class="bg-slate-900 font-black text-white">
									<tr>
										<td class="p-8 text-xs uppercase italic tracking-widest" colspan="2">Grand Total</td>
										<td class="p-8 text-right text-xl tracking-tighter">100%</td>
									</tr>
								</tfoot>
							</table>
						</div>
					@else
						<div class="p-12 text-center text-slate-400">
							<i class="fas fa-chart-bar mb-4 block text-5xl"></i>
							Belum ada data pendapatan.
						</div>
					@endif
				</div>

				<div class="mt-12 text-center opacity-75">
					<h1 class="text-3xl font-black italic tracking-tighter">HUB<span class="text-indigo-600">TRANS</span></h1>
					<p class="mt-2 text-sm text-slate-500">Sistem Integrasi Transportasi Lengkap</p>
				</div>
			</main>
		</div>
	</body>

</html>
