<!DOCTYPE html>
<html lang="id">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Edit {{ isset($transportasi) ? 'Armada' : 'Jadwal' }} - HubTrans</title>
		<script src="https://cdn.tailwindcss.com"></script>
		<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
	</head>

	<body class="bg-gray-50 font-sans" x-data="{ openArmada: false, openJadwal: false }">

		<nav class="sticky top-0 z-50 bg-blue-700 p-4 shadow-md">
			<div class="container mx-auto flex flex-wrap items-center justify-between gap-4">
				<a class="flex items-center gap-2 text-xl font-bold text-white" href="{{ route('admin.dashboard') }}">
					<i class="fas fa-route"></i> HubTrans
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
			</div>
		</nav>

		<div class="flex">
			<aside class="fixed left-0 top-0 hidden min-h-screen w-64 bg-slate-900 text-gray-300 lg:block">
				<div class="p-6">
					<h1 class="text-2xl font-black uppercase italic tracking-tighter text-white">Hub<span
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
						class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-bold transition hover:bg-slate-800 hover:text-white"
						href="{{ route('admin.payments') }}">
						<i class="fas fa-check-circle w-5"></i> Verifikasi Bayar
					</a>
				</nav>
			</aside>

			<main class="flex-1 p-8 lg:ml-64" x-data="{
    // Gunakan null coalescing (??) untuk semua variabel yang mungkin tidak ada
    selectedArmada: '{{ old('transportasi_id', $jadwal->transportasi_id ?? '') }}',

    // Gunakan 'null' sebagai string agar jika kosong, stok di Alpine jadi null (placeholder muncul)
    stok: {{ old('stok', $jadwal->stok_tersedia ?? 'null') }},

    armadaData: {
        {{-- Gunakan ?? [] agar jika $armada tidak ada, loop tidak error --}}
        @foreach ($armada ?? [] as $item)
            '{{ $item->id }}': {{ $item->kapasitas }}, @endforeach
    },

    get maxKapasitas() {
        {{-- Jika sedang edit transportasi, armadaData mungkin kosong, beri default besar --}}
        return this.armadaData[this.selectedArmada] || 9999;
    }
}">
				<div class="mx-auto max-w-4xl">
					<header class="mb-8">
						<h2 class="text-2xl font-black uppercase tracking-tighter text-slate-800">
							Edit {{ isset($transportasi) ? 'Unit Armada' : 'Jadwal' }} {{ ucfirst($type) }}
						</h2>
						<p class="text-sm font-bold uppercase tracking-widest text-gray-400">
							Update {{ isset($transportasi) ? 'spesifikasi detail kendaraan' : 'informasi jadwal' }} {{ ucfirst($type) }}
						</p>
					</header>

					@if (isset($transportasi))
						<!-- Form Edit Transportasi -->
						<form class="rounded-[2.5rem] border border-gray-100 bg-white p-10 shadow-xl shadow-gray-200/50"
							action="{{ route('transportasi.update', [$type, $transportasi]) }}" method="POST">
							@csrf
							@method('PATCH')

							<div class="mb-10 grid grid-cols-1 gap-8 md:grid-cols-2">

								<div>
									<label class="mb-2 block text-[11px] font-black uppercase tracking-widest text-gray-400">Nama Brand /
										Maskapai</label>
									<input
										class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-5 py-4 text-sm font-bold outline-none transition focus:ring-2 focus:ring-blue-500"
										name="nama_brand" type="text" value="{{ old('nama_brand', $transportasi->nama_brand) }}" required>
								</div>
								<div>
									<label class="mb-2 block text-[11px] font-black uppercase tracking-widest text-gray-400">Kode
										Identitas</label>
									<input
										class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-5 py-4 text-sm font-bold uppercase text-blue-600 outline-none transition focus:ring-2 focus:ring-blue-500"
										name="kode_identitas" type="text" value="{{ old('kode_identitas', $transportasi->kode_identitas) }}"
										required>
								</div>



								<div>
									<label class="mb-2 block text-[11px] font-black uppercase tracking-widest text-gray-400">Total Kapasitas
										Kursi</label>
									<div class="relative">
										<input
											class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-5 py-4 text-sm font-bold outline-none transition focus:ring-2 focus:ring-blue-500"
											name="kapasitas" type="number" value="{{ old('kapasitas', $transportasi->kapasitas) }}" required>
										<span
											class="absolute right-5 top-1/2 -translate-y-1/2 text-[10px] font-black uppercase text-gray-400">Kursi</span>
									</div>
								</div>

							</div>
							<div class="mb-10 rounded-[2rem] border border-blue-100 bg-blue-50/50 p-8">
								<label
									class="mb-6 block flex items-center gap-2 text-[11px] font-black uppercase tracking-widest text-blue-800">
									<i class="fas fa-concierge-bell"></i> Fasilitas Armada
								</label>
								<div class="grid grid-cols-2 gap-y-4 md:grid-cols-3">
									@php
										// Ambil fasilitas yang sudah ada, pastikan formatnya array
										$currentFasilitas = is_array($transportasi->fasilitas) ? $transportasi->fasilitas : [];
									@endphp

									{{-- Gunakan array untuk looping agar lebih bersih --}}
									@foreach ([
								'makan' => ['icon' => 'fa-utensils', 'label' => 'Makan'],
								'usb' => ['icon' => 'fa-bolt', 'label' => 'USB Port'],
								'wifi' => ['icon' => 'fa-wifi', 'label' => 'Wi-Fi'],
								'bagasi' => ['icon' => 'fa-suitcase', 'label' => 'Bagasi (20kg)'],
								'hiburan' => ['icon' => 'fa-tv', 'label' => 'Hiburan'],
								'ac' => ['icon' => 'fa-snowflake', 'label' => 'AC'],
				] as $value => $item)
										<label class="group flex cursor-pointer items-center gap-3">
											<input class="h-5 w-5 rounded-lg border-gray-300 text-blue-600 focus:ring-blue-500" name="fasilitas[]"
												type="checkbox" value="{{ $value }}" {{ in_array($value, $currentFasilitas) ? 'checked' : '' }}>
											<span class="text-sm font-bold text-slate-600 transition group-hover:text-blue-600">
												<i class="fas {{ $item['icon'] }} w-5"></i> {{ $item['label'] }}
											</span>
										</label>
									@endforeach
								</div>
							</div>

							<div class="flex gap-4">
								<a
									class="flex-1 rounded-2xl border-2 border-gray-100 py-5 text-center font-black uppercase tracking-widest text-gray-400 transition hover:bg-gray-50"
									href="{{ route('transportasi.index', $type) }}">
									Batal
								</a>
								<button
									class="flex-[2] rounded-2xl bg-blue-600 py-5 font-black uppercase tracking-[0.2em] text-white shadow-xl shadow-blue-100 transition hover:bg-blue-700"
									type="submit">
									Update Unit Armada
								</button>
							</div>
						</form>
					@else
						<!-- Form Edit Jadwal -->
						<form class="rounded-[2.5rem] border border-gray-100 bg-white p-10 shadow-xl shadow-gray-200/50"
							action="{{ route('jadwal.update', [$type, $jadwal]) }}" method="POST">
							@csrf
							@method('PATCH')

							<div class="mb-10">
								<label class="mb-4 block text-[11px] font-black uppercase tracking-[0.2em] text-gray-400">Pilih Armada</label>
								<select
									class="w-full cursor-pointer appearance-none rounded-2xl border border-gray-200 bg-gray-50 px-5 py-4 text-sm font-bold outline-none focus:ring-2 focus:ring-blue-500"
									name="transportasi_id" x-model="selectedArmada" required>
									<option value="">-- Pilih Armada --</option>
									@foreach ($armada as $item)
										<option value="{{ $item->id }}"
											{{ old('transportasi_id', $jadwal->transportasi_id) == $item->id ? 'selected' : '' }}>
											{{ $item->nama_brand }} ({{ $item->kode_identitas }})
										</option>
									@endforeach
								</select>
							</div>

							<div class="mb-10 grid grid-cols-1 gap-8 md:grid-cols-2">
								<div class="space-y-6">
									{{-- Bagian Titik Asal --}}
									<div>
										<label class="mb-2 block text-[11px] font-black uppercase tracking-widest text-gray-400">Titik Asal</label>
										<select
											class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-5 py-4 text-sm font-bold outline-none transition focus:ring-2 focus:ring-blue-500"
											name="asal">
											<option value="" disabled>Pilih Lokasi</option>
											@foreach ($lokasis as $lokasi)
												<option value="{{ $lokasi->id }}"
													{{ (int) old('asal_id', $jadwal->asal_id) === (int) $lokasi->id ? 'selected' : '' }}>
													{{ $lokasi->nama }}
												</option>
											@endforeach
										</select>
									</div>

									{{-- Bagian Titik Tujuan --}}
									<div>
										<label class="mb-2 block text-[11px] font-black uppercase tracking-widest text-gray-400">Titik Tujuan</label>
										<select
											class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-5 py-4 text-sm font-bold outline-none transition focus:ring-2 focus:ring-blue-500"
											name="tujuan">
											<option value="" disabled>Pilih Lokasi</option>
											@foreach ($lokasis as $lokasi)
												<option value="{{ $lokasi->id }}"
													{{ (int) old('tujuan_id', $jadwal->tujuan_id) === (int) $lokasi->id ? 'selected' : '' }}>
													{{ $lokasi->nama }}
												</option>
											@endforeach
										</select>
									</div>
								</div>

								<div class="space-y-6">
									<div>
										<label class="mb-2 block text-[11px] font-black uppercase tracking-widest text-gray-400">Waktu
											Berangkat</label>
										<input
											class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-5 py-4 text-sm font-bold outline-none transition focus:ring-2 focus:ring-blue-500"
											name="waktu" type="datetime-local"
											value="{{ old('waktu', \Carbon\Carbon::parse($jadwal->waktu_berangkat)->format('Y-m-d\TH:i')) }}" required>
									</div>
									<div>
										<label class="mb-2 block text-[11px] font-black uppercase tracking-widest text-gray-400">Harga Tiket</label>
										<div class="relative">
											<span class="absolute left-5 top-1/2 -translate-y-1/2 text-sm font-bold text-gray-400">Rp</span>
											<input
												class="w-full rounded-2xl border border-gray-200 bg-gray-50 py-4 pl-12 pr-5 text-sm font-bold outline-none transition focus:ring-2 focus:ring-blue-500"
												name="harga" type="number" value="{{ old('harga', $jadwal->harga) }}" required>
										</div>
									</div>
								</div>
							</div>

							<div class="mb-10">
								<label class="mb-2 block text-[11px] font-black uppercase tracking-widest text-gray-400">Info Lokasi
									Penjemputan</label>
								<textarea
								 class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-5 py-4 text-sm font-bold outline-none transition focus:ring-2 focus:ring-blue-500"
								 name="lokasi" rows="3" required>{{ old('lokasi', $jadwal->info_lokasi) }}</textarea>
							</div>

							<div class="mb-10">
								<label class="mb-2 block text-[11px] font-black uppercase tracking-widest text-gray-400">Stok Tersedia</label>
								<input
									class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-5 py-4 text-sm font-bold outline-none transition focus:ring-2 focus:ring-blue-500"
									name="stok" type="number" value="{{ old('stok', $jadwal->stok_tersedia) }}"
									:class="stok > maxKapasitas ? 'border-red-500 ring-2 ring-red-200' : ''" x-model="stok" :max="maxKapasitas"
									:placeholder="selectedArmada ? 'Maksimal ' + maxKapasitas : 'Pilih armada dulu'" required>
								</input>
							</div>

							<div class="flex gap-4">
								<a
									class="flex-1 rounded-2xl border-2 border-gray-100 py-5 text-center font-black uppercase tracking-widest text-gray-400 transition hover:bg-gray-50"
									href="{{ route('jadwal.index', $type) }}">
									Batal
								</a>
								<button
									class="flex-[2] rounded-2xl bg-blue-600 py-5 font-black uppercase tracking-[0.2em] text-white shadow-xl shadow-blue-100 transition hover:bg-blue-700"
									type="submit">
									Update Jadwal
								</button>
							</div>
						</form>
					@endif
				</div>
			</main>
		</div>

	</body>

</html>
