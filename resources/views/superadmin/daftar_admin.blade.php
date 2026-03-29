@extends('layouts.app')

@section('title', 'Daftar Admin | HubTrans')

@section('nav-links')
	<a class="border-b-2 border-orange-400 text-orange-400" href="{{ route('super.dashboard') }}">Dashboard</a>
	<a class="hover:text-blue-200" href="{{ route('super.daftar') }}">Daftar Admin</a>
@endsection

@section('content')
	<div class="min-h-screen bg-gray-50 py-8">
		<div class="mx-auto max-w-6xl px-4">

			<div class="mb-6">
				<h1 class="text-2xl font-bold text-gray-800">Daftar Admin</h1>
				<p class="text-gray-600">Kelola daftar admin sistem</p>
			</div>

			<div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
				<table class="min-w-full divide-y divide-gray-200">
					<thead class="bg-gray-50">
						<tr>
							<th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-500">Nama</th>
							<th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-500">Email</th>
							<th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-500">Perusahaan</th>
							<th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-500">Status</th>
						</tr>
					</thead>
					<tbody class="divide-y divide-gray-200 bg-white">
						@forelse($admins as $admin)
							<tr>
								<td class="whitespace-nowrap px-6 py-4">{{ $admin->nama }}</td>
								<td class="whitespace-nowrap px-6 py-4">{{ $admin->email }}</td>
								<td class="whitespace-nowrap px-6 py-4">{{ $admin->company->name ?? '-' }}</td>
								<td class="whitespace-nowrap px-6 py-4">{{ ucfirst($admin->status) }}</td>
							</tr>
						@empty
							<tr>
								<td class="px-6 py-4" colspan="4">Tidak ada admin terdaftar</td>
							</tr>
						@endforelse
					</tbody>
				</table>
			</div>

		</div>
	</div>
@endsection
