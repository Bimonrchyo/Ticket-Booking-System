@extends('layouts.app')

@section('title', 'Riwayat Pemesanan | HubTrans')

@section('nav-links')
	<a class="hover:text-blue-200" href="{{ route('home') }}">Beranda</a>
	<a class="border-b-2 border-orange-400 text-orange-400" href="{{ route('history') }}">Histori</a>
@endsection

@section('content')
	<div class="min-h-screen bg-gray-50 py-8">
		<div class="mx-auto max-w-6xl px-4">

			<div class="mb-6">
				<h1 class="text-2xl font-bold text-gray-800">Riwayat Pemesanan</h1>
				<p class="text-gray-600">Lihat semua pemesanan tiket Anda</p>
			</div>

			@if ($histori->isEmpty())
				<div class="rounded-lg border border-dashed border-gray-300 bg-white p-8 text-center">
					<p class="text-gray-600">Tidak ada riwayat pemesanan saat ini.</p>
					<p class="text-sm text-gray-500">Lakukan pencarian dan pemesanan tiket terlebih dahulu.</p>
				</div>
			@else
				<div class="space-y-4">
					@foreach ($histori as $booking)
						<div class="rounded-lg border bg-white p-6 shadow-sm">
							<div class="flex flex-wrap items-center justify-between gap-3">
								<div>
									<h2 class="text-lg font-semibold text-gray-800">
										{{ optional($booking->jadwal->transportasi)->nama_brand ?? 'Transportasi tidak ditemukan' }}</h2>
									<p class="text-sm text-gray-500">
										{{ optional($booking->jadwal->asal)->nama ?? '-' }} &rarr;
										{{ optional($booking->jadwal->tujuan)->nama ?? '-' }}
										&nbsp;&middot;&nbsp;{{ optional($booking->jadwal)->waktu_berangkat
										    ? \Carbon\Carbon::parse($booking->jadwal->waktu_berangkat)->format('d M Y')
										    : '-' }}
									</p>
								</div>
								<div class="text-right">
									<span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700">Status:
										{{ ucfirst($booking->status) }}</span>
									@if ($booking->payment)
										<span class="ml-2 rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-700">Pembayaran:
											{{ ucfirst($booking->payment->status) }}</span>
									@endif
								</div>
							</div>

							<div class="mt-4 grid grid-cols-1 gap-2 sm:grid-cols-2">
								<div class="rounded border border-gray-200 bg-gray-50 p-3">
									<p class="text-sm text-gray-500">Kode Booking</p>
									<p class="font-semibold text-gray-800">{{ $booking->kode_booking }}</p>
								</div>
								<div class="rounded border border-gray-200 bg-gray-50 p-3">
									<p class="text-sm text-gray-500">Nomor Kursi</p>
									<p class="font-semibold text-gray-800">{{ $booking->nomor_kursi }}</p>
								</div>
								<div class="rounded border border-gray-200 bg-gray-50 p-3">
									<p class="text-sm text-gray-500">Total Harga</p>
									<p class="font-semibold text-gray-800">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</p>
								</div>
								<div class="rounded border border-gray-200 bg-gray-50 p-3">
									<p class="text-sm text-gray-500">Terakhir Diperbarui</p>
									<p class="font-semibold text-gray-800">{{ $booking->updated_at->format('d M Y H:i') }}</p>
								</div>
							</div>

							<div class="mt-4 flex flex-wrap gap-2">
								@if (in_array($booking->status, ['paid', 'completed']))
									<a class="rounded bg-green-600 px-4 py-2 text-sm font-medium text-white hover:bg-green-700"
										href="{{ route('ticket.print', $booking->id) }}">Cetak Tiket</a>
									<a class="rounded border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100"
										href="{{ route('invoice.print', $booking->id) }}">Cetak Invoice</a>
								@elseif($booking->status === 'canceled')
									<span class="rounded bg-red-100 px-4 py-2 text-sm font-medium text-red-700">Pemesanan Dibatalkan</span>
									<a class="rounded border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100"
										href="{{ route('pencarian') }}" onclick="return confirm('Anda akan melakukan pemesanan baru, lanjut?')">Pesan
										Lagi</a>
								@elseif($booking->status === 'pending')
									@if (!$booking->payment || $booking->payment->status === 'unpaid')
										<a class="rounded bg-orange-500 px-4 py-2 text-sm font-medium text-white hover:bg-orange-600"
											href="{{ route('pembayaran', $booking->id) }}">Lanjut Pembayaran</a>
									@elseif($booking->payment->status === 'pending')
										<button class="cursor-not-allowed rounded bg-yellow-400 px-4 py-2 text-sm font-medium text-white"
											disabled>Menunggu Verifikasi</button>
									@elseif($booking->payment->status === 'rejected')
										<form class="inline" action="{{ route('pembayaran.ulang', $booking->id) }}" method="POST"
											onsubmit="return confirm('Anda yakin ingin mengulangi pembayaran? Status akan diubah menjadi pending.')">
											@csrf
											<button class="rounded bg-red-500 px-4 py-2 text-sm font-medium text-white hover:bg-red-600"
												type="submit">Ulangi Pembayaran</button>
										</form>
										<a class="rounded bg-orange-500 px-4 py-2 text-sm font-medium text-white hover:bg-orange-600"
											href="{{ route('pembayaran', $booking->id) }}"
											onclick="return confirm('Lanjutkan ke halaman pembayaran?')">Pembayaran Lagi</a>
									@else
										<a class="rounded bg-orange-500 px-4 py-2 text-sm font-medium text-white hover:bg-orange-600"
											href="{{ route('pembayaran', $booking->id) }}">Lanjut Pembayaran</a>
									@endif
								@else
									<span class="rounded bg-gray-100 px-4 py-2 text-sm font-medium text-gray-700">Status tidak tersedia</span>
								@endif
								<a class="rounded border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100"
									href="{{ route('home') }}">Lihat Jadwal Lain</a>
							</div>
						</div>
					@endforeach
				</div>
			@endif
		</div>
	</div>
@endsection
