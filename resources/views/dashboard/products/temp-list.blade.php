@extends('layouts.app')

@section('content')

<div class="bg-white rounded-lg shadow p-6">

    <div class="flex justify-between items-center mb-4">
        <h1 class="text-xl font-bold">Daftar Produk (Debug)</h1>
    </div>

    @if(session('success'))
        <div class="mb-4 text-green-700">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="mb-4 text-red-700">{{ session('error') }}</div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left text-sm font-semibold border">ID</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold border">Nama</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold border">Kategori</th>
                    <th class="px-4 py-2 text-right text-sm font-semibold border">Harga</th>
                    <th class="px-4 py-2 text-center text-sm font-semibold border">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach($products as $product)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 border">{{ $product->id }}</td>
                    <td class="px-4 py-2 border">{{ $product->name }}</td>
                    <td class="px-4 py-2 border">{{ optional($product->category)->name }}</td>
                    <td class="px-4 py-2 border text-right">{{ number_format($product->price, 0, ',', '.') }}</td>
                    <td class="px-4 py-2 border text-center">
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline text-sm bg-transparent border-0 p-0">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

@endsection
