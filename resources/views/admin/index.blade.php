<!DOCTYPE html>
<html lang="id">

	<head>
		<meta charset="UTF-8">
		<title>Kelola Armada - HubTrans</title>
		<script src="https://cdn.tailwindcss.com"></script>
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
	</head>

	<body class="bg-gray-100 font-sans" x-data="{ openArmada: false, openJadwal: false }">
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
					class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-bold transition hover:bg-slate-800 hover:text-white"
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
				<a
					class="flex items-center gap-3 rounded-xl border-l-4 border-blue-500 bg-blue-600/20 px-4 py-3 text-sm font-bold text-blue-400 transition hover:bg-slate-800"
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

		<main class="ml-64 p-8">
			<div class="mb-8 flex items-center justify-between">
				<div>
					<h2 class="text-2xl font-black uppercase tracking-tighter text-slate-800">Daftar Armada {{ ucfirst($type) }}</h2>
					<p class="text-xs font-bold uppercase tracking-widest text-gray-400">Semua Unit {{ ucfirst($type) }} HubTrans</p>
				</div>
				<a
					class="rounded-xl bg-blue-600 px-6 py-3 text-xs font-black uppercase tracking-widest text-white shadow-lg shadow-blue-100 transition hover:bg-blue-700"
					href="{{ route('transportasi.create', $type) }}">
					+ Tambah Unit
				</a>
			</div>

			<div class="overflow-hidden rounded-[2rem] border border-gray-100 bg-white shadow-sm">
				<table class="w-full text-left">
					<thead class="border-b border-gray-100 bg-gray-50">
						<tr>
							<th class="p-6 text-[10px] font-black uppercase tracking-widest text-gray-400">Unit & Moda</th>
							<th class="p-6 text-[10px] font-black uppercase tracking-widest text-gray-400">ID Unit</th>
							<th class="p-6 text-[10px] font-black uppercase tracking-widest text-gray-400">Kapasitas</th>
							<th class="p-6 text-[10px] font-black uppercase tracking-widest text-gray-400">Status</th>
							<th class="p-6 text-center text-[10px] font-black uppercase tracking-widest text-gray-400">Aksi</th>
						</tr>
					</thead>
					<tbody class="divide-y divide-gray-50 text-sm font-bold">
						@forelse($data as $transportasi)
							<tr class="transition hover:bg-gray-50">
								<td class="p-6">
									<div class="flex items-center gap-3">
										<div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
											<i
												class="fas {{ $type === 'pesawat' ? 'fa-plane' : ($type === 'bus' ? 'fa-bus' : ($type === 'kereta' ? 'fa-train' : 'fa-ship')) }}"></i>
										</div>
										<div>
											<p class="text-slate-800">{{ $transportasi->nama_brand }}</p>
											<p class="text-[9px] uppercase text-gray-400">{{ ucfirst($type) }}</p>
										</div>
									</div>
								</td>
								<td class="p-6 font-mono text-gray-500">{{ $transportasi->kode_identitas }}</td>
								<td class="p-6 text-slate-600">{{ $transportasi->kapasitas }} Kursi</td>
								<td class="p-6">
									<span
										class="rounded-full bg-green-100 px-3 py-1 text-[9px] font-black uppercase italic text-green-700">Aktif</span>
								</td>
								<td class="p-6 text-center">
									<button class="mr-2 text-blue-500 hover:text-blue-700"><i class="fas fa-edit"></i></button>
									<button class="text-red-400 hover:text-red-600"><i class="fas fa-trash-alt"></i></button>
								</td>
							</tr>
						@empty
							<tr>
								<td class="p-6 text-center text-gray-400" colspan="5">
									Belum ada data {{ ucfirst($type) }}
								</td>
							</tr>
						@endforelse
					</tbody>
				</table>
			</div>
		</main>
	</body>

</html>
