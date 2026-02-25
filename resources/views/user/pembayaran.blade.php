<!DOCTYPE html>
<html lang="id">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Pembayaran - HubTrans</title>
		<script src="https://cdn.tailwindcss.com"></script>
		<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
	</head>

	<body class="bg-gray-50 font-sans" x-data="{
    timeLeft: 0,
    init() {
        let expired = new Date('{{ $booking->expired_at }}').getTime();
        this.timeLeft = Math.floor((expired - new Date().getTime()) / 1000);
        setInterval(() => {
            if (this.timeLeft > 0) this.timeLeft--;
        }, 1000);
    },
    formatTime() {
        let h = Math.floor(this.timeLeft / 3600);
        let m = Math.floor((this.timeLeft % 3600) / 60);
        let s = this.timeLeft % 60;
        return `${h}:${m}:${s}`;
    }
}">

		<nav class="sticky top-0 z-40 bg-blue-700 p-4 text-white shadow-md">
			<div class="mx-auto flex max-w-6xl items-center justify-between px-2">
				<div class="flex items-center gap-4">
					<a class="rounded-lg bg-blue-600/50 p-2 transition hover:bg-blue-500" href="javascript:history.back()">
						<i class="fas fa-arrow-left"></i>
					</a>
					<h1 class="text-lg font-bold">Instruksi Pembayaran</h1>
				</div>
				<div class="hidden items-center gap-3 text-[10px] font-bold uppercase tracking-widest md:flex">
					<span class="opacity-50">Pilih</span>
					<i class="fas fa-chevron-right text-[8px] opacity-30"></i>
					<span class="opacity-50">Data</span>
					<i class="fas fa-chevron-right text-[8px] opacity-30"></i>
					<span class="rounded-full bg-white px-3 py-1 text-blue-700">Bayar</span>
				</div>
			</div>
		</nav>

		<div class="mx-auto flex max-w-6xl flex-col gap-8 px-4 py-8 lg:flex-row">

			<div class="flex-1 space-y-6">

				<div class="flex items-center justify-between rounded-3xl border border-orange-100 bg-orange-50 p-6">
					<div>
						<p class="text-[10px] font-black uppercase tracking-widest text-orange-400">Selesaikan dalam</p>
						<h3 class="text-xl font-black text-orange-600" x-text="formatTime()"></h3>
					</div>
					<i class="fas fa-clock text-3xl text-orange-200"></i>
				</div>

				<div
					class="transform rounded-3xl border border-gray-300 bg-white p-8 shadow-2xl ring-1 ring-gray-100 transition-all hover:-translate-y-1">
					<h3 class="mb-6 text-sm font-black uppercase tracking-widest text-gray-800">Transfer Ke</h3>

					<div class="flex items-center gap-6 rounded-2xl border border-dashed border-gray-200 bg-gray-50 p-6">
						<div
							class="flex h-10 w-16 items-center justify-center rounded-lg border border-gray-100 bg-white font-bold italic text-blue-800 shadow-sm">
							BCA
						</div>
						<div class="flex-1">
							<p class="text-[10px] font-black uppercase tracking-widest text-gray-400">Nomor Rekening / VA</p>
							<div class="flex items-center gap-3">
								<span
									class="text-xl font-black tracking-wider text-gray-800">{{ chunk_split($booking->kode_booking, 4, ' ') }}</span>
								<button class="text-xs font-bold text-blue-600 hover:underline" @click="copyVA()">
									<span x-show="!copied">SALIN</span>
									<span class="text-green-600" x-show="copied"><i class="fas fa-check"></i> TERSALIN</span>
								</button>
							</div>
							<p class="mt-1 text-xs font-bold uppercase text-gray-500">Atas Nama: PT HUBTRANS INDONESIA</p>
						</div>
					</div>

					<div class="mt-8 space-y-4">
						<h4 class="text-xs font-black uppercase tracking-widest text-gray-800">Instruksi Pembayaran:</h4>
						<ul class="space-y-3">
							<li class="flex gap-3 text-sm text-gray-600">
								<span
									class="flex h-5 w-5 flex-shrink-0 items-center justify-center rounded-full bg-blue-100 text-[10px] font-bold text-blue-600">1</span>
								Masukkan kartu ATM dan PIN Anda atau buka aplikasi M-Banking.
							</li>
							<li class="flex gap-3 text-sm text-gray-600">
								<span
									class="flex h-5 w-5 flex-shrink-0 items-center justify-center rounded-full bg-blue-100 text-[10px] font-bold text-blue-600">2</span>
								Pilih menu Transfer ke Rekening Bank Lain / Virtual Account.
							</li>
							<li class="flex gap-3 text-sm text-gray-600">
								<span
									class="flex h-5 w-5 flex-shrink-0 items-center justify-center rounded-full bg-blue-100 text-[10px] font-bold text-blue-600">3</span>
								Masukkan jumlah yang sesuai: <strong class="text-orange-600">Rp
									{{ number_format($booking->total_harga, 0, ',', '.') }}</strong>.
							</li>
						</ul>
					</div>
				</div>

				<div
					class="transform rounded-3xl border border-gray-300 bg-white p-8 shadow-2xl ring-1 ring-gray-100 transition-all hover:-translate-y-1">
					<div class="mb-6 flex items-center gap-3">
						<div class="flex h-10 w-10 items-center justify-center rounded-full bg-green-50 text-green-600">
							<i class="fas fa-upload"></i>
						</div>
						<h3 class="text-sm font-black uppercase tracking-wider text-gray-800">Upload Bukti Transfer</h3>
					</div>

					<form class="rounded-2xl border-2 border-dashed border-gray-200 p-8 text-center" method="POST"
						action="{{ route('upload.bukti', $booking->id) }}" enctype="multipart/form-data" x-data="{ fileName: '', preview: null }">

						@csrf

						<label class="block cursor-pointer">
							<input class="hidden" name="bukti_transfer" type="file" required
								@change="
                let file = $event.target.files[0];
                fileName = file?.name;
                preview = URL.createObjectURL(file);
            ">

							<div x-show="!fileName">
								<i class="fas fa-image mb-4 text-4xl text-gray-300"></i>
								<p class="text-sm font-bold text-gray-500">
									Klik untuk pilih foto bukti transfer
								</p>
							</div>

							<div class="flex flex-col items-center gap-3" x-show="fileName">
								<img class="max-h-32 rounded-xl" :src="preview">
								<p class="text-sm font-black text-gray-800" x-text="fileName"></p>
							</div>
						</label>

						<button class="mt-6 w-full rounded-xl bg-green-600 py-3 text-xs font-bold text-white hover:bg-green-700"
							type="submit">
							Upload Bukti
						</button>

					</form>
				</div>
			</div>

			<div class="lg:w-80">
				<div
					class="sticky top-24 transform rounded-3xl border border-gray-300 bg-white p-6 shadow-2xl ring-1 ring-gray-100 transition-all hover:-translate-y-1">
					<h3 class="mb-4 text-sm font-black uppercase text-gray-800">Ringkasan Pembayaran</h3>

					<div class="mb-6 space-y-3">
						<div class="flex justify-between text-xs">
							<span class="font-bold uppercase text-gray-400">Kode Booking</span>
							<span class="font-black text-gray-800">{{ $booking->kode_booking }}</span>
						</div>
						<div class="flex justify-between text-xs">
							<span class="font-bold uppercase text-gray-400">Harga Tiket</span>
							<span class="font-bold text-gray-800">Rp 125.000</span>
						</div>
						<div class="flex justify-between text-xs">
							<span class="font-bold uppercase text-gray-400">Biaya Layanan</span>
							<span class="font-bold text-gray-800">Rp 0</span>
						</div>
						<div class="flex items-center justify-between border-t pt-3">
							<span class="text-[10px] font-black uppercase text-gray-400">Total Bayar</span>
							<span class="text-xl font-black tracking-tighter text-orange-500">Rp
								{{ number_format($booking->total_harga, 0, ',', '.') }}</span>
						</div>
					</div>

					@if ($booking->status === 'uploaded')
						<form method="POST" action="{{ route('konfirmasi.pembayaran', $booking->id) }}"> @csrf <button
								class="w-full rounded-2xl bg-green-600 py-4 text-xs font-black uppercase tracking-widest text-white"> Konfirmasi
								Pembayaran </button> </form>
					@else
						<button class="w-full rounded-2xl bg-gray-300 py-4 text-xs font-black uppercase tracking-widest text-white"
							disabled> Upload Bukti Dahulu </button>
					@endif

					<div class="mt-6 rounded-xl bg-blue-50 p-4">
						<div class="flex gap-3">
							<i class="fas fa-info-circle mt-0.5 text-blue-500"></i>
							<p class="text-[9px] font-bold uppercase leading-relaxed text-blue-700">Proses verifikasi manual membutuhkan
								waktu sekitar 5-15 menit setelah bukti diunggah.</p>
						</div>
					</div>
				</div>
			</div>
		</div>

	</body>

</html>
