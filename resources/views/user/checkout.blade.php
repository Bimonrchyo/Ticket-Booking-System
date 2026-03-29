@extends('layouts.app')

@section('title', 'Checkout | PastiTravel')

@push('scripts')
	<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endpush

@section('nav-links')
@endsection

@section('content')
	<div class="bg-gray-50 font-sans" x-data="{
    sameAsBooker: false,
    bookerName: '',
    passengerName: '',
    passengerID: '',
    updatePassenger() {
        if (this.sameAsBooker) {
            this.passengerName = this.bookerName;
        }
    }
}">

		<nav class="sticky top-0 z-40 bg-blue-700 p-4 text-white shadow-md">
			<div class="mx-auto flex max-w-6xl items-center justify-between px-2">
				<div class="flex items-center gap-4">
					<a class="rounded-lg bg-blue-600/50 p-2 transition hover:bg-blue-500" href="javascript:history.back()">
						<i class="fas fa-arrow-left"></i>
					</a>
					<h1 class="text-lg font-bold">Checkout</h1>
				</div>
				<div class="hidden items-center gap-3 text-[10px] font-bold uppercase tracking-widest md:flex">
					<span class="opacity-50">Pilih</span>
					<i class="fas fa-chevron-right text-[8px] opacity-30"></i>
					<span class="rounded-full bg-white px-3 py-1 text-blue-700">Data</span>
					<i class="fas fa-chevron-right text-[8px] opacity-30"></i>
					<span class="opacity-50">Bayar</span>
				</div>
			</div>
		</nav>

		<form method="POST" action="{{ route('booking.store', $jadwal->id) }}">
			@csrf
			<input name="nomor_kursi" type="hidden" value="{{ $seat }}">
			<div class="mx-auto flex max-w-6xl flex-col gap-8 px-4 py-8 lg:flex-row">

				<div class="flex-1 space-y-6">
					<div
						class="transform rounded-3xl border border-gray-300 bg-white p-6 shadow-2xl ring-1 ring-gray-100 transition-all hover:-translate-y-1">
						<div class="mb-6 flex items-center gap-3">
							<div class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-50 text-blue-600">
								<i class="fas fa-envelope"></i>
							</div>
							<h3 class="text-sm font-black uppercase tracking-wider text-gray-800">Informasi Kontak</h3>
						</div>

						<div class="grid grid-cols-1 gap-4 md:grid-cols-2">
							<div>
								<label class="mb-2 block text-[10px] font-black uppercase tracking-widest text-gray-400">Nama Lengkap</label>
								<input
									class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm outline-none transition focus:ring-2 focus:ring-blue-500"
									name="nama_pemesan" type="text" x-model="bookerName" @input="updatePassenger"
									placeholder="Sesuai KTP/Paspor">
							</div>
							<div>
								<label class="mb-2 block text-[10px] font-black uppercase tracking-widest text-gray-400">Nomor WhatsApp</label>
								<input
									class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm outline-none transition focus:ring-2 focus:ring-blue-500"
									name="whatsapp" type="tel" placeholder="0812xxxx">
							</div>
							<div class="md:col-span-2">
								<label class="mb-2 block text-[10px] font-black uppercase tracking-widest text-gray-400">Email</label>
								<input
									class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm outline-none transition focus:ring-2 focus:ring-blue-500"
									name="email" type="email" placeholder="contoh@email.com">
								<p class="mt-2 text-[9px] italic text-gray-400">* E-Tiket akan dikirimkan ke email ini</p>
							</div>
						</div>
					</div>

					<div
						class="transform rounded-3xl border border-gray-300 bg-white p-6 shadow-2xl ring-1 ring-gray-100 transition-all hover:-translate-y-1">
						<div class="mb-6 flex items-center justify-between">
							<div class="flex items-center gap-3">
								<div class="flex h-10 w-10 items-center justify-center rounded-full bg-orange-50 text-orange-600">
									<i class="fas fa-user"></i>
								</div>
								<h3 class="text-sm font-black uppercase tracking-wider text-gray-800">Detail Penumpang 1</h3>
							</div>
							<label class="flex cursor-pointer items-center gap-2">
								<span class="text-[11px] font-bold uppercase text-gray-500">Sama dengan pemesan?</span>
								<div class="relative">
									<input class="sr-only" type="checkbox" x-model="sameAsBooker" @change="updatePassenger">
									<div class="h-6 w-12 rounded-full bg-gray-300 shadow-lg transition-colors duration-200 ease-in-out"
										:class="sameAsBooker ? 'bg-blue-600' : 'bg-gray-300'"></div>
									<div
										class="absolute left-1 top-1 h-4 w-4 transform rounded-full bg-white shadow-2xl ring-1 ring-gray-200 transition-transform duration-200 ease-in-out"
										:class="sameAsBooker ? 'translate-x-6' : ''"></div>
								</div>
							</label>
						</div>

						<div class="space-y-4">
							<div>
								<label class="mb-2 block text-[10px] font-black uppercase tracking-widest text-gray-400">Nama Lengkap (Sesuai
									ID)</label>
								<input
									class="w-full rounded-xl border border-gray-200 px-4 py-3 text-sm outline-none transition focus:ring-2 focus:ring-blue-500"
									name="nama_penumpang" type="text" x-model="passengerName" :disabled="sameAsBooker" required
									:class="sameAsBooker ? 'bg-gray-100 text-gray-500' : 'bg-gray-50'">
							</div>
							<div>
								<label class="mb-2 block text-[10px] font-black uppercase tracking-widest text-gray-400">NIK</label>
								<div class="relative">
									<i class="fas fa-id-card absolute left-4 top-1/2 -translate-y-1/2 text-gray-300"></i>
									<input
										class="w-full rounded-xl border border-gray-200 bg-gray-50 py-3 pl-12 pr-4 text-sm outline-none transition focus:ring-2 focus:ring-blue-500"
										name="nik" type="text" x-model="passengerID" required placeholder="Masukkan 16 digit NIK">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="lg:w-80">
					<div
						class="sticky top-24 transform rounded-3xl border border-gray-300 bg-white p-6 shadow-2xl ring-1 ring-gray-100 transition-all hover:-translate-y-1">
						<h3 class="mb-4 text-sm font-black uppercase text-gray-800">Ringkasan Pesanan</h3>

						<div class="mb-6 space-y-4">
							<div class="flex items-start gap-3">
								<i
									class="fas @if ($jadwal->transportasi->tipe === 'pesawat') fa-plane
