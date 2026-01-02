@extends('layouts.app')

@section('content')

<div class="bg-white rounded-lg shadow p-6">

    <div class="flex justify-between items-center mb-4">
        <h1 class="text-xl font-bold">Detail Produk</h1>

        <a href="{{ route('products.index') }}" class="text-sm text-teal-600 hover:underline">Kembali</a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="p-4 border rounded">
            <div class="text-sm text-gray-500">Nama</div>
            <div class="text-lg font-semibold">{{ $product->name }}</div>
        </div>

        <div class="p-4 border rounded">
            <div class="text-sm text-gray-500">Kategori</div>
            <div class="text-lg font-semibold">{{ $product->category?->name ?? '-' }}</div>
        </div>

        <div class="p-4 border rounded">
            <div class="text-sm text-gray-500">Harga</div>
            <div class="text-lg font-semibold">{{ number_format((float)$product->price, 2, ',', '.') }}</div>
        </div>

        <div class="p-4 border rounded">
            <div class="text-sm text-gray-500">Dibuat</div>
            <div class="text-sm">{{ $product->created_at }}</div>
        </div>
    </div>

</div>

@endsection
