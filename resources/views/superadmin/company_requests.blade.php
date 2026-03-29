<!DOCTYPE html>
<html lang="id">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Permohonan Perusahaan - PastiTravel Superadmin</title>
		<script src="https://cdn.tailwindcss.com"></script>
		<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
	</head>

	<body class="bg-slate-50 font-sans">
		<div class="flex">
			@include('superadmin.partials.sidebar')

			<main class="ml-64 flex-1 p-8">
				@if (session('success'))
					<div class="mb-6 rounded-2xl bg-green-100 p-4 text-green-800">
						{{ session('success') }}
					</div>
				@endif

				<div class="mb-8">
					<div class="flex items-center gap-3">
						<h1 class="text-3xl font-black tracking-tighter text-slate-800">Permohonan Perusahaan</h1>
						<span class="rounded-full bg-yellow-100 px-3 py-1 text-xs font-bold uppercase text-yellow-800">Pending
							({{ $companies->count() }})</span>
					</div>
					<p class="mt-1 text-sm font-bold uppercase tracking-wider text-slate-500">Kelola permohonan admin perusahaan baru
					</p>
				</div>

				<div class="space-y-4">
					@if ($companies->isEmpty())
						<div class="rounded-[2.5rem] border border-dashed border-slate-200 bg-slate-50 p-12 text-center shadow-sm">
							<i class="fas fa-clipboard-list-check mb-4 block text-4xl text-slate-400"></i>
							<h3 class="mb-2 text-lg font-bold text-slate-600">Tidak ada permohonan baru</h3>
							<p class="text-slate-500">Semua perusahaan sudah diproses.</p>
						</div>
					@else
						@foreach ($companies as $company)
							<div
								class="group overflow-hidden rounded-[2rem] border border-slate-100 bg-white shadow-sm transition hover:shadow-md hover:shadow-indigo-100">
								<div class="p-8">
									<div class="flex items-start justify-between gap-6">
										<div class="flex flex-1 items-start gap-4">
											<div
												class="flex h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-br from-yellow-400 to-orange-500 shadow-lg">
												<i class="fas fa-building text-2xl text-white"></i>
											</div>
											<div>
												<h3 class="mb-1 text-xl font-black text-slate-800">{{ $company->name }}</h3>
												<p class="mb-1 text-slate-600">{{ $company->address }}</p>
												<span
													class="inline-flex items-center gap-1 rounded-full bg-yellow-100 px-3 py-1 text-xs font-bold uppercase text-yellow-800">
													<i class="fas fa-clock"></i> Pending
												</span>
											</div>
										</div>
										<div class="flex items-center gap-3">
											<form class="inline" action="{{ route('super.company.approve', $company) }}" method="POST"
												onsubmit="return confirm('Setujui perusahaan {{ $company->name }}? Admin akan aktif.')" x-data>
												@csrf
												@method('PATCH')
												<button
													class="rounded-xl bg-green-600 px-6 py-3 text-sm font-bold uppercase tracking-wide text-white shadow-lg transition hover:bg-green-700 active:scale-95"
													type="submit">
													<i class="fas fa-check mr-1"></i> Setujui
												</button>
											</form>
											<form class="inline" action="{{ route('super.company.reject', $company) }}" method="POST"
												onsubmit="return confirm('Tolak {{ $company->name }}?')" x-data>
												@csrf
												@method('PATCH')
												<button
													class="rounded-xl bg-red-600 px-6 py-3 text-sm font-bold uppercase tracking-wide text-white shadow-lg transition hover:bg-red-700 active:scale-95"
													type="submit">
													<i class="fas fa-times mr-1"></i> Tolak
												</button>
											</form>
										</div>
									</div>

									<div class="mt-6 border-t border-slate-100 pt-6">
										<h4 class="mb-3 text-sm font-black uppercase tracking-wider text-slate-600">Admin Pendaftar</h4>
										<div class="space-y-2">
											@forelse($company->users as $user)
												<div class="flex items-center gap-3 rounded-xl bg-slate-50 p-3 transition hover:bg-slate-100">
													<div
														class="flex h-10 w-10 items-center justify-center rounded-full bg-indigo-100 text-sm font-bold text-indigo-600">
														{{ substr($user->nama, 0, 1) }}
													</div>
													<div class="flex-1">
														<p class="font-semibold text-slate-800">{{ $user->nama }}</p>
														<p class="text-sm text-slate-500">{{ $user->email }}</p>
													</div>
													<span class="rounded-full bg-yellow-100 px-2 py-1 text-xs font-bold uppercase text-yellow-800">
														Pending
													</span>
												</div>
											@empty
												<p class="text-sm italic text-slate-500">Tidak ada admin terdaftar.</p>
											@endforelse
										</div>
									</div>
								</div>
							</div>
						@endforeach
				</div>
				@endif
		</div>

		<div class="mt-12 text-center opacity-50">
			<p class="text-sm text-slate-500">PastiTravel Superadmin Panel</p>
		</div>
		</main>
		</div>
	</body>

</html>
