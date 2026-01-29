@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
	<div class="bg-white shadow rounded-lg overflow-hidden">
		<div class="px-6 py-4 border-b">
			<div class="flex items-center justify-between">
				<h1 class="text-2xl font-semibold text-teal-600">{{ $paymentMethod->name }}</h1>
				<div class="flex items-center gap-3">
					<a href="{{ route('payment-method.index') }}" class="text-sm text-gray-600 hover:text-teal-600">&larr; Kembali</a>

					<a href="#" class="inline-flex items-center px-3 py-1.5 bg-teal-600 text-white text-sm rounded hover:bg-teal-700">Edit</a>

					<form action="#" method="POST" onsubmit="event.preventDefault(); if(confirm('Yakin ingin menghapus metode pembayaran ini?')){ alert('Dummy delete — endpoint belum diimplementasikan.'); }" class="inline-block">
						<button type="submit" class="inline-flex items-center px-3 py-1.5 bg-red-600 text-white text-sm rounded hover:bg-red-700">Hapus</button>
					</form>
				</div>
			</div>

			@if(isset($paymentMethod->created_at))
			<p class="text-sm text-gray-500 mt-1">Dibuat: {{ $paymentMethod->created_at->format('d M Y H:i') }}</p>
			@endif
			@if(isset($paymentMethod->updated_at))
			<p class="text-sm text-gray-500 mt-1">Diperbarui: {{ $paymentMethod->updated_at->format('d M Y H:i') }}</p>
			@endif
		</div>

		<div class="p-6">
			<h2 class="text-lg font-medium text-gray-800 mb-4">Detail Metode Pembayaran</h2>

			<div class="grid grid-cols-1 gap-4">
				<div>
					<div class="text-sm text-gray-500">ID</div>
					<div class="text-base font-medium text-gray-800">{{ $paymentMethod->id }}</div>
				</div>

				<div>
					<div class="text-sm text-gray-500">Nama</div>
					<div class="text-base font-medium text-gray-800">{{ $paymentMethod->name }}</div>
				</div>

				<div>
					<div class="text-sm text-gray-500">Deskripsi</div>
					<div class="text-base text-gray-800">{{ $paymentMethod->description ?? '-' }}</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection