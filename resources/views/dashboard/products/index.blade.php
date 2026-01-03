@extends('layouts.app')

@section('content')

<div class="bg-white rounded-lg shadow p-6">

    {{-- Header --}}
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-xl font-bold">Daftar Produk</h1>

        <a
            href="#"
            class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-lg text-sm font-semibold"
        >
            + Tambah Data
        </a>
    </div>

    {{-- Table --}}
    <div class="overflow-x-auto">
        @if (session('success'))
            <div class="mb-4 text-sm text-teal-600">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="mb-4 text-sm text-red-600">{{ session('error') }}</div>
        @endif

        @if($products->count() === 0)
            <div class="p-6 text-center text-gray-600">Produk belum ada.</div>
        @else
        <table class="min-w-full border border-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left text-sm font-semibold border">Nama</th>
                    <th class="px-4 py-2 text-right text-sm font-semibold border">Harga</th>
                    <th class="px-4 py-2 text-center text-sm font-semibold border">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach($products as $product)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 border">{{ $product->name }}</td>
                    <td class="px-4 py-2 border text-right">{{ number_format((float)$product->price, 2, ',', '.') }}</td>
                    <td class="px-4 py-2 border text-center space-x-2">
                        <a
                            href="{{ route('products.show', $product->id) }}"
                            class="text-teal-600 hover:underline text-sm"
                        >
                            Detail
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="mt-4">
            {{ $products->links() }}
        </div>
        @endif
    </div>

</div>

@endsection
