<!DOCTYPE html>
<html lang="id">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Pembayaran - HubTrans</title>
		<script src="https://cdn.tailwindcss.com"></script>
		<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
		@vite(['resources/css/app.css', 'resources/js/app.js'])
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
		<script>
			function paymentData(initialSeconds) {
				return {
					timeLeft: initialSeconds,
					isDragging: false,
					fileName: '',
					preview: null,
					copied: false,

					init() {
						// Timer Logic
						let timer = setInterval(() => {
							if (this.timeLeft > 0) {
								this.timeLeft--;
							} else {
								clearInterval(timer);
							}
						}, 1000);
					},

					copyVA() {
						let va = document.querySelector('.va-code').innerText.replace(/\s+/g, '');
						navigator.clipboard.writeText(va).then(() => {
							this.copied = true;
							setTimeout(() => (this.copied = false), 2000);
						});
					},

					formatTime() {
						if (this.timeLeft <= 0) return '00:00:00';
						let h = Math.floor(this.timeLeft / 3600);
						let m = Math.floor((this.timeLeft % 3600) / 60);
						let s = this.timeLeft % 60;
						return `${String(h).padStart(2, '0')}:${String(m).padStart(2, '0')}:${String(s).padStart(2, '0')}`;
					},

					selectFile(event) {
						const file = event.target.files[0];
						this.processFile(file);
					},

					handleDrop(event) {
						this.isDragging = false;
						const file = event.dataTransfer.files[0];
						if (file) {
							this.$refs.fileInput.files = event.dataTransfer.files;
							this.processFile(file);
						}
					},

					processFile(file) {
						if (!file) return;

						// Validasi tipe file (Opsional tapi disarankan)
						const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'application/pdf'];
						if (!allowedTypes.includes(file.type)) {
							alert('Format file tidak didukung (Gunakan JPG, PNG, atau PDF)');
							return;
						}

						this.fileName = file.name;
						this.preview = URL.createObjectURL(file);

						// KITA HAPUS BAGIAN SUBMIT OTOMATIS DI SINI
						console.log("File siap, menunggu user klik tombol submit.");
					}
				};
			}
		</script>
	</head>

	<body class="bg-gray-50 font-sans" x-data="paymentData({{ (int) $timeLeft }})">

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
		<form class="rounded-2xl border-2 border-dashed border-gray-200 p-8 text-center" x-ref="uploadForm" method="POST"
			action="{{ route('upload.bukti', $booking->id) }}" enctype="multipart/form-data">
			@csrf
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

						<div class="flex items-center gap-6 rounded-2xl border border-dashed border-gray-200 bg-gray-50 p-6 text-left">
							<div
								class="flex h-10 w-16 items-center justify-center rounded-lg border border-gray-100 bg-white font-bold italic text-blue-800 shadow-sm">
								BCA
							</div>
							<div class="flex-1">
								<p class="text-[10px] font-black uppercase tracking-widest text-gray-400">Nomor Rekening / VA</p>
								<div class="flex items-center gap-3">
									<span
										class="va-code text-xl font-black tracking-wider text-gray-800">{{ chunk_split($booking->kode_booking, 4, ' ') }}</span>
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
						class="transform rounded-3xl border border-gray-300 bg-white p-8 shadow-2xl transition-all hover:-translate-y-1">
						<div class="mb-6 flex items-center gap-3">
							<div class="flex h-10 w-10 items-center justify-center rounded-full bg-green-50 text-green-600">
								<i class="fas fa-upload"></i>
							</div>
							<h3 class="text-sm font-black uppercase tracking-wider text-gray-800">Upload Bukti Transfer</h3>
						</div>



						<input class="hidden" id="fileInput" name="bukti_transfer" type="file" accept="image/*,application/pdf"
							@change="selectFile($event)" x-ref="fileInput">

						<div
							class="relative cursor-pointer rounded-2xl border border-dashed border-gray-400 bg-gray-50 px-6 py-14 text-center transition-colors"
							:class="{ 'border-green-500 bg-green-100': isDragging }" @click="$refs.fileInput.click()"
							@dragover.prevent="isDragging = true" @dragleave.prevent="isDragging = false" @drop.prevent="handleDrop($event)">

							<template x-if="!fileName">
								<div>
									<i class="fas fa-cloud-upload-alt mb-3 text-4xl text-gray-400"></i>
									<p class="text-sm font-black text-gray-500">Drag & drop file bukti transfer di sini</p>
									<p class="text-xs text-gray-400">atau klik untuk memilih file</p>
								</div>
							</template>

							<template x-if="fileName">
								<div class="flex flex-col items-center gap-3">
									<img class="max-h-28 rounded-xl shadow-md" :src="preview" x-show="preview">
									<p class="text-sm font-black text-gray-800" x-text="fileName"></p>
									<p class="text-xs font-bold text-blue-600">File siap dikirim. Klik konfirmasi pembayaran.</p>
								</div>
							</template>
						</div>
					</div>
				</div>

				<div class="lg:w-80">
					<div class="sticky top-24 transform rounded-3xl border border-gray-300 bg-white p-6 shadow-2xl">
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
						<div class="mt-6">
							<button
								class="w-full rounded-2xl py-4 text-xs font-black uppercase tracking-widest text-white shadow-lg transition-all"
								type="submit" :class="fileName ? 'bg-green-600 hover:bg-green-700' : 'bg-gray-400 cursor-not-allowed'"
								:disabled="!fileName">
								<span x-text="fileName ? 'Konfirmasi Pembayaran' : 'Pilih Bukti Dahulu'"></span>
							</button>
							<p class="mt-2 text-center text-[10px] font-bold text-gray-400" x-show="!fileName">
								*Anda harus memilih file bukti transfer sebelum konfirmasi.
							</p>
						</div>
					</div>
				</div>
			</div>
		</form>


	</body>

</html>
