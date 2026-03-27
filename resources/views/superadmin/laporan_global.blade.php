<!DOCTYPE html>
<html lang="id">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Laporan Global - HubTrans Owner</title>
		<script src="https://cdn.tailwindcss.com"></script>
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
	</head>

	<body class="bg-slate-50 font-sans">

		<div class="flex">
			<aside class="fixed left-0 top-0 z-50 hidden min-h-screen w-64 bg-slate-900 text-gray-300 shadow-2xl lg:block">
				<div class="p-8">
					<div class="mb-2 flex items-center gap-3">
						<div class="flex h-8 w-8 items-center justify-center rounded-lg bg-indigo-600 shadow-lg shadow-indigo-500/20">
							<i class="fas fa-shield-alt text-xs text-white"></i>
						</div>
						<h1 class="text-xl font-black uppercase italic tracking-tighter text-white">
							Hub<span class="text-indigo-500">Owner</span>
						</h1>
					</div>
					<p class="px-1 text-[9px] font-black uppercase tracking-[0.2em] text-slate-500">Superadmin Panel</p>
				</div>

				<nav class="mt-4 space-y-8 px-4">

					<div>
						<div class="mb-3 px-4 text-[10px] font-black uppercase tracking-widest text-slate-600">Main Overview</div>
						<div class="space-y-1">
							<a
								class="group flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-bold transition hover:bg-slate-800 hover:text-white"
								href="{{ route('super.dashboard') }}">
								<i class="fas fa-chart-line w-5 text-indigo-500 transition group-hover:scale-110"></i>
								Laporan Global
							</a>
						</div>
					</div>

					<div>
						<div class="mb-3 px-4 text-[10px] font-black uppercase tracking-widest text-slate-600">Access Control</div>
						<div class="space-y-1">
							<a
								class="group flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-bold transition hover:bg-slate-800 hover:text-white"
								href="{{ route('super.daftar') }}">
								<i class="fas fa-users-cog w-5 text-indigo-500 transition group-hover:scale-110"></i>
								Daftar Admin
							</a>
							<a
								class="group flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-bold transition hover:bg-slate-800 hover:text-white"
								href="{{ route('super.tambah') }}">
								<i class="fas fa-user-plus w-5 text-indigo-500 transition group-hover:scale-110"></i>
								Tambah Admin
							</a>
						</div>
					</div>

				</nav>

				<div class="absolute bottom-0 left-0 w-full border-t border-slate-800 bg-slate-900/50 p-6 backdrop-blur-md">
					<div class="mb-6 flex items-center gap-3 px-2">
						<img class="h-10 w-10 rounded-xl border border-slate-700 shadow-sm"
							src="https://ui-avatars.com/api/?name={{ auth()->user()->nama }}&background=4f46e5&color=fff" alt="Profile">
						<div class="overflow-hidden">
							<p class="truncate text-xs font-black uppercase text-white">{{ auth()->user()->nama }}</p>
							<p class="text-[9px] font-bold uppercase tracking-tighter text-indigo-400">Superadmin</p>
						</div>
					</div>
					<form method="POST" action="{{ route('logout') }}">
						@csrf
						<button
							class="flex w-full items-center justify-center gap-2 rounded-xl bg-red-500/10 py-3 text-[10px] font-black uppercase tracking-widest text-red-500 transition duration-300 hover:bg-red-500 hover:text-white active:scale-95"
							type="submit">
							<i class="fas fa-power-off"></i> Keluar Sistem
						</button>
					</form>
				</div>
			</aside>

			<main class="ml-64 flex-1 p-10">

				<div class="mb-10 flex items-end justify-between">
					<div>
						<h2 class="text-3xl font-black uppercase tracking-tighter text-slate-800">Laporan Finansial Global</h2>
						<p class="mt-1 text-sm font-bold uppercase tracking-widest text-indigo-500">Ringkasan Pendapatan Seluruh Moda</p>
					</div>
					<div class="flex gap-3">
						<div class="flex items-center gap-3 rounded-xl border border-slate-200 bg-white px-4 py-2 shadow-sm">
							<i class="fas fa-calendar-alt text-indigo-500"></i>
							<span class="text-xs font-black uppercase text-slate-600">Januari 2026</span>
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
						<p class="relative z-10 mb-3 text-[10px] font-black uppercase tracking-widest text-indigo-500 text-slate-400">
							Total Pendapatan</p>
						<h3 class="relative z-10 text-2xl font-black tracking-tighter text-slate-800">IDR 1.25B</h3>
						<p class="relative z-10 mt-2 text-[10px] font-bold text-green-500"><i class="fas fa-arrow-up mr-1"></i> 12% dari
							bulan lalu</p>
					</div>

					<div class="group relative overflow-hidden rounded-[2.5rem] border border-slate-100 bg-white p-8 shadow-sm">
						<p class="mb-3 text-[10px] font-black uppercase tracking-widest text-emerald-500 text-slate-400">Tiket Terjual</p>
						<h3 class="text-2xl font-black tracking-tighter text-slate-800">14,250 <span
								class="text-xs text-slate-300">Pcs</span></h3>
						<div class="mt-4 h-1.5 w-full rounded-full bg-slate-100">
							<div class="h-1.5 w-[75%] rounded-full bg-emerald-500"></div>
						</div>
					</div>

					<div class="rounded-[2.5rem] border border-slate-100 bg-white p-8 shadow-sm">
						<p class="mb-3 text-[10px] font-black uppercase tracking-widest text-blue-500 text-slate-400">Moda Terlaris</p>
						<div class="flex items-center gap-3">
							<div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
								<i class="fas fa-plane"></i>
							</div>
							<h3 class="text-xl font-black uppercase tracking-tight text-slate-800">Pesawat</h3>
						</div>
					</div>

					<div class="rounded-[2.5rem] border border-slate-100 bg-white p-8 shadow-sm">
						<p class="mb-3 text-[10px] font-black uppercase tracking-widest text-red-500 text-slate-400">Batal / Refund</p>
						<h3 class="text-2xl font-black tracking-tighter text-slate-800">84 <span
								class="text-xs text-slate-300">Tiket</span></h3>
						<p class="mt-2 text-[9px] font-bold uppercase tracking-tighter text-slate-400">0.5% dari total penjualan</p>
					</div>
				</div>

				<div class="overflow-hidden rounded-[3rem] border border-slate-100 bg-white shadow-xl shadow-slate-200/50">
					<div class="flex items-center justify-between border-b border-slate-50 p-8">
						<h3 class="text-sm font-black uppercase tracking-widest text-slate-800">Performansi Pendapatan per Moda</h3>
						<span class="rounded-full bg-indigo-100 px-3 py-1 text-[9px] font-black uppercase italic text-indigo-600">Data
							Terverifikasi</span>
					</div>
					<div class="overflow-x-auto">
						<table class="w-full border-collapse text-left">
							<thead>
								<tr class="bg-slate-50/50">
									<th class="p-6 text-[10px] font-black uppercase tracking-widest text-slate-400">Moda</th>
									<th class="p-6 text-[10px] font-black uppercase tracking-widest text-slate-400">Transaksi</th>
									<th class="p-6 text-[10px] font-black uppercase tracking-widest text-slate-400">Tiket Terjual</th>
									<th class="p-6 text-right text-[10px] font-black uppercase tracking-widest text-slate-400">Pendapatan Kotor
									</th>
									<th class="p-6 text-center text-[10px] font-black uppercase tracking-widest text-slate-400">Profit</th>
								</tr>
							</thead>
							<tbody class="divide-y divide-slate-50 text-sm font-bold">
								<?php
                            $data = [
                                ['name' => 'Pesawat', 'icon' => 'fa-plane', 'color' => 'blue', 'trx' => '4,120', 'tickets' => '6,200', 'rev' => '750,000,000', 'profit' => '+15%'],
                                ['name' => 'Kereta Api', 'icon' => 'fa-train', 'color' => 'orange', 'trx' => '2,850', 'tickets' => '4,100', 'rev' => '280,000,000', 'profit' => '+10%'],
                                ['name' => 'Bus (Travel)', 'icon' => 'fa-bus', 'color' => 'emerald', 'trx' => '1,450', 'tickets' => '2,450', 'rev' => '120,000,000', 'profit' => '+8%'],
                                ['name' => 'Kapal Laut', 'icon' => 'fa-ship', 'color' => 'indigo', 'trx' => '940', 'tickets' => '1,500', 'rev' => '100,000,000', 'profit' => '+5%'],
                            ];
                            foreach($data as $row):
                            ?>
								<tr class="group transition hover:bg-slate-50">
									<td class="p-6">
										<div class="flex items-center gap-4">
											<div
												class="bg-<?php echo $row['color']; ?>-50 text-<?php echo $row['color']; ?>-600 flex h-10 w-10 items-center justify-center rounded-2xl transition group-hover:scale-110">
												<i class="fas <?php echo $row['icon']; ?>"></i>
											</div>
											<span class="uppercase tracking-tighter text-slate-800"><?php echo $row['name']; ?></span>
										</div>
									</td>
									<td class="p-6 font-mono text-slate-400"><?php echo $row['trx']; ?></td>
									<td class="p-6 text-slate-500"><?php echo $row['tickets']; ?></td>
									<td class="p-6 text-right text-slate-800">IDR <?php echo $row['rev']; ?></td>
									<td class="p-6 text-center">
										<span
											class="rounded-lg bg-green-100 px-3 py-1 text-[10px] font-black uppercase italic text-green-600"><?php echo $row['profit']; ?></span>
									</td>
								</tr>
								<?php endforeach; ?>
							</tbody>
							<tfoot class="bg-slate-900 font-black text-white">
								<tr>
									<td class="p-8 text-xs uppercase italic tracking-widest" colspan="3">Grand Total Pendapatan</td>
									<td class="p-8 text-right text-xl tracking-tighter">IDR 1,250,000,000</td>
									<td class="p-8 text-center text-[10px] font-normal uppercase italic tracking-widest text-slate-400">Bulan
										Berjalan</td>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>

				<div class="mt-12 text-center opacity-20 grayscale">
					<h1 class="text-3xl font-black italic tracking-tighter">HUB<span class="text-indigo-600">TRANS</span></h1>
				</div>

			</main>
		</div>

	</body>

</html>
