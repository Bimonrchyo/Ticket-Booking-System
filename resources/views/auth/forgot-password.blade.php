<!DOCTYPE html>
<html lang="id">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Lupa Password | HubTrans System</title>
		<script src="https://cdn.tailwindcss.com"></script>
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
		<style>
			body {
				background: linear-gradient(135deg, #1d4ed8 0%, #1e40af 100%);
			}
		</style>
	</head>

	<body class="flex min-h-screen items-center justify-center overflow-x-hidden p-4">

		<div class="w-full max-w-md overflow-hidden rounded-3xl bg-white shadow-2xl">
			<div class="bg-white p-8 pb-4 text-center">
				<div class="mb-4 inline-flex h-16 w-16 items-center justify-center rounded-2xl bg-amber-100 text-amber-700">
					<i class="fas fa-lock-open text-3xl"></i>
				</div>
				<h1 class="text-2xl font-bold text-gray-800">Lupa Password?</h1>
				<p class="text-sm text-gray-500">Masukkan email Anda untuk reset password</p>
			</div>

			<div class="p-8 pt-4">
				@if ($errors->any())
					<div class="mb-4 rounded-xl border border-red-200 bg-red-50 p-4">
						<p class="text-sm font-bold text-red-700">
							<i class="fas fa-exclamation-circle mr-2"></i> {{ $errors->first() }}
						</p>
					</div>
				@endif

				@if (session('success'))
					<div class="mb-4 rounded-xl border border-green-200 bg-green-50 p-4">
						<p class="text-sm font-bold text-green-700">
							<i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
						</p>
					</div>
				@endif

				<form class="space-y-5" action="{{ route('password.email') }}" method="POST">
					@csrf
					<div>
						<label class="mb-2 block text-sm font-semibold text-gray-700">Email Address</label>
						<div class="relative">
							<i class="fas fa-envelope absolute left-4 top-3.5 text-gray-400"></i>
							<input
								class="w-full rounded-xl border border-gray-200 bg-gray-50 py-3 pl-11 pr-4 outline-none transition-all focus:bg-white focus:ring-2 focus:ring-amber-500"
								name="email" type="email" value="{{ old('email') }}" required
								placeholder="Masukkan email terdaftar Anda...">
						</div>
						@error('email')
							<p class="mt-1 text-xs text-red-500">{{ $message }}</p>
						@enderror
					</div>

					<button
						class="w-full transform rounded-xl bg-amber-600 py-3.5 font-bold text-white shadow-lg shadow-amber-200 transition-all hover:bg-amber-700 active:scale-[0.98]"
						type="submit">
						KIRIM LINK RESET
					</button>
				</form>

				<div class="relative my-8">
					<div class="absolute inset-0 flex items-center">
						<div class="w-full border-t border-gray-200"></div>
					</div>
					<div class="relative flex justify-center text-sm">
						<span class="bg-white px-4 italic text-gray-400">Atau</span>
					</div>
				</div>

				<div class="space-y-3">
					<a
						class="inline-block w-full rounded-xl border-2 border-blue-600 py-3 text-center font-bold text-blue-600 transition-all hover:bg-blue-50"
						href="{{ route('login') }}">
						<i class="fas fa-sign-in-alt mr-2"></i> KEMBALI KE LOGIN
					</a>
					<a
						class="inline-block w-full rounded-xl py-3 text-center font-bold text-gray-500 transition-all hover:text-blue-600"
						href="{{ route('register') }}">
						BUAT AKUN BARU <i class="fas fa-arrow-right ml-1"></i>
					</a>
				</div>
			</div>
		</div>

	</body>

</html>
