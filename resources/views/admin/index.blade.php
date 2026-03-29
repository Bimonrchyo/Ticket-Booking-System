@extends('layouts.app')

@section('title', 'Kelola ' . ucfirst($type) . ' | HubTrans')

@section('nav-links')
	<a class="border-b-2 border-orange-400 text-orange-400" href="{{ route('admin.dashboard') }}">Dashboard</a>
	<a class="hover:text-blue-200" href="{{ route('admin.payments') }}">Verifikasi</a>
@endsection

@section('content')
	<div class="bg-gray-50 font-sans" x-data="{ openArmada: false, openJadwal: false }">

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
						class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-bold transition hover:bg-slate-800"
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

			<main class="flex-1 p-8 lg:ml-64">
				<div class="mx-auto max-w-6xl">

					<div class="mb-6 flex items-center justify-between">
						<div>
							<h1 class="text-2xl font-bold text-gray-800">Kelola {{ ucfirst($type) }}</h1>
							<p class="text-gray-600">
								@if (request()->routeIs('transportasi.index'))
									Kelola unit armada {{ ucfirst($type) }}
								@else
									Kelola jadwal {{ ucfirst($type) }}
								@endif
							</p>
						</div>
						<a class="rounded-lg bg-blue-600 px-4 py-2 text-white hover:bg-blue-700"
							href="
							@if (request()->routeIs('transportasi.index')) {{ route('transportasi.create', $type) }}
							@else
								{{ route('jadwal.create', $type) }} @endif
						">
							<i class="fas fa-plus mr-2"></i>
							@if (request()->routeIs('transportasi.index'))
								Tambah Armada
							@else
								Tambah Jadwal
							@endif
						</a>
					</div>

					@if (session('success'))
						<div class="mb-4 rounded-lg bg-green-100 p-4 text-green-700">
							{{ session('success') }}
						</div>
					@endif

					@if (session('error'))
						<div class="mb-4 rounded-lg bg-red-100 p-4 text-red-700">
							{{ session('error') }}
						</div>
					@endif

					<div class="rounded-lg bg-white p-6 shadow">
						@if (request()->routeIs('transportasi.index'))
							<!-- Tabel Transportasi -->
							<table class="w-full table-auto">
								<thead>
									<tr class="border-b text-left">
										<th class="pb-3 font-semibold text-gray-600">Nama Brand</th>
										<th class="pb-3 font-semibold text-gray-600">Kode Identitas</th>
										<th class="pb-3 font-semibold text-gray-600">Kapasitas</th>
										<th class="pb-3 font-semibold text-gray-600">Aksi</th>
									</tr>
								</thead>
								<tbody>
									@forelse($data as $item)
										<tr class="border-b">
											<td class="py-3">{{ $item->nama_brand }}</td>
											<td class="py-3 font-mono text-blue-600">{{ $item->kode_identitas }}</td>
											<td class="py-3">{{ $item->kapasitas }} kursi</td>
											<td class="py-3">
												<a class="mr-2 rounded bg-yellow-500 px-3 py-1 text-white hover:bg-yellow-600"
													href="{{ route('transportasi.edit', [$type, $item]) }}">
													<i class="fas fa-edit"></i> Edit
												</a>
												<form class="inline" action="{{ route('transportasi.destroy', [$type, $item]) }}" method="POST"
													onsubmit="return confirm('Yakin ingin menghapus armada ini?')">
													@csrf
													@method('DELETE')
													<button class="rounded bg-red-500 px-3 py-1 text-white hover:bg-red-600" type="submit">
														<i class="fas fa-trash"></i> Hapus
													</button>
												</form>
											</td>
										</tr>
									@empty
										<tr>
											<td class="py-8 text-center text-gray-500" colspan="4">
												Belum ada data armada {{ ucfirst($type) }}.
												<a class="text-blue-600 hover:underline" href="{{ route('transportasi.create', $type) }}">Tambah
													sekarang</a>
											</td>
										</tr>
									@endforelse
								</tbody>
							</table>
						@else
							<!-- Tabel Jadwal -->
							<table class="w-full table-auto">
								<thead>
									<tr class="border-b text-left">
										<th class="pb-3 font-semibold text-gray-600">Armada</th>
										<th class="pb-3 font-semibold text-gray-600">Rute</th>
										<th class="pb-3 font-semibold text-gray-600">Waktu Berangkat</th>
										<th class="pb-3 font-semibold text-gray-600">Harga</th>
										<th class="pb-3 font-semibold text-gray-600">Stok</th>
										<th class="pb-3 font-semibold text-gray-600">Aksi</th>
									</tr>
								</thead>
								<tbody>
									@forelse($data as $item)
										<tr class="border-b">
											<td class="py-3">
												<div class="font-semibold">{{ $item->transportasi->nama_brand }}</div>
												<div class="text-sm text-gray-500">{{ $item->transportasi->kode_identitas }}</div>
											</td>
											<td class="py-3">{{ $item->asal->nama }} → {{ $item->tujuan->nama }}</td>
											<td class="py-3">{{ \Carbon\Carbon::parse($item->waktu_berangkat)->format('d/m/Y H:i') }}</td>
											<td class="py-3">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
											<td class="py-3">{{ $item->stok_tersedia }}</td>
											<td class="py-3">
												<a class="mr-2 rounded bg-yellow-500 px-3 py-1 text-white hover:bg-yellow-600"
													href="{{ route('jadwal.edit', [$type, $item]) }}">
													<i class="fas fa-edit"></i> Edit
												</a>
												<form class="inline" action="{{ route('jadwal.destroy', [$type, $item]) }}" method="POST"
													onsubmit="return confirm('Yakin ingin menghapus jadwal ini?')">
													@csrf
													@method('DELETE')
													<button class="rounded bg-red-500 px-3 py-1 text-white hover:bg-red-600" type="submit">
														<i class="fas fa-trash"></i> Hapus
													</button>
												</form>
											</td>
										</tr>
									@empty
										<tr>
											<td class="py-8 text-center text-gray-500" colspan="6">
												Belum ada jadwal {{ ucfirst($type) }}.
												<a class="text-blue-600 hover:underline" href="{{ route('jadwal.create', $type) }}">Tambah sekarang</a>
											</td>
										</tr>
									@endforelse
								</tbody>
							</table>
						@endif
					</div>

				</div>
			</main>
		</div>

	</div>
@endsection
