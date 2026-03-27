<!DOCTYPE html>
<html lang="id">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Admin Dashboard - HubTrans</title>
		<script src="https://cdn.tailwindcss.com"></script>
		<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
	</head>

	<body class="flex bg-gray-100 font-sans" x-data="{ openArmada: false, openJadwal: false }">

		<aside class="fixed left-0 top-0 hidden min-h-screen w-64 bg-slate-900 text-gray-300 shadow-2xl lg:block">
			<div class="border-b border-slate-700 p-6">
				<h1 class="text-2xl font-black uppercase italic tracking-tighter text-white">Hub<span
						class="text-blue-500">Admin</span></h1>
				<p class="mt-2 text-[9px] font-black uppercase tracking-widest text-slate-400">Admin Panel</p>
			</div>
			<nav class="mt-6 space-y-2 px-4">
				<a
					class="flex items-center gap-3 rounded-xl border-l-4 border-blue-500 bg-blue-600/20 px-4 py-3 text-sm font-bold text-blue-400 transition hover:bg-slate-800"
					href="{{ route('admin.dashboard') }}">
					<i class="fas fa-chart-pie w-5"></i> Dashboard
				</a>
				<div class="px-4 pb-2 pt-6 text-[10px] font-black uppercase tracking-widest text-slate-500">Manajemen</div>
				<a
					class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-bold transition hover:bg-slate-800 hover:text-white"
					href="#" x-data="{ open: false }" @click="open = !open">
					<i class="fas fa-bus w-5"></i> Kelola Armada
					<i class="fas fa-chevron-down ml-auto w-3" :class="open && 'rotate-180'"></i>
				</a>
				<div class="ml-4 space-y-1 text-sm" x-show="open">
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
					href="#" x-data="{ open: false }" @click="open = !open">
					<i class="fas fa-calendar-alt w-5"></i> Kelola Jadwal
					<i class="fas fa-chevron-down ml-auto w-3" :class="open && 'rotate-180'"></i>
				</a>
				<div class="ml-4 space-y-1 text-sm" x-show="open">
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
					class="relative flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-bold transition hover:bg-slate-800 hover:text-white"
					href="{{ route('admin.payments') }}">
					<i class="fas fa-check-circle w-5"></i> Verifikasi Bayar
					<span
						class="absolute right-4 rounded-full bg-red-500 px-1.5 text-[10px] text-white">{{ $totalPending ?? 0 }}</span>
				</a>
			</nav>
		</aside>

		<main class="flex-1 p-8 lg:ml-64">
			<header class="mb-10 flex items-center justify-between">
				<div>
					<h2 class="text-2xl font-black text-slate-800">Ringkasan Statistik</h2>
					<p class="text-sm font-medium uppercase tracking-wide text-slate-500">Laporan Penjualan Tiket per Moda</p>
				</div>
				<div class="flex items-center gap-4">
					<button class="rounded-lg border border-gray-200 bg-white p-2 text-gray-400 shadow-sm"><i
							class="fas fa-bell"></i></button>
					<div class="ml-4 flex items-center gap-3 rounded-full border border-gray-100 bg-white p-1 pr-4 shadow-sm">
						<div class="flex h-8 w-8 items-center justify-center rounded-full bg-blue-600 text-xs font-bold text-white">AD
						</div>
						<span class="text-xs font-black uppercase text-slate-700">Super Admin</span>
					</div>
				</div>
			</header>

			<div class="mb-10 grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
				<div
					class="transform rounded-2xl border border-gray-200 bg-white p-6 shadow-md transition-transform hover:-translate-y-1 hover:shadow-xl">
					<div class="mb-4 flex items-start justify-between">
						<div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-50 text-xl text-blue-600">
							<i class="fas fa-wallet"></i>
						</div>
						<span class="rounded-lg bg-green-50 px-2 py-1 text-xs font-bold text-green-500">+12.5%</span>
					</div>
					<p class="mb-1 text-[10px] font-black uppercase tracking-widest text-gray-400">Total Pendapatan</p>
					<h3 class="text-2xl font-black tracking-tighter text-slate-800">IDR 45.280.000</h3>
				</div>

				<div
					class="transform rounded-2xl border border-gray-200 bg-white p-6 shadow-md transition-transform hover:-translate-y-1 hover:shadow-xl">
					<div class="mb-4 flex items-start justify-between">
						<div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-orange-50 text-xl text-orange-600">
							<i class="fas fa-ticket"></i>
						</div>
						<span class="rounded-lg bg-orange-50 px-2 py-1 text-xs font-bold text-orange-500">Target: 80%</span>
					</div>
					<p class="mb-1 text-[10px] font-black uppercase tracking-widest text-gray-400">Tiket Terjual</p>
					<h3 class="text-2xl font-black tracking-tighter text-slate-800">1,245 <span
							class="text-xs text-gray-400">Pcs</span></h3>
				</div>

				<div
					class="transform rounded-2xl border border-gray-200 bg-white p-6 shadow-md transition-transform hover:-translate-y-1 hover:shadow-xl">
					<div class="mb-4 flex items-start justify-between">
						<div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-green-50 text-xl text-green-600">
							<i class="fas fa-user-check"></i>
						</div>
					</div>
					<p class="mb-1 text-[10px] font-black uppercase tracking-widest text-gray-400">Pengguna Aktif</p>
					<h3 class="text-2xl font-black tracking-tighter text-slate-800">892 <span class="text-xs text-gray-400">User</span>
					</h3>
				</div>

				<div
					class="transform rounded-2xl border border-gray-200 bg-white p-6 shadow-md transition-transform hover:-translate-y-1 hover:shadow-xl">
					<div class="mb-4 flex items-start justify-between">
						<div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-red-50 text-xl text-red-600">
							<i class="fas fa-clock"></i>
						</div>
					</div>
					<p class="mb-1 text-[10px] font-black uppercase tracking-widest text-gray-400">Menunggu Verifikasi</p>
					<h3 class="text-2xl font-black tracking-tighter text-slate-800">18 <span
							class="text-xs text-gray-400">Pesanan</span></h3>
				</div>
			</div>

			<div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
				<div
					class="transform rounded-2xl border border-gray-200 bg-white p-8 shadow-md transition-transform hover:-translate-y-1 hover:shadow-xl lg:col-span-2">
					<h3 class="mb-6 text-sm font-black uppercase text-slate-800">Tren Penjualan Mingguan</h3>
					<canvas id="salesChart" height="150"></canvas>
				</div>

				<div
					class="transform rounded-2xl border border-gray-200 bg-white p-8 shadow-md transition-transform hover:-translate-y-1 hover:shadow-xl">
					<h3 class="mb-6 text-sm font-black uppercase text-slate-800">Distribusi Moda</h3>
					<canvas id="modeChart"></canvas>
					<div class="mt-8 space-y-3">
						<div class="flex justify-between text-xs font-bold">
							<span class="text-blue-500"><i class="fas fa-plane mr-2"></i> PESAWAT</span>
							<span class="text-slate-700">45%</span>
						</div>
						<div class="flex justify-between text-xs font-bold">
							<span class="text-orange-500"><i class="fas fa-train mr-2"></i> KERETA</span>
							<span class="text-slate-700">35%</span>
						</div>
						<div class="flex justify-between text-xs font-bold">
							<span class="text-green-500"><i class="fas fa-bus mr-2"></i> BUS</span>
							<span class="text-slate-700">20%</span>
						</div>
					</div>
				</div>
			</div>
		</main>

		<script>
			// Chart Penjualan (Line)
			const ctxSales = document.getElementById('salesChart').getContext('2d');
			new Chart(ctxSales, {
				type: 'line',
				data: {
					labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
					datasets: [{
						label: 'Penjualan',
						data: [12, 19, 15, 25, 22, 35, 30],
						borderColor: '#2563eb',
						backgroundColor: 'rgba(37, 99, 235, 0.1)',
						fill: true,
						tension: 0.4,
						borderWidth: 4,
						pointRadius: 0
					}]
				},
				options: {
					plugins: {
						legend: {
							display: false
						}
					},
					scales: {
						y: {
							display: false
						},
						x: {
							grid: {
								display: false
							}
						}
					}
				}
			});

			// Chart Moda (Doughnut)
			const ctxMode = document.getElementById('modeChart').getContext('2d');
			new Chart(ctxMode, {
				type: 'doughnut',
				data: {
					labels: ['Pesawat', 'Kereta', 'Bus'],
					datasets: [{
						data: [45, 35, 20],
						backgroundColor: ['#3b82f6', '#f97316', '#22c55e'],
						borderWidth: 0,
						hoverOffset: 10
					}]
				},
				options: {
					plugins: {
						legend: {
							display: false
						}
					},
					cutout: '80%'
				}
			});
		</script>
	</body>

</html>
