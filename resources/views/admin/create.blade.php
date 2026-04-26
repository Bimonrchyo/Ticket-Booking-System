<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Tambah Armada Detail - PastiTravel</title>
	<script src="https://cdn.tailwindcss.com"></script>
	<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-50 font-sans" x-data="{ moda: '{{ $type }}', openArmada: false, openJadwal: false }">

	<nav class="sticky top-0 z-50 bg-blue-700 p-4 shadow-md">
		<div class="container mx-auto flex flex-wrap items-center justify-between gap-4">
			<a class="flex items-center gap-2 text-xl font-bold text-white" href="{{ route('admin.dashboard') }}">
				<i class="fas fa-route"></i> PastiTravel
			</a>
			<div class="flex flex-wrap items-center gap-4 text-sm font-semibold text-white">
				<a class="hover:text-blue-200" href="{{ route('admin.dashboard') }}">Dashboard</a>
				<a class="hover:text-blue-200" href="{{ route('admin.payments') }}">Verifikasi</a>
				<form method="POST" action="{{ route('logout') }}">
					@csrf
					<button class="rounded-lg bg-orange-500 px-4 py-2 font-semibold transition hover:bg-orange-600"
						type="submit">Logout</button>
				</form>
			</div>
	</nav>

	<div class="flex">
		<aside class="fixed left-0 top-0 hidden min-h-screen w-64 bg-slate-900 text-gray-300 lg:block">
			<div class="p-6">
				<h1 class="text-2xl font-black uppercase italic tracking-tighter text-white">Pasti<span
						class="text-blue-500">Admin</span></h1>
			</div>
			<nav class="mt-6 space-y-2 px-4" x-data="{ openArmada: false, openJadwal: false }">
				<a class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-bold transition hover:bg-slate-800 hover:text-white"
					href="{{ route('admin.dashboard') }}">
					<i class="fas fa-chart-pie w-5"></i> Dashboard
				</a>
				<div class="px-4 pb-2 pt-6 text-[10px] font-black uppercase tracking-widest text-slate-500">Manajemen
				</div>
				<a class="flex items-center gap-3 rounded-xl border-l-4 px-4 py-3 text-sm font-bold transition hover:bg-slate-800"
					href="#" @click="openArmada = !openArmada">
					<i class="fas fa-bus w-5"></i> Kelola Armada
					<i class="fas fa-chevron-down ml-auto w-3" :class="openArmada && 'rotate-180'"></i>
				</a>
				<div class="ml-4 space-y-1 text-sm" x-show="openArmada">
					<a class="block rounded-lg px-4 py-2 text-xs transition hover:bg-slate-800"
						href="{{ route('transportasi.index', 'pesawat') }}">✈️
						Pesawat</a>
					<a class="block rounded-lg px-4 py-2 text-xs transition hover:bg-slate-800"
						href="{{ route('transportasi.index', 'bus') }}">🚌
						Bus</a>
					<a class="block rounded-lg px-4 py-2 text-xs transition hover:bg-slate-800"
						href="{{ route('transportasi.index', 'kereta') }}">🚂
						Kereta</a>
					<a class="block rounded-lg px-4 py-2 text-xs transition hover:bg-slate-800"
						href="{{ route('transportasi.index', 'kapal') }}">⛴️
						Kapal</a>
				</div>
				<a class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-bold transition hover:bg-slate-800 hover:text-white"
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
				<a class="relative flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-bold transition hover:bg-slate-800 hover:text-white"
					href="{{ route('admin.payments') }}">
					<i class="fas fa-check-circle w-5"></i> Verifikasi Bayar
					<span class="absolute right-4 rounded-full bg-red-500 px-1.5 text-[10px] text-white">3</span>
				</a>
			</nav>
		</aside>

		<main class="flex-1 p-8 lg:ml-64" x-data="{
    selectedArmada: '{{ old('transportasi_id', $jadwal->transportasi_id ?? '') }}',
    stok: {{ old('stok', isset($jadwal) ? $jadwal->stok_tersedia : 'null') }},

    armadaData: {
        @foreach ($armada ?? [] as $item)
		'{{ $item->id }}': {{ $item->kapasitas }}, @endforeach
    },

    get maxKapasitas() {
        return this.armadaData[this.selectedArmada] || 9999;
    }
}">
			<div class="mx-auto max-w-4xl">
				<header class="mb-8">
					<h2 class="text-2xl font-black uppercase tracking-tighter text-slate-800">
						@if (isset($armada))
							Tambah Jadwal {{ ucfirst($type) }}
						@else
							Tambah Unit Armada {{ ucfirst($type) }}
						@endif
					</h2>
					<p class="text-sm font-bold uppercase tracking-widest text-gray-400">
						@if (isset($armada))
							Input detail jadwal {{ ucfirst($type) }}
						@else
							Input spesifikasi detail kendaraan {{ ucfirst($type) }}
						@endif
					</p>

					@if (isset($armada))
						<form class="rounded-[2.5rem] border border-gray-100 bg-white p-10 shadow-xl shadow-gray-200/50"
							action="{{ route('jadwal.store', $type) }}" method="POST">
							@csrf

							<div class="mb-10">
								<label
									class="mb-4 block text-[11px] font-black uppercase tracking-[0.2em] text-gray-400">Pilih
									Armada</label>
								<select
									class="w-full cursor-pointer appearance-none rounded-2xl border border-gray-200 bg-gray-50 px-5 py-4 text-sm font-bold outline-none focus:ring-2 focus:ring-blue-500"
									name="transportasi_id" x-model="selectedArmada" required>
									<option value="">-- Pilih Armada --</option>
									@foreach ($armada as $item)
										<option value="{{ $item->id }}">{{ $item->nama_brand }} ({{ $item->kode_identitas }})
										</option>
									@endforeach
								</select>
							</div>

							<div class="mb-10 grid grid-cols-1 gap-8 md:grid-cols-2">
								<div class="space-y-6">
									<div>
										<label
											class="mb-2 block text-[11px] font-black uppercase tracking-widest text-gray-400">Titik
											Asal</label>
										<select
											class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-5 py-4 text-sm font-bold outline-none transition focus:ring-2 focus:ring-blue-500"
											name="asal">
											<option value="" disabled selected>Pilih Lokasi</option>
											@foreach ($lokasis as $lokasi)
												<option value="{{ $lokasi->id }}">{{ $lokasi->nama }}</option>
											@endforeach
										</select>
									</div>
									<div>
										<label
											class="mb-2 block text-[11px] font-black uppercase tracking-widest text-gray-400">Titik
											Tujuan</label>
										<select
											class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-5 py-4 text-sm font-bold outline-none transition focus:ring-2 focus:ring-blue-500"
											name="tujuan">
											<option value="" disabled selected>Pilih Lokasi</option>
											@foreach ($lokasis as $lokasi)
												<option value="{{ $lokasi->id }}">{{ $lokasi->nama }}</option>
											@endforeach
										</select>
									</div>

									<div class="space-y-6">
										<div>
											<label
												class="mb-2 block text-[11px] font-black uppercase tracking-widest text-gray-400">Waktu
												Berangkat</label>
											<input
												class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-5 py-4 text-sm font-bold outline-none transition focus:ring-2 focus:ring-blue-500"
												name="waktu" type="datetime-local" required>
										</div>
										<div>
											<label
												class="mb-2 block text-[11px] font-black uppercase tracking-widest text-gray-400">Harga
												Tiket</label>
											<div class="relative">
												<span
													class="absolute left-5 top-1/2 -translate-y-1/2 text-sm font-bold text-gray-400">Rp</span>
												<input
													class="w-full rounded-2xl border border-gray-200 bg-gray-50 py-4 pl-12 pr-5 text-sm font-bold outline-none transition focus:ring-2 focus:ring-blue-500"
													name="harga" type="number" placeholder="0" required>
											</div>
										</div>

										<div class="mb-10">
											<label
												class="mb-2 block text-[11px] font-black uppercase tracking-widest text-gray-400">Info
												Lokasi
												Penjemputan</label>
											<textarea
												class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-5 py-4 text-sm font-bold outline-none transition focus:ring-2 focus:ring-blue-500"
												name="lokasi" rows="3"
												placeholder="Contoh: Bandara Soekarno-Hatta, Terminal 2"
												required></textarea>
										</div>

										<div class="mb-10">
											<label
												class="mb-2 block text-[11px] font-black uppercase tracking-widest text-gray-400">Stok
												Tersedia</label>
											<input
												class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-5 py-4 text-sm font-bold outline-none transition focus:ring-2 focus:ring-blue-500"
												name="stok" type="number"
												:class="stok > maxKapasitas ? 'border-red-500 ring-2 ring-red-200' : ''"
												x-model="stok" :max="maxKapasitas"
												:placeholder="selectedArmada ? 'Maksimal ' + maxKapasitas : 'Pilih armada dulu'"
												required>
											</input>
										</div>
										@if ($errors->any())
											<div class="mb-4 rounded-2xl border border-red-200 bg-red-50 p-4">
												<ul class="list-inside list-disc text-sm text-red-600">
													@foreach ($errors->all() as $error)
														<li>{{ $error }}</li>
													@endforeach
												</ul>
											</div>
										@endif
										<div class="flex gap-4">
											<button
												class="flex-1 rounded-2xl border-2 border-gray-100 py-5 font-black uppercase tracking-widest text-gray-400 transition hover:bg-gray-50 active:scale-95"
												type="button" onclick="history.back()">
												Batal
											</button>
											<button
												class="flex-[2] rounded-2xl bg-blue-600 py-5 font-black uppercase tracking-[0.2em] text-white shadow-xl shadow-blue-100 transition hover:bg-blue-700 active:scale-95"
												type="submit">
												Simpan Jadwal
											</button>
										</div>
						</form>
					@else
						<form class="rounded-[2.5rem] border border-gray-100 bg-white p-10 shadow-xl shadow-gray-200/50"
							action="{{ route('transportasi.store', $type) }}" method="POST">
							@csrf

							<div class="mb-10">
								<label
									class="mb-4 block text-[11px] font-black uppercase tracking-[0.2em] text-gray-400">Jenis
									Moda
									Transportasi</label>
								<div class="grid grid-cols-2 gap-4 md:grid-cols-4">
									<template x-for="item in ['pesawat', 'bus', 'kereta', 'kapal']">
										<label class="group cursor-pointer">
											<input class="hidden" name="moda" type="radio" :value="item" x-model="moda">
											<div class="rounded-3xl border-2 p-4 text-center transition-all duration-300"
												:class="moda === item ? 'border-blue-600 bg-blue-50 ring-4 ring-blue-100' :
																	'border-gray-100 bg-gray-50 group-hover:border-blue-200'">
												<i class="fas fa-2x mb-2 transition-colors" :class="[
																		item === 'pesawat' ? 'fa-plane' : '',
																		item === 'bus' ? 'fa-bus' : '',
																		item === 'kereta' ? 'fa-train' : '',
																		item === 'kapal' ? 'fa-ship' : '',
																		moda === item ? 'text-blue-600' : 'text-gray-300'
																	]"></i>
												<p class="text-[10px] font-black uppercase tracking-widest"
													:class="moda === item ? 'text-blue-600' : 'text-gray-400'"
													x-text="item"></p>
											</div>
										</label>
									</template>
								</div>

								<div class="mb-10 grid grid-cols-1 items-center gap-8 md:grid-cols-2">
									<div>
										<label
											class="mb-2 block text-[11px] font-black uppercase tracking-widest text-gray-400">Nama
											Brand /
											Maskapai</label>
										<input
											class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-5 py-4 text-sm font-bold outline-none transition focus:ring-2 focus:ring-blue-500"
											name="nama_brand" type="text"
											placeholder="Contoh: Garuda Indonesia / TransExpress" required>
									</div>
									<div>
										<label
											class="mb-2 block text-[11px] font-black uppercase tracking-widest text-gray-400">Kode
											Identitas</label>
										<input
											class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-5 py-4 text-sm font-bold uppercase text-blue-600 outline-none transition focus:ring-2 focus:ring-blue-500"
											name="kode_identitas" type="text" placeholder="Contoh: PK-GAA / B 1234 TGC"
											required>
									</div>
									<div>
										<label
											class="mb-2 block text-[11px] font-black uppercase tracking-widest text-gray-400">Total
											Kapasitas
											Kursi</label>
										<div class="relative">
											<input
												class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-5 py-4 text-sm font-bold outline-none transition focus:ring-2 focus:ring-blue-500"
												name="kapasitas" type="number" placeholder="0" required>
											<span
												class="absolute right-5 top-1/2 -translate-y-1/2 text-[10px] font-black uppercase text-gray-400">Kursi</span>
										</div>
										<div>
											<label
												class="mb-2 block text-[11px] font-black uppercase tracking-widest text-gray-400">Layout
												Kursi</label>
											<select
												class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-5 py-4 text-sm font-bold"
												name="seat_layout">
												<option value="bus">Bus AKAP (2-2): A Jendela, B Gang | C Gang, D Jendela
												</option>
												<option value="kereta">Kereta Ekonomi (2-3): A Jendela, B Gang | C Gang, D
													Tengah, E Jendela</option>
												<option value="pesawat">Pesawat Narrow Body (3-3): A Jendela, B Tengah, C
													Gang | D Gang, E Tengah, F Jendela</option>
												<option value="kapal">Kapal Ferry (2-2): A Jendela, B Gang | C Gang, D
													Jendela</option>
											</select>
											<p class="mt-1 text-[9px] text-gray-500">Layout akan otomatis diterapkan sesuai
												standar
												Indonesia</p>
										</div>

										<div class="mb-10 rounded-[2rem] border border-blue-100 bg-blue-50/50 p-8">
											<label
												class="mb-6 block flex items-center gap-2 text-[11px] font-black uppercase tracking-widest text-blue-800">
												<i class="fas fa-concierge-bell"></i> Fasilitas Armada
											</label>
											<div class="grid grid-cols-2 gap-y-4 md:grid-cols-3">
												<label class="group flex cursor-pointer items-center gap-3">
													<input
														class="h-5 w-5 rounded-lg border-gray-300 text-blue-600 focus:ring-blue-500"
														name="fasilitas[]" type="checkbox" value="makan">
													<span
														class="text-sm font-bold text-slate-600 transition group-hover:text-blue-600"><i
															class="fas fa-utensils w-5"></i> Makan</span>
												</label>
												<label class="group flex cursor-pointer items-center gap-3">
													<input
														class="h-5 w-5 rounded-lg border-gray-300 text-blue-600 focus:ring-blue-500"
														name="fasilitas[]" type="checkbox" value="usb">
													<span
														class="text-sm font-bold text-slate-600 transition group-hover:text-blue-600"><i
															class="fas fa-bolt w-5"></i> USB Port</span>
												</label>
												<label class="group flex cursor-pointer items-center gap-3">
													<input
														class="h-5 w-5 rounded-lg border-gray-300 text-blue-600 focus:ring-blue-500"
														name="fasilitas[]" type="checkbox" value="wifi">
													<span
														class="text-sm font-bold text-slate-600 transition group-hover:text-blue-600"><i
															class="fas fa-wifi w-5"></i> Wi-Fi</span>
												</label>
												<label class="group flex cursor-pointer items-center gap-3">
													<input
														class="h-5 w-5 rounded-lg border-gray-300 text-blue-600 focus:ring-blue-500"
														name="fasilitas[]" type="checkbox" value="bagasi" checked>
													<span
														class="text-sm font-bold text-slate-600 transition group-hover:text-blue-600"><i
															class="fas fa-suitcase w-5"></i> Bagasi (20kg)</span>
												</label>
												<label class="group flex cursor-pointer items-center gap-3">
													<input
														class="h-5 w-5 rounded-lg border-gray-300 text-blue-600 focus:ring-blue-500"
														name="fasilitas[]" type="checkbox" value="hiburan">
													<span
														class="text-sm font-bold text-slate-600 transition group-hover:text-blue-600"><i
															class="fas fa-tv w-5"></i> Hiburan</span>
												</label>
												<label class="group flex cursor-pointer items-center gap-3">
													<input
														class="h-5 w-5 rounded-lg border-gray-300 text-blue-600 focus:ring-blue-500"
														name="fasilitas[]" type="checkbox" value="ac" checked>
													<span
														class="text-sm font-bold text-slate-600 transition group-hover:text-blue-600"><i
															class="fas fa-snowflake w-5"></i> AC</span>
												</label>
											</div>

											<div class="flex gap-4">
												<button
													class="flex-1 rounded-2xl border-2 border-gray-100 py-5 font-black uppercase tracking-widest text-gray-400 transition hover:bg-gray-50 active:scale-95"
													type="button" onclick="history.back()">
													Batal
												</button>
												<button
													class="flex-[2] rounded-2xl bg-blue-600 py-5 font-black uppercase tracking-[0.2em] text-white shadow-xl shadow-blue-100 transition hover:bg-blue-700 active:scale-95"
													type="submit">
													Simpan Unit Armada
												</button>
											</div>

						</form>
					@endif
			</div>
		</main>
	</div>

</body>

</html>