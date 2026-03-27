<!DOCTYPE html>
<html lang="id">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Reset Password | HubTrans System</title>
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
				<div class="mb-4 inline-flex h-16 w-16 items-center justify-center rounded-2xl bg-green-100 text-green-700">
					<i class="fas fa-check-circle text-3xl"></i>
				</div>
				<h1 class="text-2xl font-bold text-gray-800">Reset Password</h1>
				<p class="text-sm text-gray-500">Buat password baru yang kuat</p>
			</div>

			<div class="p-8 pt-4">
				@if ($errors->any())
					<div class="mb-4 rounded-xl border border-red-200 bg-red-50 p-4">
						@foreach ($errors->all() as $error)
							<p class="text-sm font-bold text-red-700">
								<i class="fas fa-exclamation-circle mr-2"></i> {{ $error }}
							</p>
						@endforeach
					</div>
				@endif

				<form class="space-y-5" action="{{ route('password.reset') }}" method="POST">
					@csrf
					<input name="token" type="hidden" value="{{ $token }}">
					<input name="email" type="hidden" value="{{ $email }}">

					<div>
						<label class="mb-2 block text-sm font-semibold text-gray-700">Password Baru</label>
						<div class="relative">
							<i class="fas fa-lock absolute left-4 top-3.5 text-gray-400"></i>
							<input
								class="w-full rounded-xl border border-gray-200 bg-gray-50 py-3 pl-11 pr-4 outline-none transition-all focus:bg-white focus:ring-2 focus:ring-green-500"
								name="password" type="password" required placeholder="Minimal 8 karakter...">
						</div>
						@error('password')
							<p class="mt-1 text-xs text-red-500">{{ $message }}</p>
						@enderror
					</div>

					<div>
						<label class="mb-2 block text-sm font-semibold text-gray-700">Konfirmasi Password</label>
						<div class="relative">
							<i class="fas fa-lock absolute left-4 top-3.5 text-gray-400"></i>
							<input
								class="w-full rounded-xl border border-gray-200 bg-gray-50 py-3 pl-11 pr-4 outline-none transition-all focus:bg-white focus:ring-2 focus:ring-green-500"
								name="password_confirmation" type="password" required placeholder="Ulangi password baru...">
						</div>
					</div>

					<div class="rounded-xl border border-blue-200 bg-blue-50 p-3">
						<p class="text-xs font-semibold text-blue-700">
							<i class="fas fa-info-circle mr-2"></i> Password minimal 8 karakter, gunakan kombinasi huruf dan angka
						</p>
					</div>

					<button
						class="w-full transform rounded-xl bg-green-600 py-3.5 font-bold text-white shadow-lg shadow-green-200 transition-all hover:bg-green-700 active:scale-[0.98]"
						type="submit">
						RESET PASSWORD
					</button>
				</form>

				<div class="mt-6 text-center">
					<a class="text-sm font-semibold text-blue-600 hover:underline" href="{{ route('login') }}">
						<i class="fas fa-arrow-left mr-1"></i> Kembali ke Login
					</a>
				</div>
			</div>
		</div>

	</body>

</html>
