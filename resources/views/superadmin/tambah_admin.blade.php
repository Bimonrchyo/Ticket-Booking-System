<!DOCTYPE html>
<html lang="id">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Tambah Admin - HubTrans Superadmin</title>
		<script src="https://cdn.tailwindcss.com"></script>
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
	</head>

	<body class="bg-slate-50 font-sans">

		<div class="flex">
			<aside class="fixed left-0 top-0 z-50 hidden min-h-screen w-64 bg-slate-900 text-gray-300 shadow-2xl lg:block">
				<div class="p-8">
					<div class="mb-2 flex items-center gap-3">
						<div class="flex h-8 w-8 items-center justify-center rounded-lg bg-indigo-600 shadow-lg shadow-indigo-500/20">
							<i class="fas fa-shield-alt text-xs text-white"></i>
						</div>
						<h1 class="text-xl font-black uppercase italic tracking-tighter text-white">
							Hub<span class="text-indigo-500">Owner</span>
						</h1>
					</div>
					<p class="px-1 text-[9px] font-black uppercase tracking-[0.2em] text-slate-500">Superadmin Panel</p>
				</div>

				<nav class="mt-4 space-y-8 px-4">

					<div>
						<div class="mb-3 px-4 text-[10px] font-black uppercase tracking-widest text-slate-600">Main Overview</div>
						<div class="space-y-1">
							<a
								class="group flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-bold transition hover:bg-slate-800 hover:text-white"
								href="{{ route('super.dashboard') }}">
								<i class="fas fa-chart-line w-5 text-indigo-500 transition group-hover:scale-110"></i>
								Laporan Global
							</a>
						</div>
					</div>

					<div>
						<div class="mb-3 px-4 text-[10px] font-black uppercase tracking-widest text-slate-600">Access Control</div>
						<div class="space-y-1">
							<a
								class="group flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-bold transition hover:bg-slate-800 hover:text-white"
								href="{{ route('super.daftar') }}">
								<i class="fas fa-users-cog w-5 text-indigo-500 transition group-hover:scale-110"></i>
								Daftar Admin
							</a>
							<a
								class="group flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-bold transition hover:bg-slate-800 hover:text-white"
								href="{{ route('super.tambah') }}">
								<i class="fas fa-user-plus w-5 text-indigo-500 transition group-hover:scale-110"></i>
								Tambah Admin
							</a>
						</div>
					</div>

				</nav>

				<div class="absolute bottom-0 left-0 w-full border-t border-slate-800 bg-slate-900/50 p-6 backdrop-blur-md">
					<div class="mb-6 flex items-center gap-3 px-2">
						<img class="h-10 w-10 rounded-xl border border-slate-700 shadow-sm"
							src="https://ui-avatars.com/api/?name={{ auth()->user()->nama }}&background=4f46e5&color=fff" alt="Profile">
						<div class="overflow-hidden">
							<p class="truncate text-xs font-black uppercase text-white">{{ auth()->user()->nama }}</p>
							<p class="text-[9px] font-bold uppercase tracking-tighter text-indigo-400">Superadmin</p>
						</div>
					</div>
					<form method="POST" action="{{ route('logout') }}">
						@csrf
						<button
							class="flex w-full items-center justify-center gap-2 rounded-xl bg-red-500/10 py-3 text-[10px] font-black uppercase tracking-widest text-red-500 transition duration-300 hover:bg-red-500 hover:text-white active:scale-95"
							type="submit">
							<i class="fas fa-power-off"></i> Keluar Sistem
						</button>
					</form>
				</div>
			</aside>

			<main class="ml-64 flex-1 p-10">
				<div class="mx-auto mb-10 flex max-w-4xl items-center justify-between">
					<div>
						<h2 class="text-3xl font-black uppercase tracking-tighter text-slate-800">Registrasi Admin</h2>
						<p class="mt-1 text-sm font-bold uppercase tracking-widest text-indigo-500">Menambah Otoritas Baru ke Sistem</p>
					</div>
					<div
						class="flex h-16 w-16 items-center justify-center rounded-2xl bg-indigo-600 text-white shadow-xl shadow-indigo-200">
						<i class="fas fa-user-shield fa-2x"></i>
					</div>
				</div>

				<div
					class="mx-auto max-w-4xl overflow-hidden rounded-[3rem] border border-slate-100 bg-white shadow-2xl shadow-slate-200/50">
					<div class="bg-indigo-600 p-1"></div>
					<form class="p-12" action="proses-tambah-admin.php" method="POST">
						<div class="grid grid-cols-1 gap-8 md:grid-cols-2">

							<div class="col-span-2 md:col-span-1">
								<label class="mb-3 block text-[11px] font-black uppercase tracking-widest text-slate-400">Nama Lengkap</label>
								<div class="relative">
									<span class="absolute inset-y-0 left-5 flex items-center text-slate-300">
										<i class="fas fa-user"></i>
									</span>
									<input
										class="w-full rounded-2xl border-none bg-slate-50 py-4 pl-12 pr-6 font-bold text-slate-700 outline-none transition focus:ring-2 focus:ring-indigo-500"
										name="nama" type="text" placeholder="Contoh: Rizky Ramadhan">
								</div>
							</div>

							<div class="col-span-2 md:col-span-1">
								<label class="mb-3 block text-[11px] font-black uppercase tracking-widest text-slate-400">Email Instansi</label>
								<div class="relative">
									<span class="absolute inset-y-0 left-5 flex items-center text-slate-300">
										<i class="fas fa-envelope"></i>
									</span>
									<input
										class="w-full rounded-2xl border-none bg-slate-50 py-4 pl-12 pr-6 font-bold text-slate-700 outline-none transition focus:ring-2 focus:ring-indigo-500"
										name="email" type="email" placeholder="admin@hubtrans.com">
								</div>
							</div>

							<div>
								<label class="mb-3 block text-[11px] font-black uppercase tracking-widest text-slate-400">ID Username</label>
								<input
									class="w-full rounded-2xl border-none bg-slate-50 px-6 py-4 font-bold text-slate-700 outline-none transition focus:ring-2 focus:ring-indigo-500"
									name="username" type="text" placeholder="rizky_admin">
							</div>

							<div>
								<label class="mb-3 block text-[11px] font-black uppercase tracking-widest text-slate-400">Level Akses</label>
								<div
									class="w-full rounded-2xl border border-indigo-100 bg-indigo-50 px-6 py-4 text-sm font-black uppercase text-indigo-600">
									<i class="fas fa-check-circle mr-2"></i> Regular Admin
								</div>
							</div>

							<div class="col-span-2">
								<label class="mb-3 block text-[11px] font-black uppercase tracking-widest text-slate-400">Password
									Sementara</label>
								<div class="relative" x-data="{ show: false }">
									<input
										class="w-full rounded-2xl border-none bg-slate-50 px-6 py-4 font-bold text-slate-700 outline-none transition focus:ring-2 focus:ring-indigo-500"
										name="password" :type="show ? 'text' : 'password'" placeholder="••••••••">
									<button class="absolute right-6 top-1/2 -translate-y-1/2 text-slate-300 transition hover:text-indigo-500"
										type="button" @click="show = !show">
										<i class="fas" :class="show ? 'fa-eye-slash' : 'fa-eye'"></i>
									</button>
								</div>
								<p class="mt-4 text-[10px] font-bold uppercase italic leading-relaxed text-slate-400">
									<i class="fas fa-info-circle mr-1 text-indigo-400"></i> Password ini hanya berlaku sementara. Admin baru wajib
									melakukan pembaruan keamanan pada login pertama.
								</p>
							</div>

							<div class="col-span-2 flex flex-col gap-4 pt-10 md:flex-row">
								<button
									class="flex-[2] rounded-[1.5rem] bg-indigo-600 py-5 font-black uppercase tracking-[0.2em] text-white shadow-xl shadow-indigo-100 transition hover:bg-indigo-700 active:scale-95"
									type="submit">
									Daftarkan Akun Admin
								</button>
								<button
									class="flex-1 rounded-[1.5rem] bg-slate-100 py-5 font-black uppercase tracking-widest text-slate-400 transition hover:bg-slate-200 active:scale-95"
									type="button" onclick="history.back()">
									Batalkan
								</button>
							</div>
						</div>
					</form>
				</div>

				<p class="mt-10 text-center text-[10px] font-black uppercase tracking-[0.3em] text-slate-300">
					HubTrans Management System &copy; 2026
				</p>
			</main>
		</div>

	</body>

</html>
