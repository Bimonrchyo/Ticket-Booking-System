@extends('layouts.app')

@section('title', 'Lupa Password | PastiTravel System')

@push('styles')
	<style>
		body {
			background: linear-gradient(135deg, #1d4ed8 0%, #1e40af 100%);
		}
	</style>
@endpush

@section('nav-links')
@endsection

@section('content')
	<div class="flex min-h-screen items-center justify-center overflow-x-hidden p-4">

		<div class="w-full max-w-md overflow-hidden rounded-3xl bg-white shadow-2xl">
			<div class="bg-white p-8 pb-4 text-center">
				<div class="mb-4 inline-flex h-16 w-16 items-center justify-center rounded-2xl bg-blue-100 text-blue-700">
					<i class="fas fa-key text-3xl"></i>
				</div>
				<h1 class="text-2xl font-bold text-gray-800">Lupa Password</h1>
				<p class="text-sm text-gray-500">Masukkan email Anda untuk reset password</p>
			</div>

			<div class="p-8 pt-4">
				<form class="space-y-5" action="{{ route('password.email') }}" method="POST">
					@csrf
					<div>
						<label class="mb-2 block text-sm font-semibold text-gray-700">Email</label>
						<div class="relative">
							<i class="fas fa-envelope absolute left-4 top-3.5 text-gray-400"></i>
							<input
								class="w-full rounded-xl border border-gray-200 bg-gray-50 py-3 pl-11 pr-4 outline-none transition-all focus:bg-white focus:ring-2 focus:ring-blue-500"
								name="email" type="email" value="{{ old('email') }}" required placeholder="Masukkan email anda...">
						</div>
						@error('email')
							<p class="mt-1 text-sm text-red-600">{{ $message }}</p>
						@enderror
					</div>

					<button
						class="w-full transform rounded-xl bg-blue-600 py-3 font-bold text-white shadow-lg transition hover:bg-blue-700 active:scale-95"
						type="submit">
						KIRIM LINK RESET
					</button>
				</form>

				<div class="mt-6 text-center">
					<a
						class="inline-block w-full rounded-xl border border-blue-600 py-3 text-center font-bold text-blue-600 transition hover:bg-blue-50"
						href="{{ route('login') }}">
						KEMBALI KE LOGIN
					</a>
				</div>
			</div>

			<div class="border-t border-gray-100 bg-gray-50 p-6 text-center">
				<p class="text-xs text-gray-500">Ingat password Anda? <a class="font-semibold text-blue-600 hover:underline"
						href="{{ route('login') }}">Login di sini</a></p>
			</div>
		</div>

	</div>
@endsection