@elseif($jadwal->transportasi->tipe === 'kereta') fa-train
@elseif($jadwal->transportasi->tipe === 'kapal') fa-ship
@else fa-bus @endif mt-1 text-blue-600"></i>
								<div>
									<p class="text-xs font-black text-gray-800">{{ $jadwal->transportasi->nama_brand }}</p>
									<p class="text-[10px] font-bold uppercase text-gray-400">{{ strtoupper($jadwal->transportasi->tipe) }} • Kursi
										{{ $seat }}</p>
								</div>
							</div>
							<div class="ml-2 space-y-3 border-l-2 border-dashed border-gray-100 pl-4">
								<div>
									<p class="text-[10px] font-black uppercase text-gray-400">Pergi</p>
									<p class="text-xs font-bold text-gray-700">{{ $jadwal->asal->nama }} ({{ $jadwal->asal->kode }})</p>
									<p class="text-[9px] text-gray-400">
										{{ \Carbon\Carbon::parse($jadwal->waktu_berangkat)->translatedFormat('l, d M • H:i') }}</p>
								</div>
								<div>
									<p class="text-[10px] font-black uppercase text-gray-400">Tiba</p>
									<p class="text-xs font-bold text-gray-700">{{ $jadwal->tujuan->nama }} ({{ $jadwal->tujuan->kode }})</p>
									<p class="text-[9px] text-gray-400">
										{{ \Carbon\Carbon::parse($jadwal->waktu_tiba)->translatedFormat('l, d M • H:i') }}</p>
								</div>
							</div>
						</div>

						<div class="mb-6 space-y-2 border-t pt-4">
							<div class="flex items-center justify-between text-sm">
								<span class="font-bold text-gray-700">Harga Tiket</span>
								<span class="font-bold">Rp {{ number_format($jadwal->harga, 0, ',', '.') }}</span>
							</div>
							<div class="flex items-center justify-between text-sm">
								<span class="text-gray-500">Biaya Layanan PastiTravel</span>
								<span class="text-gray-500">Rp 10.000</span>
							</div>
							<div class="h-px bg-gray-200"></div>
							<div class="flex items-center justify-between">
								<span class="text-lg font-bold uppercase text-gray-800">TOTAL BAYAR</span>
								<span class="text-2xl font-black tracking-tighter text-orange-600">Rp
									{{ number_format($jadwal->harga + 10000, 0, ',', '.') }}</span>
							</div>
							<p class="mt-2 text-[10px] font-bold text-green-600">✅ Termasuk E-Tiket digital & support 24/7</p>
						</div>

						<button
							class="w-full rounded-2xl bg-blue-700 py-4 text-xs font-black uppercase tracking-widest text-white shadow-xl transition hover:bg-blue-800"
							type="submit">
							Lanjutkan Pembayaran
						</button>

						<div class="mt-4 flex items-start gap-2 text-[9px] leading-relaxed text-gray-400">
							<i class="fas fa-shield-alt mt-0.5 text-green-500"></i>
							<p>Data Anda aman dan terenkripsi. E-Tiket akan diterbitkan segera setelah pembayaran dikonfirmasi.</p>
						</div>
					</div>
				</div>

			</div>
		</form>

	</div>
@endsection
