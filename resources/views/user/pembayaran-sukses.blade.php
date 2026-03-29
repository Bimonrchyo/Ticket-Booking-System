@extends('layouts.app')

@section('content')
	<div class="flex min-h-screen flex-col justify-center bg-gray-50 py-12 sm:px-6 lg:px-8">
		<div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
			<div class="bg-white px-4 py-8 shadow sm:rounded-lg sm:px-10">
				<div class="text-center">
					<div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-green-100">
						<svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
						</svg>
					</div>
					<h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
						Pembayaran Berhasil!
					</h2>
					<p class="mt-2 text-center text-sm text-gray-600">
						Bukti pembayaran Anda telah berhasil dikirim. Silakan tunggu verifikasi dari admin.
					</p>
				</div>

				<div class="mt-6">
					<div class="relative">
						<div class="absolute inset-0 flex items-center">
							<div class="w-full border-t border-gray-300"></div>
						</div>
						<div class="relative flex justify-center text-sm">
							<span class="bg-white px-2 text-gray-500">Apa selanjutnya?</span>
						</div>
					</div>

					<div class="mt-6 grid grid-cols-1 gap-3">
						<a
							class="flex w-full justify-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
							href="{{ route('history') }}">
							Lihat Riwayat Pemesanan
						</a>
						<a
							class="flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
							href="{{ route('home') }}">
							Kembali ke Beranda
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
