@extends('layouts.app')

@section('title', 'Hasil Pencarian | PastiTravel')

@push('scripts')
	<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endpush

@section('nav-links')
@endsection

@section('content')
	<div class="bg-gray-50" x-data="{ showFilter: false }">

		@php
			$modaIcon = match ($moda) {
			    'pesawat' => 'fa-plane',
			    'bus' => 'fa-bus',
			    'kereta' => 'fa-train',
			    'kapal' => 'fa-ship',
			    default => 'fa-plane',
			};

			$icon = match ($moda) {
			    'pesawat' => 'plane',
			    'bus' => 'bus',
			    'kereta' => 'train',
			    'kapal' => 'ship',
			    default => 'plane',
			};
		@endphp

		<nav class="sticky top-0 z-40 bg-blue-700 p-4 text-white shadow-md">
			<div class="mx-auto flex max-w-6xl items-center justify-between px-2">
				<div class="flex items-center gap-4">
					<a class="rounded-lg border border-white/20 bg-blue-800/50 px-3 py-2 text-xs transition hover:bg-blue-600"
						href="javascript:history.back()">
						<i class="fas fa-arrow-left"></i>
					</a>
					<div>
						<div class="flex items-center gap-4">
							<i class="fas {{ $modaIcon }} text-xs opacity-50"></i>
							<div>
								<h1 class="flex items-center gap-2 text-lg font-bold">
									{{ $asalModel->nama ?? 'Asal' }} <i class="fas fa-{{ $icon }} text-xs opacity-50"></i>
									{{ $tujuanModel->nama ?? 'Tujuan' }}
								</h1>
								<p class="text-[10px] font-semibold uppercase tracking-widest text-blue-100">
									{{ $tanggalFmt }}
								</p>
							</div>
						</div>
					</div>
				</div>
				<a
					class="rounded-lg border border-white/40 px-4 py-2 text-xs font-bold transition hover:bg-white hover:text-blue-700"
					href="{{ route('home') }}">UBAH</a>
			</div>
		</nav>

		<div class="mx-auto flex max-w-6xl flex-col gap-8 px-4 py-8 lg:flex-row">
			<!-- Filter Sidebar -->
			<aside class="hidden w-72 space-y-6 lg:block">
				<form
					class="transform rounded-2xl border border-gray-300 bg-white p-6 shadow-2xl ring-1 ring-gray-100 transition-all hover:-translate-y-1"
					action="{{ route('pencarian') }}" method="GET">
					<!-- Hidden inputs to preserve existing filters -->
					<input name="asal" type="hidden" value="{{ $asal ?? '' }}">
					<input name="tujuan" type="hidden" value="{{ $tujuan ?? '' }}">
					<input name="tanggal" type="hidden" value="{{ request('tanggal') ?? '' }}">
					<input name="moda" type="hidden" value="{{ $moda }}">

					<div class="mb-6 flex items-center justify-between">
						<h3 class="font-bold text-gray-800">Filter</h3>
						<a class="text-xs font-bold text-blue-600 hover:underline"
							href="{{ route('pencarian', ['asal' => $asal, 'tujuan' => $tujuan, 'tanggal' => request('tanggal'), 'moda' => $moda]) }}">Reset</a>
					</div>

					<div class="mb-6">
						<label class="text-xs font-black uppercase tracking-wider text-gray-400">Waktu Keberangkatan</label>
						<div class="mt-3 grid grid-cols-2 gap-2">
							<a
								class="{{ $departureTime == '0-6' ? 'border-blue-500 bg-blue-50 text-blue-600' : 'border-gray-200' }} rounded-xl border p-2 text-[10px] font-bold transition hover:border-blue-500 hover:bg-blue-50"
								href="{{ route('pencarian', array_merge(request()->query(), ['departure_time' => '0-6'])) }}">
								00:00 - 06:00
							</a>
							<a
								class="{{ $departureTime == '6-12' ? 'border-blue-500 bg-blue-50 text-blue-600' : 'border-gray-200' }} rounded-xl border p-2 text-[10px] font-bold transition hover:border-blue-500 hover:bg-blue-50"
								href="{{ route('pencarian', array_merge(request()->query(), ['departure_time' => '6-12'])) }}">
								06:00 - 12:00
							</a>
							<a
								class="{{ $departureTime == '12-18' ? 'border-blue-500 bg-blue-50 text-blue-600' : 'border-gray-200' }} rounded-xl border p-2 text-[10px] font-bold transition hover:border-blue-500 hover:bg-blue-50"
								href="{{ route('pencarian', array_merge(request()->query(), ['departure_time' => '12-18'])) }}">
								12:00 - 18:00
							</a>
							<a
								class="{{ $departureTime == '18-24' ? 'border-blue-500 bg-blue-50 text-blue-600' : 'border-gray-200' }} rounded-xl border p-2 text-[10px] font-bold transition hover:border-blue-500 hover:bg-blue-50"
								href="{{ route('pencarian', array_merge(request()->query(), ['departure_time' => '18-24'])) }}">
								18:00 - 24:00
							</a>
						</div>
					</div>

					<div class="mb-2">
						<label class="text-xs font-black uppercase tracking-wider text-gray-400">Operator</label>
						@foreach ($operators as $op)
							<label class="flex cursor-pointer items-center gap-3 text-sm hover:text-blue-600">
								<input class="rounded text-blue-600" name="operator[]" type="checkbox" value="{{ $op }}"
									{{ in_array($op, (array) $selectedOperators) ? 'checked' : '' }}>
								<span class="text-gray-600">{{ $op }}</span>
							</label>
						@endforeach
					</div>

					<div class="mt-6 flex gap-2">
						<button class="flex-1 rounded-xl bg-blue-600 py-2 text-xs font-bold text-white transition hover:bg-blue-700"
							type="submit">Terapkan Filter</button>
					</div>
				</form>
			</aside>

			<!-- Main Content -->
			<main class="flex-1 space-y-4">
				@forelse ($results as $index => $r)
					<div
						class="group relative overflow-hidden rounded-3xl border border-gray-300 bg-white shadow-2xl ring-1 ring-gray-100 transition-all hover:-translate-y-1 hover:shadow-[0_20px_60px_rgba(0,0,0,0.12)]">
						<div class="flex flex-col gap-6 p-6 lg:flex-row lg:items-center">

							<div class="flex items-center gap-4 lg:w-48">
								<div
									class="flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-50 text-lg font-black italic text-blue-600 shadow-inner">
									{{ strtoupper(substr($r->transportasi->nama_brand, 0, 2)) }}
								</div>
								<div>
									<h4 class="text-sm font-black text-gray-800">{{ $r->transportasi->nama_brand }}</h4>
									<div class="mt-1 flex items-center gap-2">
										<span
											class="rounded bg-gray-100 px-2 py-0.5 text-[9px] font-bold uppercase text-gray-500">{{ $r->transportasi->kode_identitas }}</span>
										<span class="text-[9px] font-bold italic text-blue-600">{{ ucfirst($r->transportasi->tipe) }}</span>
									</div>
								</div>
							</div>

							<div class="flex flex-1 items-center justify-between gap-6 lg:justify-center lg:gap-16">
								<div class="text-center">
									<span
										class="block text-2xl font-black tracking-tighter text-gray-900">{{ \Carbon\Carbon::parse($r->waktu_berangkat)->format('H:i') }}</span>
									<span
										class="text-[10px] font-bold uppercase tracking-widest text-gray-400">{{ strtoupper(substr($r->asal->kode, 0, 3)) }}</span>
								</div>

								<div class="flex max-w-[120px] flex-1 flex-col items-center">
									<span class="mb-1 text-[9px] font-black text-gray-400">{{ $r->durasi }}</span>
									<div class="flex w-full items-center gap-1">
										<div class="h-1.5 w-1.5 rounded-full border-2 border-gray-200"></div>
										<div class="relative h-[2px] flex-1 bg-gray-100">
											<i
												class="fas {{ $moda == 'kereta' ? 'fa-train' : ($moda == 'bus' ? 'fa-bus' : ($moda == 'kapal' ? 'fa-ship' : 'fa-plane')) }} absolute -top-1.5 left-1/2 -translate-x-1/2 text-[10px] text-blue-200"></i>
										</div>
										<div class="h-1.5 w-1.5 rounded-full bg-blue-500 shadow-[0_0_8px_rgba(59,130,246,0.5)]"></div>
									</div>
								</div>

								<div class="text-center">
									<span
										class="block text-2xl font-black tracking-tighter text-gray-900">{{ \Carbon\Carbon::parse($r->waktu_tiba)->format('H:i') }}</span>
									<span
										class="text-[10px] font-bold uppercase tracking-widest text-gray-400">{{ strtoupper(substr($r->tujuan->kode, 0, 3)) }}</span>
								</div>
							</div>

							<div
								class="flex items-center justify-between gap-3 border-t border-gray-50 pt-4 lg:flex-col lg:items-end lg:border-l lg:border-t-0 lg:pl-10 lg:pt-0">
								<div class="text-right">
									@if ($r->stok_tersedia <= 3)
										<span class="text-[9px] font-black uppercase text-red-500">
											Sisa {{ $r->stok_tersedia }} Kursi!
										</span>
									@endif
									<p class="text-2xl font-black tracking-tighter text-orange-500">Rp
										{{ number_format($r->harga, 0, ',', '.') }}
									</p>
									<p class="text-[9px] font-bold uppercase text-gray-400">Sudah Termasuk Pajak</p>
								</div>
								<a
									class="rounded-xl bg-blue-600 px-8 py-3 text-xs font-black uppercase tracking-widest text-white shadow-lg shadow-blue-100 transition hover:bg-blue-700 active:scale-95"
									href="{{ route('booking.create', $r->id) }}">
									Pilih
								</a>
							</div>
							<div class="hidden gap-4 border-t border-gray-50 bg-gray-50 px-6 py-2 lg:flex">
								@if (!empty($r->transportasi->fasilitas) && is_array($r->transportasi->fasilitas))
									@foreach ($r->transportasi->fasilitas as $f)
										@php
											$feature = strtolower($f);
											$icon = match (true) {
											    str_contains($feature, 'bagasi') => 'fa-suitcase-rolling',
											    str_contains($feature, 'makan') => 'fa-utensils',
											    str_contains($feature, 'usb') => 'fa-plug',
											    str_contains($feature, 'ac') => 'fa-wind',
											    str_contains($feature, 'wifi') => 'fa-wifi',
											    str_contains($feature, 'tv') || str_contains($feature, 'hiburan') => 'fa-tv',
											    default => 'fa-check-circle',
											};
										@endphp
										<span class="text-[9px] font-bold text-gray-500">
											<i class="fas {{ $icon }} mr-1"></i>
											{{ $f }}
										</span>
									@endforeach
								@endif
							</div>
						</div>
					</div>
				@empty
					<div class="rounded-2xl border border-gray-200 bg-white p-8 text-center">
						<i class="fas fa-search mb-4 text-4xl text-gray-300"></i>
						<h3 class="text-lg font-bold text-gray-600">Tidak ada hasil pencarian</h3>
						<p class="mt-2 text-sm text-gray-500">Coba ubah kriteria pencarian Anda</p>
						<a class="mt-4 inline-block rounded-lg bg-blue-600 px-6 py-2 text-white hover:bg-blue-700"
							href="{{ route('home') }}">
							Cari Lagi
						</a>
					</div>
				@endforelse
			</main>
		</div>

		<!-- Mobile Filter Button -->
		<div class="fixed bottom-6 left-1/2 z-50 -translate-x-1/2 lg:hidden">
			<button
				class="flex items-center gap-3 rounded-2xl bg-blue-700 px-8 py-4 text-sm font-black uppercase tracking-widest text-white shadow-2xl"
				@click="showFilter = true">
				<i class="fas fa-sliders-h"></i> Filter
			</button>
		</div>

		<!-- Mobile Filter Modal -->
		<div class="fixed inset-0 z-50 bg-black/60 lg:hidden" x-show="showFilter" x-transition.opacity
			@click="showFilter = false"></div>
		<div class="fixed bottom-0 left-0 right-0 z-50 max-h-[90vh] overflow-y-auto rounded-t-[40px] bg-white p-8 lg:hidden"
			x-show="showFilter" x-transition:enter="transition ease-out duration-300"
			x-transition:enter-start="translate-y-full" x-transition:enter-end="translate-y-0">

			<div class="mx-auto mb-8 h-1.5 w-12 rounded-full bg-gray-200"></div>
			<h3 class="mb-6 text-xl font-black uppercase tracking-tighter text-gray-800">Filter & Urutkan</h3>

			<form class="space-y-8">
				<!-- Hidden inputs to preserve existing filters -->
				<input name="asal" type="hidden" value="{{ $asal ?? '' }}">
				<input name="tujuan" type="hidden" value="{{ $tujuan ?? '' }}">
				<input name="tanggal" type="hidden" value="{{ request('tanggal') ?? '' }}">
				<input name="moda" type="hidden" value="{{ $moda }}">

				<div>
					<label class="text-xs font-black uppercase tracking-widest text-gray-400">Urutkan</label>
					<div class="mt-4 grid grid-cols-2 gap-3">
						<a
							class="{{ $sortBy === 'harga' ? 'bg-blue-600 text-white' : 'border border-gray-200' }} rounded-2xl py-3 text-center text-xs font-bold transition hover:bg-blue-600 hover:text-white"
							href="{{ route('pencarian', array_merge(request()->query(), ['sort_by' => 'harga'])) }}">
							<i class="fas fa-tag mr-1"></i> Termurah
						</a>
						<a
							class="{{ $sortBy === 'durasi' ? 'bg-blue-600 text-white' : 'border border-gray-200' }} rounded-2xl py-3 text-center text-xs font-bold transition hover:bg-blue-600 hover:text-white"
							href="{{ route('pencarian', array_merge(request()->query(), ['sort_by' => 'durasi'])) }}">
							<i class="fas fa-clock mr-1"></i> Tercepat
						</a>
					</div>
				</div>

				<div>
					<label class="text-xs font-black uppercase tracking-widest text-gray-400">Waktu Keberangkatan</label>
					<div class="mt-4 space-y-2">
						<a
							class="{{ $departureTime == '0-6' ? 'border-blue-500 bg-blue-50 text-blue-600' : 'border-gray-200' }} block rounded-xl border p-3 text-center text-xs font-bold transition hover:border-blue-500 hover:bg-blue-50"
							href="{{ route('pencarian', array_merge(request()->query(), ['departure_time' => '0-6'])) }}">00:00 - 06:00</a>
						<a
							class="{{ $departureTime == '6-12' ? 'border-blue-500 bg-blue-50 text-blue-600' : 'border-gray-200' }} block rounded-xl border p-3 text-center text-xs font-bold transition hover:border-blue-500 hover:bg-blue-50"
							href="{{ route('pencarian', array_merge(request()->query(), ['departure_time' => '6-12'])) }}">06:00 - 12:00</a>
						<a
							class="{{ $departureTime == '12-18' ? 'border-blue-500 bg-blue-50 text-blue-600' : 'border-gray-200' }} block rounded-xl border p-3 text-center text-xs font-bold transition hover:border-blue-500 hover:bg-blue-50"
							href="{{ route('pencarian', array_merge(request()->query(), ['departure_time' => '12-18'])) }}">12:00 -
							18:00</a>
						<a
							class="{{ $departureTime == '18-24' ? 'border-blue-500 bg-blue-50 text-blue-600' : 'border-gray-200' }} block rounded-xl border p-3 text-center text-xs font-bold transition hover:border-blue-500 hover:bg-blue-50"
							href="{{ route('pencarian', array_merge(request()->query(), ['departure_time' => '18-24'])) }}">18:00 -
							24:00</a>
					</div>
				</div>
			</form>

			<button
				class="mt-10 w-full rounded-2xl bg-blue-700 py-5 font-black uppercase tracking-widest text-white shadow-xl shadow-blue-100 transition hover:bg-blue-800"
				@click="showFilter = false">Tutup Filter</button>
		</div>

	</div>
@endsection
