@extends('layouts.app')

@section('title', 'Permohonan Perusahaan | HubTrans')

@section('nav-links')
	<a class="border-b-2 border-orange-400 text-orange-400" href="{{ route('super.dashboard') }}">Dashboard</a>
	<a class="hover:text-blue-200" href="{{ route('super.company.requests') }}">Permohonan Perusahaan</a>
@endsection

@section('content')
	<div class="min-h-screen bg-gray-50 py-8">
		<div class="mx-auto max-w-6xl px-4">

			<div class="mb-6">
				<h1 class="text-2xl font-bold text-gray-800">Permohonan Perusahaan</h1>
				<p class="text-gray-600">Kelola permohonan admin perusahaan baru</p>
			</div>

			@if ($companies->isEmpty())
				<div class="rounded-lg border border-dashed border-gray-300 bg-white p-8 text-center">
					<p class="text-gray-600">Tidak ada permohonan baru.</p>
				</div>
			@else
				<div class="space-y-4">
					@foreach ($companies as $company)
						<div class="rounded-lg border bg-white p-6 shadow-sm">
							<div class="flex items-start justify-between">
								<div>
									<h2 class="text-lg font-semibold text-gray-800">{{ $company->name }}</h2>
									<p class="text-sm text-gray-500">{{ $company->address }}</p>
								</div>
								<div class="flex items-start gap-2">
									<form class="inline" action="{{ route('super.company.approve', $company->id) }}" method="POST">
										@csrf
										@method('PATCH')
										<button class="rounded bg-green-500 px-4 py-2 text-sm font-semibold text-white hover:bg-green-600"
											type="submit">Setujui</button>
									</form>
									<form class="inline" action="{{ route('super.company.reject', $company->id) }}" method="POST">
										@csrf
										@method('PATCH')
										<button class="rounded bg-red-500 px-4 py-2 text-sm font-semibold text-white hover:bg-red-600"
											type="submit">Tolak</button>
									</form>
								</div>
							</div>

							<div class="mt-4 text-xs text-gray-500">
								Admin yang mendaftar:
								<ul class="ml-4 list-disc">
									@foreach ($company->users as $user)
										<li>{{ $user->nama }} ({{ $user->email }}) - {{ $user->status }}</li>
									@endforeach
								</ul>
							</div>
						</div>
					@endforeach
				</div>
			@endif

		</div>
	</div>
@endsection
