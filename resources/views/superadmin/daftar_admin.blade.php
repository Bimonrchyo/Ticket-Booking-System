<!DOCTYPE html>
<html lang="id">

	<head>
		<meta charset="UTF-8">
		<title>Kelola Admin - PastiTravel Superadmin</title>
		<script src="https://cdn.tailwindcss.com"></script>
		<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
	</head>

	<script>
		function resetPassword(id) {
			if (confirm('Reset password admin ini ke default?')) {
				// TODO: AJAX to reset
				alert('Fitur reset password akan ditambahkan segera.');
			}
		}
	</script>

	<body class="bg-slate-50 font-sans">
		<div class="flex">
			@include('superadmin.partials.sidebar')

			<main class="ml-64 flex-1 p-8">
				@if (session('success'))
					<div class="mb-6 rounded-2xl bg-green-100 p-4 text-green-800">
						{{ session('success') }}
					</div>
				@endif
				@if (session('error'))
					<div class="mb-6 rounded-2xl bg-red-100 p-4 text-red-800">
						{{ session('error') }}
					</div>
				@endif

				<div class="mb-10 flex items-center justify-between">
					<div>
						<h2 class="text-3xl font-black tracking-tighter text-slate-800">MANAJEMEN ADMIN</h2>
						<p class="text-xs font-bold uppercase tracking-[0.3em] text-slate-400">Otoritas & Hak Akses Pengguna</p>
					</div>
					<a
						class="rounded-2xl bg-indigo-600 px-8 py-4 text-xs font-black uppercase tracking-widest text-white shadow-xl shadow-indigo-100 transition hover:bg-indigo-700"
						href="{{ route('super.tambah') }}">
						<i class="fas fa-user-plus mr-2"></i> Tambah Admin Baru
					</a>
				</div>

				<!-- Search Form -->
				<div class="mb-8">
					<form method="GET" action="{{ route('super.daftar') }}">
						<div class="relative">
							<input
								class="w-full rounded-2xl border border-slate-200 bg-white py-4 pl-12 pr-6 font-bold text-slate-700 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500"
								name="search" type="text" value="{{ $search ?? '' }}" placeholder="Cari nama atau email admin...">
							<i class="fas fa-search absolute left-5 top-1/2 -translate-y-1/2 text-slate-400"></i>
							<button class="absolute right-4 top-1/2 -translate-y-1/2 text-indigo-500" type="submit">
								<i class="fas fa-arrow-right"></i>
							</button>
						</div>
					</form>
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
							@forelse ($admins as $admin)
								<tr class="transition hover:bg-indigo-50/30">
									<td class="flex items-center gap-4 p-6">
										<div class="flex h-10 w-10 items-center justify-center rounded-full bg-indigo-100 font-black text-indigo-600">
											{{ substr($admin->nama, 0, 1) }}
										</div>
										<div>
											<p class="font-semibold text-slate-800">{{ $admin->nama }}</p>
											@if ($admin->company)
												<span class="block text-xs text-slate-500">{{ $admin->company->name }}</span>
											@endif
											<span
												class="bg-{{ $admin->status === 'active' ? 'green' : 'yellow' }}-100 text-{{ $admin->status === 'active' ? 'green' : 'yellow' }}-600 mt-1 inline-block rounded px-2 py-0.5 text-[9px] uppercase">
												{{ ucfirst($admin->status) }}
											</span>
										</div>
									</td>
									<td class="p-6 italic text-slate-500">{{ $admin->email }}</td>
									<td class="p-6 text-slate-400">{{ $admin->updated_at ? $admin->updated_at->diffForHumans() : 'Never' }}</td>
									<td class="p-6 text-center">
										<div class="flex items-center justify-center gap-2">
											@if ($admin->company)
												<a class="text-indigo-600 hover:text-indigo-800" href="#"><i
														class="fas fa-building mr-1"></i>Company</a>
											@endif
											<button class="text-slate-300 hover:text-indigo-600" title="Reset Password"
												onclick="resetPassword({{ $admin->id }})">
												<i class="fas fa-key"></i>
											</button>
											<form class="inline" action="{{ route('super.destroy', $admin->id) }}" method="POST"
												onsubmit="return confirm('Hapus admin {{ $admin->nama }}?')">
												@csrf
												@method('DELETE')
												<button class="text-slate-300 hover:text-red-500" type="submit" title="Hapus">
													<i class="fas fa-trash-alt"></i>
												</button>
											</form>
										</div>
									</td>
								</tr>
							@empty
								<tr>
									<td class="p-12 text-center text-slate-400" colspan="4">
										<i class="fas fa-users mb-4 block text-4xl"></i>
										Belum ada admin terdaftar. <a class="text-indigo-600 hover:underline"
											href="{{ route('super.tambah') }}">Tambah sekarang</a>
									</td>
								</tr>
							@endforelse
						</tbody>

						{{ $admins->appends(['search' => $search ?? ''])->links() }}
					</table>
				</div>
			</main>
		</div>
	</body>

</html>
