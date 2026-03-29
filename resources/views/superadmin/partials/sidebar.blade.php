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
			<div class="mb-3 px-4 text-[10px] font-black uppercase tracking-widest text-slate-600">Company Requests</div>
			<div class="space-y-1">
				<a
					class="{{ request()->routeIs('super.company.requests') ? 'bg-indigo-800 text-white' : '' }} group flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-bold transition hover:bg-slate-800 hover:text-white"
					href="{{ route('super.company.requests') }}">
					<i class="fas fa-building w-5 text-indigo-500 transition group-hover:scale-110"></i>
					Permohonan Perusahaan
				</a>
			</div>
		</div>
		<div>
			<div class="mb-3 px-4 text-[10px] font-black uppercase tracking-widest text-slate-600">Access Control</div>
			<div class="space-y-1">
				<a
					class="{{ request()->routeIs('super.daftar') ? 'bg-indigo-800 text-white' : '' }} group flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-bold transition hover:bg-slate-800 hover:text-white"
					href="{{ route('super.daftar') }}">
					<i class="fas fa-users-cog w-5 text-indigo-500 transition group-hover:scale-110"></i>
					Daftar Admin
				</a>
				<a
					class="{{ request()->routeIs('super.tambah') ? 'bg-indigo-800 text-white' : '' }} group flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-bold transition hover:bg-slate-800 hover:text-white"
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
				src="https://ui-avatars.com/api/?name={{ auth()->user()->nama ?? 'Super' }}&background=4f46e5&color=fff"
				alt="Profile">
			<div class="overflow-hidden">
				<p class="truncate text-xs font-black uppercase text-white">{{ auth()->user()->nama ?? 'Superadmin' }}</p>
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
