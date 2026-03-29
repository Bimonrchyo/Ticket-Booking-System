@extends('layouts.app')

@section('title', 'E-Ticket | PastiTravel')

@section('nav-links')
	<a class="border-b-2 border-orange-400 text-orange-400" href="{{ route('home') }}">Beranda</a>
	<a class="hover:text-blue-200" href="{{ route('history') }}">Histori</a>
@endsection

@section('content')
	<div class="min-h-screen bg-gray-50 py-8">
		<div class="mx-auto max-w-4xl px-4">

			<div class="mb-6">
				<h1 class="text-2xl font-bold text-gray-800">E-Ticket</h1>
				<p class="text-gray-600">Tiket elektronik Anda</p>
			</div>

			<!-- Content e-ticket akan ditambahkan di sini -->

		</div>
	</div>
@endsection
