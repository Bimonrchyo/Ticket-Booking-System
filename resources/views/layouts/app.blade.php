<!DOCTYPE html>
<html lang="id">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>@yield('title', 'Multi-Transport Hub | Pesan Tiket Mudah')</title>
		<script src="https://cdn.tailwindcss.com"></script>
		<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
		@stack('styles')
	</head>

	<body class="overflow-x-hidden bg-gray-50 font-sans text-gray-900">

		@if (trim($__env->yieldContent('nav-links')))
			<nav class="sticky top-0 z-50 bg-blue-700 p-4 shadow-md">
				<div class="container mx-auto flex flex-wrap items-center justify-between gap-4">
					<a class="flex items-center gap-2 text-xl font-bold text-white" href="#">
						<i class="fas fa-route"></i> PastiTravel
					</a>
					<div class="flex flex-wrap items-center gap-4 text-sm font-semibold text-white">
						@yield('nav-links')
						<form method="POST" action="{{ route('logout') }}">
							@csrf
							<button class="rounded-lg bg-orange-500 px-4 py-2 font-semibold transition hover:bg-orange-600"
								type="submit">Logout</button>
						</form>
					</div>
				</div>
			</nav>
		@endif

		@yield('content')

		<footer class="bg-gray-800 py-8 text-white">
			<div class="container mx-auto px-4 text-center">
				<p>&copy; 2024 PastiTravel. All rights reserved.</p>
			</div>
		</footer>

		@stack('scripts')
	</body>

</html>
