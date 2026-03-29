<!DOCTYPE html>
<html lang="id">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Detail Perjalanan & Pilih Kursi - PastiTravel</title>
		<script src="https://cdn.tailwindcss.com"></script>
		<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
	</head>

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
	@endphp

	<body class="bg-gray-50 font-sans" x-data="{
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

			<div class="flex-1 space-y-6">
				<div
					class="transform rounded-3xl border border-gray-300 bg-white p-6 shadow-2xl ring-1 ring-gray-100 transition-all hover:-translate-y-1">
					<div class="mb-6 flex items-center gap-4">
						<div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-blue-50 text-2xl text-blue-600">
							<i class="fas fa-{{ $icon }}"></i>
						</div>
						<div>
							<h2 class="text-xl font-black text-gray-800">{{ $jadwal->transportasi->nama_brand }}</h2>
							<p class="mt-2 text-sm text-gray-600">
								{{ $jadwal->asal->nama }} → {{ $jadwal->tujuan->nama }}
							</p>
							<p class="text-sm font-bold uppercase tracking-widest text-gray-500">{{ $jadwal->transportasi->kode_identitas }}
							</p>
						</div>
					</div>

					<div class="mt-6 grid grid-cols-2 gap-4">
						<div>
							<p class="text-xs text-gray-400">Berangkat</p>
							<p class="font-bold text-gray-800">
								{{ $berangkat->format('d M Y') }}
							</p>
							<p class="text-sm text-gray-600">
								{{ $berangkat->format('H:i') }}
							</p>
						</div>

						<div>
							<p class="text-xs text-gray-400">Tiba</p>
							<p class="font-bold text-gray-800">
								{{ $tiba->format('d M Y') }}
							</p>
							<p class="text-sm text-gray-600">
								{{ $tiba->format('H:i') }}
							</p>
						</div>
					</div>

					<p class="mt-3 text-xs text-gray-500">
						Durasi {{ $durasi->h }} jam {{ $durasi->i }} menit
					</p>

					<div class="grid grid-cols-2 gap-4 md:grid-cols-4">
						<div class="rounded-2xl bg-gray-50 p-4 text-center">
							<i class="fas fa-snowflake mb-2 text-blue-400"></i>
							<p class="text-[10px] font-bold uppercase text-gray-500">AC</p>
							<p class="text-xs font-bold text-gray-700">Tersedia</p>
						</div>
						<div class="rounded-2xl bg-gray-50 p-4 text-center">
							<i class="fas fa-plug mb-2 text-orange-400"></i>
							<p class="text-[10px] font-bold uppercase text-gray-500">USB Port</p>
							<p class="text-xs font-bold text-gray-700">Tiap Kursi</p>
						</div>
						<div class="rounded-2xl bg-gray-50 p-4 text-center">
							<i class="fas fa-couch mb-2 text-green-400"></i>
							<p class="text-[10px] font-bold uppercase text-gray-400">Konfigurasi</p>
							<p class="text-xs font-bold text-gray-700">2 - 2</p>
						</div>
						<div class="rounded-2xl bg-gray-50 p-4 text-center">
							<i class="fas fa-restroom mb-2 text-purple-400"></i>
							<p class="text-[10px] font-bold uppercase text-gray-400">Toilet</p>
							<p class="text-xs font-bold text-gray-700">Tersedia</p>
						</div>
					</div>
				</div>

				<div
					class="transform rounded-3xl border border-gray-300 bg-white p-6 shadow-2xl ring-1 ring-gray-100 transition-all hover:-translate-y-1">
					<h3 class="mb-6 text-sm font-black uppercase tracking-widest text-gray-800">Pilih Nomor Kursi</h3>

					<div class="flex flex-col items-center">
						<div class="mb-8 flex gap-4 text-[10px] font-bold">
							<div class="flex items-center gap-2">
								<div class="h-4 w-4 rounded bg-gray-100"></div> Tersedia
							</div>
							<div class="flex items-center gap-2">
								<div class="h-4 w-4 rounded bg-blue-600"></div> Dipilih
							</div>
							<div class="flex items-center gap-2">
								<div class="h-4 w-4 rounded bg-gray-300"></div> Terisi
							</div>
						</div>

						<div class="relative w-full max-w-[300px] rounded-t-[50px] border-4 border-gray-100 p-6">
							<div class="absolute -top-10 left-1/2 -translate-x-1/2 text-gray-300">
								<i class="fas fa-steering-wheel fa-3x"></i>
							</div>

							<div class="mt-4 grid grid-cols-4 gap-4">
								<?php
                            $rows = ['1', '2', '3', '4', '5'];
                            $cols = ['A', 'B', 'C', 'D'];
                            foreach($rows as $row):
                                foreach($cols as $index => $col):
                                    $seatId = $row . $col;
                                    // Beri celah di tengah (Gang)
                                    if($index == 2) echo '<div></div>';
                            ?>
								<button class="h-10 w-10 rounded-xl text-[10px] font-black transition-all duration-200"
									@click="selectSeat('<?= $seatId ?>')"
									:class="{
									    'bg-gray-100 text-gray-400 hover:bg-gray-200': !bookedSeats.includes('<?= $seatId ?>') &&
									        selectedSeat !== '<?= $seatId ?>',
									    'bg-blue-600 text-white shadow-lg shadow-blue-200 scale-110': selectedSeat === '<?= $seatId ?>',
									    'bg-gray-300 text-white cursor-not-allowed': bookedSeats.includes('<?= $seatId ?>')
									}">
									<?= $seatId ?>
								</button>
								<?php endforeach; endforeach; ?>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="lg:w-80">
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
							x-text="selectedSeat
    ? 'Rp {{ number_format($jadwal->harga, 0, ',', '.') }}'
    : 'Rp 0'"></span>
					</div>

					<form method="GET" action="{{ route('checkout', $jadwal->id) }}">
						<input name="seat" type="hidden" :value="selectedSeat">

						<button
							class="w-full rounded-2xl py-4 text-xs font-black uppercase tracking-widest text-white shadow-lg transition active:scale-95"
							type="submit" :disabled="!selectedSeat"
							:class="selectedSeat
							    ?
							    'bg-blue-600 hover:bg-blue-700 shadow-blue-100' :
							    'bg-gray-200 cursor-not-allowed'">
							Lanjutkan
						</button>
					</form>
					<p class="mt-4 text-center text-[9px] text-gray-400">Dengan mengklik tombol, Anda menyetujui Syarat & Ketentuan
						PastiTravel.</p>
				</div>
			</div>
		</div>

	</body>

</html>
