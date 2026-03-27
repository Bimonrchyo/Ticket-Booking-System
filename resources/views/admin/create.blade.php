<!DOCTYPE html>
<html lang="id">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Tambah Armada Detail - HubTrans</title>
		<script src="https://cdn.tailwindcss.com"></script>
		<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
	</head>

	<body class="bg-gray-50 font-sans" x-data="{ moda: 'pesawat', openArmada: false, openJadwal: false }">



		<div class="flex">
			<aside class="fixed left-0 top-0 hidden min-h-screen w-64 bg-slate-900 text-gray-300 lg:block">
				<div class="p-6">
					<h1 class="text-2xl font-black uppercase italic tracking-tighter text-white">Hub<span
							class="text-blue-500">Admin</span></h1>
				</div>
				<nav class="mt-6 space-y-2 px-4" x-data="{ openArmada: false, openJadwal: false }">
					<a
						class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-bold transition hover:bg-slate-800 hover:text-white"
						href="{{ route('admin.dashboard') }}">
						<i class="fas fa-chart-pie w-5"></i> Dashboard
					</a>
					<div class="px-4 pb-2 pt-6 text-[10px] font-black uppercase tracking-widest text-slate-500">Manajemen</div>
					<a
						class="flex items-center gap-3 rounded-xl border-l-4 border-orange-500 bg-orange-600/20 px-4 py-3 text-sm font-bold text-orange-400 transition hover:bg-slate-800"
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
						class="relative flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-bold transition hover:bg-slate-800 hover:text-white"
						href="{{ route('admin.payments') }}">
						<i class="fas fa-check-circle w-5"></i> Verifikasi Bayar
						<span class="absolute right-4 rounded-full bg-red-500 px-1.5 text-[10px] text-white">3</span>
					</a>
				</nav>
			</aside>

			<main class="flex-1 p-8 lg:ml-64">
				<div class="mx-auto max-w-4xl">
					<header class="mb-8">
						<h2 class="text-2xl font-black uppercase tracking-tighter text-slate-800">Tambah Unit Armada</h2>
						<p class="text-sm font-bold uppercase tracking-widest text-gray-400">Input spesifikasi detail kendaraan</p>
					</header>

					<form class="rounded-[2.5rem] border border-gray-100 bg-white p-10 shadow-xl shadow-gray-200/50"
						action="proses-tambah.php" method="POST">

						<div class="mb-10">
							<label class="mb-4 block text-[11px] font-black uppercase tracking-[0.2em] text-gray-400">Jenis Moda
								Transportasi</label>
							<div class="grid grid-cols-2 gap-4 md:grid-cols-4">
								<template x-for="item in ['pesawat', 'bus', 'kereta', 'kapal']">
									<label class="group cursor-pointer">
										<input class="hidden" name="moda" type="radio" :value="item" x-model="moda">
										<div class="rounded-3xl border-2 p-4 text-center transition-all duration-300"
											:class="moda === item ? 'border-blue-600 bg-blue-50 ring-4 ring-blue-100' :
											    'border-gray-100 bg-gray-50 group-hover:border-blue-200'">
											<i class="fas fa-2x mb-2 transition-colors"
												:class="[
												    item === 'pesawat' ? 'fa-plane' : '',
												    item === 'bus' ? 'fa-bus' : '',
												    item === 'kereta' ? 'fa-train' : '',
												    item === 'kapal' ? 'fa-ship' : '',
												    moda === item ? 'text-blue-600' : 'text-gray-300'
												]"></i>
											<p class="text-[10px] font-black uppercase tracking-widest"
												:class="moda === item ? 'text-blue-600' : 'text-gray-400'" x-text="item"></p>
										</div>
									</label>
								</template>
							</div>
						</div>

						<div class="mb-10 grid grid-cols-1 gap-8 md:grid-cols-2">
							<div class="space-y-6">
								<div>
									<label class="mb-2 block text-[11px] font-black uppercase tracking-widest text-gray-400">Nama Unit /
										Maskapai</label>
									<input
										class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-5 py-4 text-sm font-bold outline-none transition focus:ring-2 focus:ring-blue-500"
										name="nama_unit" type="text" placeholder="Contoh: Garuda Indonesia / TransExpress">
								</div>
								<div>
									<label class="mb-2 block text-[11px] font-black uppercase tracking-widest text-gray-400">Kode / Nomor
										Registrasi</label>
									<input
										class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-5 py-4 text-sm font-bold uppercase text-blue-600 outline-none transition focus:ring-2 focus:ring-blue-500"
										name="kode_unit" type="text" placeholder="Contoh: PK-GAA / B 1234 TGC">
								</div>
							</div>

							<div class="space-y-6">
								<div>
									<label class="mb-2 block text-[11px] font-black uppercase tracking-widest text-gray-400">Tipe Kelas</label>
									<select
										class="w-full cursor-pointer appearance-none rounded-2xl border border-gray-200 bg-gray-50 px-5 py-4 text-sm font-bold outline-none focus:ring-2 focus:ring-blue-500"
										name="kelas">
										<option value="Ekonomi">Ekonomi</option>
										<option value="Bisnis">Bisnis</option>
										<option value="Eksekutif">Eksekutif</option>
										<option value="LCC">LCC (Low Cost Carrier)</option>
										<option value="Full Service">Full Service</option>
									</select>
								</div>
								<div>
									<label class="mb-2 block text-[11px] font-black uppercase tracking-widest text-gray-400">Total Kapasitas
										Kursi</label>
									<div class="relative">
										<input
											class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-5 py-4 text-sm font-bold outline-none transition focus:ring-2 focus:ring-blue-500"
											name="kapasitas" type="number" placeholder="0">
										<span
											class="absolute right-5 top-1/2 -translate-y-1/2 text-[10px] font-black uppercase text-gray-400">Kursi</span>
									</div>
								</div>
							</div>
						</div>

						<div class="mb-10 rounded-[2rem] border border-blue-100 bg-blue-50/50 p-8">
							<label
								class="mb-6 block flex items-center gap-2 text-[11px] font-black uppercase tracking-widest text-blue-800">
								<i class="fas fa-concierge-bell"></i> Fasilitas Armada
							</label>
							<div class="grid grid-cols-2 gap-y-4 md:grid-cols-3">
								<label class="group flex cursor-pointer items-center gap-3">
									<input class="h-5 w-5 rounded-lg border-gray-300 text-blue-600 focus:ring-blue-500" name="fasilitas[]"
										type="checkbox" value="makan">
									<span class="text-sm font-bold text-slate-600 transition group-hover:text-blue-600"><i
											class="fas fa-utensils w-5"></i> Makan</span>
								</label>
								<label class="group flex cursor-pointer items-center gap-3">
									<input class="h-5 w-5 rounded-lg border-gray-300 text-blue-600 focus:ring-blue-500" name="fasilitas[]"
										type="checkbox" value="usb">
									<span class="text-sm font-bold text-slate-600 transition group-hover:text-blue-600"><i
											class="fas fa-bolt w-5"></i> USB Port</span>
								</label>
								<label class="group flex cursor-pointer items-center gap-3">
									<input class="h-5 w-5 rounded-lg border-gray-300 text-blue-600 focus:ring-blue-500" name="fasilitas[]"
										type="checkbox" value="wifi">
									<span class="text-sm font-bold text-slate-600 transition group-hover:text-blue-600"><i
											class="fas fa-wifi w-5"></i> Wi-Fi</span>
								</label>
								<label class="group flex cursor-pointer items-center gap-3">
									<input class="h-5 w-5 rounded-lg border-gray-300 text-blue-600 focus:ring-blue-500" name="fasilitas[]"
										type="checkbox" value="bagasi" checked>
									<span class="text-sm font-bold text-slate-600 transition group-hover:text-blue-600"><i
											class="fas fa-suitcase w-5"></i> Bagasi (20kg)</span>
								</label>
								<label class="group flex cursor-pointer items-center gap-3">
									<input class="h-5 w-5 rounded-lg border-gray-300 text-blue-600 focus:ring-blue-500" name="fasilitas[]"
										type="checkbox" value="hiburan">
									<span class="text-sm font-bold text-slate-600 transition group-hover:text-blue-600"><i
											class="fas fa-tv w-5"></i> Hiburan</span>
								</label>
								<label class="group flex cursor-pointer items-center gap-3">
									<input class="h-5 w-5 rounded-lg border-gray-300 text-blue-600 focus:ring-blue-500" name="fasilitas[]"
										type="checkbox" value="ac" checked>
									<span class="text-sm font-bold text-slate-600 transition group-hover:text-blue-600"><i
											class="fas fa-snowflake w-5"></i> AC</span>
								</label>
							</div>
						</div>

						<div class="flex gap-4">
							<button
								class="flex-1 rounded-2xl border-2 border-gray-100 py-5 font-black uppercase tracking-widest text-gray-400 transition hover:bg-gray-50 active:scale-95"
								type="button">
								Batal
							</button>
							<button
								class="flex-[2] rounded-2xl bg-blue-600 py-5 font-black uppercase tracking-[0.2em] text-white shadow-xl shadow-blue-100 transition hover:bg-blue-700 active:scale-95"
								type="submit">
								Simpan Unit Armada
							</button>
						</div>

					</form>
				</div>
			</main>
		</div>

	</body>

</html>
