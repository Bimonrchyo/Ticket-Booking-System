@extends('layouts.app')

@section('title', 'Detail Jadwal | PastiTravel')

@push('scripts')
	<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endpush

@section('nav-links')
@endsection

@section('content')
	@php
		use Carbon\Carbon;

		$berangkat = Carbon::parse($jadwal->waktu_berangkat);
		$tiba = Carbon::parse($jadwal->waktu_tiba);
		$durasi = $berangkat->diff($tiba);

		$icon = match ($jadwal->transportasi->tipe) {
			'pesawat' => 'plane',
			'bus' => 'bus',
			'kereta' => 'train',
			'kapal' => 'ship',
			default => 'bus',
		};

		$bookedSeats = optional($jadwal->bookings)->pluck('nomor_kursi')->toArray() ?? [];

		$kapasitas = $jadwal->transportasi->kapasitas;
		$seatLayout = $jadwal->transportasi->seat_layout ?? [
			'seats_per_row' => 4,
			'left' => ['A', 'B'],
			'right' => ['C', 'D'],
			'aisle_after' => 2,
			'seat_types' => ['A' => 'window', 'B' => 'aisle', 'C' => 'aisle', 'D' => 'window']
		];
		$seatsPerRow = $seatLayout['seats_per_row'] ?? 4;
		$jumlahBaris = ceil($kapasitas / $seatsPerRow);
		$leftLabels = $seatLayout['left'] ?? ['A', 'B'];
		$rightLabels = $seatLayout['right'] ?? ['C', 'D'];
		$allLabels = array_merge($leftLabels, $rightLabels);
		$seatTypes = $seatLayout['seat_types'] ?? [];

		$typeColors = [
			'window' => 'bg-blue-400',
			'aisle' => 'bg-green-400',
			'middle' => 'bg-gray-300',
		];
		$typeLabels = [
			'window' => 'Jendela',
			'aisle' => 'Gang',
			'middle' => 'Tengah',
		];
	@endphp

	<div class="bg-gray-50 font-sans" x-data="{
						selectedSeat: null,
						bookedSeats: @js($bookedSeats),
						selectSeat(seat) {
							if (!this.bookedSeats.includes(seat)) {
								this.selectedSeat = (this.selectedSeat === seat) ? null : seat;
							}
						}
					}">

		<nav class="sticky top-0 z-40 bg-blue-700 p-4 text-white shadow-md">
			<div class="mx-auto flex max-w-6xl items-center gap-4">
				<a class="rounded-lg bg-blue-600/50 p-2 transition hover:bg-blue-500" href="javascript:history.back()">
					<i class="fas fa-arrow-left"></i>
				</a>
				<h1 class="text-lg font-bold">Detail & Pilih Kursi</h1>
			</div>
		</nav>

		<div class="mx-auto flex max-w-6xl flex-col gap-8 px-4 py-8 lg:flex-row">

			{{-- LEFT COLUMN --}}
			<div class="flex-1 space-y-6">

				{{-- Info Card --}}
				<div
					class="transform rounded-3xl border border-gray-300 bg-white p-6 shadow-2xl ring-1 ring-gray-100 transition-all hover:-translate-y-1">
					<div class="mb-6 flex items-center gap-4">
						<div
							class="flex h-16 w-16 items-center justify-center rounded-2xl bg-blue-50 text-2xl text-blue-600">
							<i class="fas fa-{{ $icon }}"></i>
						</div>
						<div>
							<h2 class="text-xl font-black text-gray-800">{{ $jadwal->transportasi->nama_brand }}</h2>
							<p class="mt-2 text-sm text-gray-600">{{ $jadwal->asal->nama }} → {{ $jadwal->tujuan->nama }}
							</p>
							<p class="text-sm font-bold uppercase tracking-widest text-gray-500">
								{{ $jadwal->transportasi->kode_identitas }}
							</p>
						</div>
					</div>

					<div class="mt-6 grid grid-cols-2 gap-4">
						<div>
							<p class="text-xs text-gray-400">Berangkat</p>
							<p class="font-bold text-gray-800">{{ $berangkat->format('d M Y') }}</p>
							<p class="text-sm text-gray-600">{{ $berangkat->format('H:i') }}</p>
						</div>
						<div>
							<p class="text-xs text-gray-400">Tiba</p>
							<p class="font-bold text-gray-800">{{ $tiba->format('d M Y') }}</p>
							<p class="text-sm text-gray-600">{{ $tiba->format('H:i') }}</p>
						</div>
					</div>

					<p class="mt-3 text-xs text-gray-500">Durasi {{ $durasi->h }} jam {{ $durasi->i }} menit</p>

					<div class="mt-4 grid grid-cols-2 gap-4 md:grid-cols-4">
						@if ($jadwal->transportasi->fasilitas)
							@foreach ($jadwal->transportasi->fasilitas as $f)
								<div class="rounded-2xl bg-gray-50 p-4 text-center">
									<i class="fas fa-check-circle mb-2 text-blue-400"></i>
									<p class="text-[10px] font-bold uppercase text-gray-500">{{ $f }}</p>
									<p class="text-xs font-bold text-gray-700">Tersedia</p>
								</div>
							@endforeach
						@else
							<p class="col-span-4 text-center text-xs text-gray-400">Fasilitas standar</p>
						@endif
					</div>
				</div>

				{{-- Seat Map Card --}}
				<div
					class="transform rounded-3xl border border-gray-300 bg-white p-6 shadow-2xl ring-1 ring-gray-100 transition-all hover:-translate-y-1">
					<h3 class="mb-2 text-sm font-black uppercase tracking-widest text-gray-800">Pilih Nomor Kursi</h3>
					<p class="mb-6 text-xs text-gray-400">{{ $seatLayout['desc'] ?? 'Standar' }}</p>

					{{-- Legend --}}
					<div class="mb-6 flex flex-wrap justify-center gap-3">
						@foreach (['window' => 'Jendela', 'aisle' => 'Gang', 'middle' => 'Tengah'] as $t => $l)
							<div
								class="flex items-center gap-1.5 rounded-full bg-gray-50 px-3 py-1 text-[10px] font-bold text-gray-500">
								<span class="h-2.5 w-2.5 rounded-full {{ $typeColors[$t] }}"></span>
								{{ $l }}
							</div>
						@endforeach
						<div
							class="flex items-center gap-1.5 rounded-full bg-gray-50 px-3 py-1 text-[10px] font-bold text-gray-500">
							<span class="h-2.5 w-2.5 rounded-full bg-blue-600"></span> Dipilih
						</div>
						<div
							class="flex items-center gap-1.5 rounded-full bg-gray-50 px-3 py-1 text-[10px] font-bold text-gray-500">
							<span class="h-2.5 w-2.5 rounded-full bg-gray-300"></span> Terisi
						</div>
					</div>

					{{-- Seat Map Container --}}
					<div class="flex flex-col items-center">
						{{-- Front Indicator --}}
						@php
							$frontIcon = match ($jadwal->transportasi->tipe) {
								'bus' => 'steering-wheel',
								'kereta' => 'train',
								'pesawat' => 'plane-departure',
								'kapal' => 'ship',
								default => 'arrow-up'
							};
						@endphp
						<div
							class="mb-4 flex w-full max-w-[360px] items-center justify-center rounded-t-3xl border-2 border-dashed border-gray-200 py-3 text-gray-300">
							<i class="fas fa-{{ $frontIcon }} mr-2"></i>
							<span class="text-[10px] font-bold uppercase tracking-widest">Depan</span>
						</div>

						{{-- Column Headers --}}
						<div class="flex w-full max-w-[360px] items-center justify-between px-2 mb-2">
							<div class="flex gap-2">
								@foreach ($leftLabels as $lbl)
									<div class="w-10 text-center text-[10px] font-bold text-gray-400">{{ $lbl }}</div>
								@endforeach
							</div>
							<div class="w-8"></div>
							<div class="flex gap-2">
								@foreach ($rightLabels as $lbl)
									<div class="w-10 text-center text-[10px] font-bold text-gray-400">{{ $lbl }}</div>
								@endforeach
							</div>
						</div>

						{{-- Rows --}}
						<div class="flex w-full max-w-[360px] flex-col gap-2">
							@for ($row = 1; $row <= $jumlahBaris; $row++)
								<div class="flex items-center justify-between">
									{{-- Left Side --}}
									<div class="flex gap-2">
										@foreach ($leftLabels as $label)
											@php
												$seatId = $row . $label;
												$seatNum = ($row - 1) * $seatsPerRow + (array_search($label, $allLabels) + 1);
												$isBooked = in_array($seatId, $bookedSeats);
												$type = $seatTypes[$label] ?? 'window';
												$dotColor = $typeColors[$type] ?? 'bg-gray-300';
											@endphp
											@if ($seatNum <= $kapasitas)
												<button
													class="relative flex h-10 w-10 flex-col items-center justify-center rounded-xl text-[10px] font-black transition-all duration-200"
													@click="selectSeat('{{ $seatId }}')" :class="{
																														'bg-gray-100 text-gray-500 hover:bg-gray-200': !bookedSeats.includes('{{ $seatId }}') && selectedSeat !== '{{ $seatId }}',
																														'bg-blue-600 text-white shadow-lg shadow-blue-200 scale-110': selectedSeat === '{{ $seatId }}',
																														'bg-gray-300 text-white cursor-not-allowed': bookedSeats.includes('{{ $seatId }}')
																													}" @if($isBooked) disabled @endif title="{{ $typeLabels[$type] ?? '' }}">
													{{ $seatId }}
													@if(!$isBooked)
														<span
															class="absolute -top-1 -right-1 h-2 w-2 rounded-full {{ $dotColor }} border border-white"></span>
													@endif
												</button>
											@else
												<div class="h-10 w-10"></div>
											@endif
										@endforeach
									</div>

									{{-- Row Number / Aisle --}}
									<div class="flex h-10 w-8 items-center justify-center">
										<span class="text-[10px] font-bold text-gray-300">{{ $row }}</span>
									</div>

									{{-- Right Side --}}
									<div class="flex gap-2">
										@foreach ($rightLabels as $label)
											@php
												$seatId = $row . $label;
												$seatNum = ($row - 1) * $seatsPerRow + (array_search($label, $allLabels) + 1);
												$isBooked = in_array($seatId, $bookedSeats);
												$type = $seatTypes[$label] ?? 'window';
												$dotColor = $typeColors[$type] ?? 'bg-gray-300';
											@endphp
											@if ($seatNum <= $kapasitas)
												<button
													class="relative flex h-10 w-10 flex-col items-center justify-center rounded-xl text-[10px] font-black transition-all duration-200"
													@click="selectSeat('{{ $seatId }}')" :class="{
																														'bg-gray-100 text-gray-500 hover:bg-gray-200': !bookedSeats.includes('{{ $seatId }}') && selectedSeat !== '{{ $seatId }}',
																														'bg-blue-600 text-white shadow-lg shadow-blue-200 scale-110': selectedSeat === '{{ $seatId }}',
																														'bg-gray-300 text-white cursor-not-allowed': bookedSeats.includes('{{ $seatId }}')
																													}" @if($isBooked) disabled @endif title="{{ $typeLabels[$type] ?? '' }}">
													{{ $seatId }}
													@if(!$isBooked)
														<span
															class="absolute -top-1 -right-1 h-2 w-2 rounded-full {{ $dotColor }} border border-white"></span>
													@endif
												</button>
											@else
												<div class="h-10 w-10"></div>
											@endif
										@endforeach
									</div>
								</div>
							@endfor
						</div>
					</div>
				</div>
			</div>

			{{-- RIGHT COLUMN: Summary Sidebar --}}
			<div class="lg:w-96 xl:w-[400px]">
				<div
					class="sticky top-24 transform rounded-3xl border border-gray-300 bg-white p-6 shadow-2xl ring-1 ring-gray-100 transition-all hover:-translate-y-1">
					<h3 class="mb-4 text-sm font-black uppercase text-gray-800">Ringkasan</h3>
					<div class="mb-4 space-y-4 border-b pb-4">
						<div class="flex justify-between text-sm">
							<span class="text-gray-400">Harga Tiket</span>
							<span class="font-bold text-gray-700">Rp {{ number_format($jadwal->harga, 0, ',', '.') }}</span>
						</div>
						<div class="flex justify-between text-sm">
							<span class="text-gray-400">Nomor Kursi</span>
							<span class="font-black text-blue-600" x-text="selectedSeat || '-'"></span>
						</div>
					</div>
					<div class="mb-6 flex items-center justify-between">
						<span class="text-xs font-bold text-gray-400">Total Bayar</span>
						<span class="text-xl font-black text-orange-500"
							x-text="selectedSeat ? 'Rp {{ number_format($jadwal->harga, 0, ',', '.') }}' : 'Rp 0'"></span>
					</div>

					{{-- Seat Map Legend --}}
					@include('user.partials.seat-visual', ['jadwal' => $jadwal])

					<form method="GET" action="{{ route('checkout', $jadwal->id) }}">

						<input name="seat" type="hidden" :value="selectedSeat">
						<button
							class="w-full rounded-2xl py-4 text-xs font-black uppercase tracking-widest text-white shadow-lg transition active:scale-95"
							type="submit" :disabled="!selectedSeat"
							:class="selectedSeat ? 'bg-blue-600 hover:bg-blue-700 shadow-blue-100' : 'bg-gray-200 cursor-not-allowed'">
							Lanjutkan
						</button>
					</form>
					<p class="mt-4 text-center text-[9px] text-gray-400">Dengan mengklik tombol, Anda menyetujui Syarat &
						Ketentuan PastiTravel.</p>
				</div>
			</div>
		</div>
	</div>
@endsection