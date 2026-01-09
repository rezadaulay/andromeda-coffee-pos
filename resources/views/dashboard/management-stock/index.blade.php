@extends('layouts.app')

@section('content')

@if(session('success'))
    <div class="mb-4 p-2 bg-green-100 text-green-800 rounded">
        {{ session('success') }}
    </div>
@endif

<div class="flex justify-between items-center mb-4">
    <h1 class="text-xl font-bold">Management Stock Produk</h1>
    @if(request('product_id'))
        <a href="{{ route('products.show', request('product_id')) }}" class="text-sm text-gray-600 hover:text-teal-600">&larr; Kembali</a>
    @endif
</div>

<div class="overflow-x-auto">
    <table class="min-w-full border border-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-2 text-left text-sm font-semibold border">Nama Produk</th>
                <th class="px-4 py-2 text-left text-sm font-semibold border">Jumlah Stok</th>
                <th class="px-4 py-2 text-center text-sm font-semibold border">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-2 border">
                    {{ $product->name }}
                </td>
                <td class="px-4 py-2 border">
                    {{ $product->quantity }}
                </td>
                <td class="px-4 py-2 border text-center">
                    <a href="{{ route('management-stock.edit', $product->id) }}" class="text-blue-600 hover:underline text-sm">
                        Edit
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $products->links() }}
    </div>
</div>

@endsection
