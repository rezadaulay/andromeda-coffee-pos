@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
	<div class="bg-white shadow rounded-lg overflow-hidden">
		<div class="px-6 py-4 border-b">
			<div class="flex items-center justify-between">
				<h1 class="text-2xl font-semibold text-teal-600">{{ $category->name }}</h1>
				<div class="flex items-center gap-3">
					<a href="{{ route('product-categories.index') }}" class="text-sm text-gray-600 hover:text-teal-600">&larr; Kembali</a>
					<a href="#" class="inline-flex items-center px-3 py-1.5 bg-teal-600 text-white text-sm rounded hover:bg-teal-700">Edit</a>
				</div>
			</div>
			@if(isset($category->created_at))
			<p class="text-sm text-gray-500 mt-1">Dibuat: {{ $category->created_at->format('d M Y') }}</p>
			@endif
            @if(isset($category->updated_at))
			<p class="text-sm text-gray-500 mt-1">Diperbarui: {{ $category->updated_at->format('d M Y') }}</p>
			@endif
		</div>

		<div class="p-6">
			<h2 class="text-lg font-medium text-gray-800 mb-4">Produk pada kategori ini</h2>

			@if($category->products && $category->products->count())
			<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
				@foreach($category->products as $product)
				<div class="border rounded-md p-4 flex flex-col justify-between">
					<div>
						<div class="text-lg font-semibold text-gray-800">{{ $product->name }}</div>
						<div class="text-sm text-gray-500">Harga: Rp {{ number_format($product->price, 0, ',', '.') }}</div>
					</div>
					<div class="mt-3">
						<a href="#" class="inline-block px-3 py-1 text-sm font-medium text-white bg-teal-600 rounded hover:bg-teal-700">Pilih</a>
					</div>
				</div>
				@endforeach
			</div>
			@else
			<p class="text-gray-600">Belum ada produk pada kategori ini.</p>
			@endif
		</div>
	</div>
</div>

@endsection