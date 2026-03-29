@extends('layouts.app')

@section('title', 'Register Perusahaan | HubTrans System')

@section('nav-links')
@endsection

@section('content')
	<div class="flex min-h-screen items-center justify-center overflow-x-hidden p-4">

		<div class="w-full max-w-md overflow-hidden rounded-3xl bg-white shadow-2xl">
			<div class="bg-white p-8 pb-4 text-center">
				<div class="mb-4 inline-flex h-16 w-16 items-center justify-center rounded-2xl bg-blue-100 text-blue-700">
					<i class="fas fa-building text-3xl"></i>
				</div>
				<h1 class="text-2xl font-bold text-gray-800">Daftar Perusahaan</h1>
				<p class="text-sm text-gray-500">Ajukan menjadi admin perusahaan dan tunggu verifikasi superadmin</p>
			</div>

			<div class="p-8 pt-4">
				<form class="space-y-5" action="{{ route('register.company.store') }}" method="POST">
					@csrf
					<div>
						<label class="mb-2 block text-sm font-semibold text-gray-700">Nama Perusahaan</label>
						<input class="w-full rounded-xl border border-gray-200 bg-gray-50 p-3" name="company_name"
							value="{{ old('company_name') }}" required>
						@error('company_name')
							<p class="mt-1 text-sm text-red-600">{{ $message }}</p>
						@enderror
					</div>
					<div>
						<label class="mb-2 block text-sm font-semibold text-gray-700">Alamat Perusahaan</label>
						<textarea class="w-full rounded-xl border border-gray-200 bg-gray-50 p-3" name="company_address">{{ old('company_address') }}</textarea>
						@error('company_address')
							<p class="mt-1 text-sm text-red-600">{{ $message }}</p>
						@enderror
					</div>
					<div>
						<label class="mb-2 block text-sm font-semibold text-gray-700">Nama Admin</label>
						<input class="w-full rounded-xl border border-gray-200 bg-gray-50 p-3" name="nama" value="{{ old('nama') }}"
							required>
						@error('nama')
							<p class="mt-1 text-sm text-red-600">{{ $message }}</p>
						@enderror
					</div>
					<div>
						<label class="mb-2 block text-sm font-semibold text-gray-700">Email</label>
						<input class="w-full rounded-xl border border-gray-200 bg-gray-50 p-3" name="email" type="email"
							value="{{ old('email') }}" required>
						@error('email')
							<p class="mt-1 text-sm text-red-600">{{ $message }}</p>
						@enderror
					</div>
					<div>
						<label class="mb-2 block text-sm font-semibold text-gray-700">Password</label>
						<input class="w-full rounded-xl border border-gray-200 bg-gray-50 p-3" name="password" type="password" required>
						@error('password')
							<p class="mt-1 text-sm text-red-600">{{ $message }}</p>
						@enderror
					</div>
					<div>
						<label class="mb-2 block text-sm font-semibold text-gray-700">Konfirmasi Password</label>
						<input class="w-full rounded-xl border border-gray-200 bg-gray-50 p-3" name="password_confirmation" type="password"
							required>
					</div>

					<button class="w-full rounded-xl bg-blue-600 py-3 font-bold text-white" type="submit">Kirim Permohonan</button>
				</form>

				<div class="mt-6 text-center">
					<a class="inline-block w-full rounded-xl border border-blue-600 py-3 text-center font-bold text-blue-600"
						href="{{ route('login') }}">Sudah Punya Akun? Login</a>
				</div>
			</div>
		</div>

	</div>
@endsection
