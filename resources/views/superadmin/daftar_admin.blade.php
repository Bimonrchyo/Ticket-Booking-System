<!DOCTYPE html>
<html lang="id">

	<head>
		<meta charset="UTF-8">
		<title>Kelola Admin - HubTrans Superadmin</title>
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

			<main class="ml-64 flex-1 p-8">
				<div class="mb-10 flex items-center justify-between">
					<div>
						<h2 class="text-3xl font-black tracking-tighter text-slate-800">MANAJEMEN ADMIN</h2>
						<p class="text-xs font-bold uppercase tracking-[0.3em] text-slate-400">Otoritas & Hak Akses Pengguna</p>
					</div>
					<a
						class="rounded-2xl bg-indigo-600 px-8 py-4 text-xs font-black uppercase tracking-widest text-white shadow-xl shadow-indigo-100 transition hover:bg-indigo-700"
						href="create.php">
						<i class="fas fa-user-plus mr-2"></i> Tambah Admin Baru
					</a>
				</div>

				<div class="overflow-hidden rounded-[2.5rem] border border-slate-100 bg-white shadow-sm">
					<table class="w-full text-left">
						<thead class="bg-slate-900 text-white">
							<tr>
								<th class="p-6 text-[10px] font-black uppercase tracking-widest opacity-60">Nama Admin</th>
								<th class="p-6 text-[10px] font-black uppercase tracking-widest opacity-60">Username/Email</th>
								<th class="p-6 text-[10px] font-black uppercase tracking-widest opacity-60">Terakhir Login</th>
								<th class="p-6 text-center text-[10px] font-black uppercase tracking-widest opacity-60">Aksi</th>
							</tr>
						</thead>
						<tbody class="divide-y divide-slate-50 text-sm font-bold">
							<tr class="transition hover:bg-indigo-50/30">
								<td class="flex items-center gap-4 p-6">
									<div class="flex h-10 w-10 items-center justify-center rounded-full bg-indigo-100 font-black text-indigo-600">R
									</div>
									<div>
										<p class="text-slate-800">Rizky Ramadhan</p>
										<span class="rounded bg-green-100 px-2 py-0.5 text-[9px] uppercase text-green-600">Active</span>
									</div>
								</td>
								<td class="p-6 italic text-slate-500">rizky_admin@hubtrans.com</td>
								<td class="p-6 text-slate-400">2 Jam yang lalu</td>
								<td class="p-6 text-center">
									<button class="mr-3 text-slate-300 hover:text-indigo-600"><i class="fas fa-key"></i></button>
									<button class="text-slate-300 hover:text-red-500"><i class="fas fa-trash-alt"></i></button>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</main>
		</div>
	</body>

</html>
