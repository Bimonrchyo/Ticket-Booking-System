<!DOCTYPE html>
<html lang="id">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Login | HubTrans System</title>
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
				<div class="mb-4 inline-flex h-16 w-16 items-center justify-center rounded-2xl bg-blue-100 text-blue-700">
					<i class="fas fa-route text-3xl"></i>
				</div>
				<h1 class="text-2xl font-bold text-gray-800">Selamat Datang</h1>
				<p class="text-sm text-gray-500">Silakan masuk ke akun HubTrans Anda</p>
			</div>

			<div class="p-8 pt-4">
				<form class="space-y-5" action="/login" method="POST">
					@csrf
					<div>
						<label class="mb-2 block text-sm font-semibold text-gray-700">Email</label>
						<div class="relative">
							<i class="fas fa-user absolute left-4 top-3.5 text-gray-400"></i>
							<input
								class="w-full rounded-xl border border-gray-200 bg-gray-50 py-3 pl-11 pr-4 outline-none transition-all focus:bg-white focus:ring-2 focus:ring-blue-500"
								name="email" type="text" required placeholder="Masukkan email anda...">
						</div>
					</div>

					<div>
						<div class="mb-2 flex justify-between">
							<label class="text-sm font-semibold text-gray-700">Password</label>
							<a class="text-xs font-bold text-blue-600 hover:underline" href="{{ route('password.request') }}">Lupa
								Password?</a>
						</div>
						<div class="relative">
							<i class="fas fa-lock absolute left-4 top-3.5 text-gray-400"></i>
							<input
								class="w-full rounded-xl border border-gray-200 bg-gray-50 py-3 pl-11 pr-4 outline-none transition-all focus:bg-white focus:ring-2 focus:ring-blue-500"
								name="password" type="password" required placeholder="••••••••">
						</div>
					</div>

					<div class="flex items-center">
						<input class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500" id="remember" type="checkbox">
						<label class="ml-2 text-sm text-gray-600" for="remember">Ingat saya di perangkat ini</label>
					</div>

					<button
						class="w-full transform rounded-xl bg-blue-600 py-3.5 font-bold text-white shadow-lg shadow-blue-200 transition-all hover:bg-blue-700 active:scale-[0.98]"
						type="submit">
						MASUK SEKARANG
					</button>
				</form>

				<div class="relative my-8">
					<div class="absolute inset-0 flex items-center">
						<div class="w-full border-t border-gray-200"></div>
					</div>
					<div class="relative flex justify-center text-sm">
						<span class="bg-white px-4 italic text-gray-400">Belum punya akun?</span>
					</div>
				</div>

				<div class="text-center">
					<a
						class="inline-block w-full rounded-xl border-2 border-gray-100 py-3 font-bold text-blue-600 transition-all hover:bg-gray-50"
						href="/register">
						DAFTAR AKUN BARU
					</a>
				</div>
			</div>

			<div class="border-t border-gray-100 bg-gray-50 p-6 text-center">
				<p class="text-xs text-gray-500">Belum punya akun? <a class="font-semibold text-blue-600 hover:underline"
						href="{{ route('register') }}">Daftar di sini</a></p>
			</div>
		</div>

	</body>

</html>
