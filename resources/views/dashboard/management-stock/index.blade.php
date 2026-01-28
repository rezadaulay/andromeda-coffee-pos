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
                <th class="px-4 py-2 text-left text-sm font-semibold border">Aksi</th>
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
                <td class="px-4 py-2 border">
                      <a href="{{ route('management-stock.edit', request('product_id')) }}" class="text-blue-600 hover:underline text-sm mr-2">Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $products->links() }}
    </div>
</div>

<div class="mt-8">
    <h2 class="text-xl font-bold mb-3">Riwayat Perubahan Stok</h2>

    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left text-sm font-semibold border">Tanggal</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold border">Produk</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold border">Tipe</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold border">Jumlah</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold border">Catatan</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold border">User</th>
                </tr>
            </thead>
            <tbody>
                @forelse($stockLogs ?? collect() as $log)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 border text-sm">{{ $log->created_at?->format('Y-m-d H:i') }}</td>
                    <td class="px-4 py-2 border text-sm">{{ $log->product?->name ?? '—' }}</td>
                    <td class="px-4 py-2 border text-sm">{{ $log->type }}</td>
                    <td class="px-4 py-2 border text-sm">{{ $log->amount }}</td>
                    <td class="px-4 py-2 border text-sm">{{ $log->note ?? '—' }}</td>
                    <td class="px-4 py-2 border text-sm">{{ $log->user?->name ?? '—' }}</td>
                </tr>
                @empty
                <tr>
                    <td class="px-4 py-4 border text-center" colspan="6">Belum ada riwayat perubahan stok.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $stockLogs->links() ?? '' }}
        </div>
    </div>
</div>

@endsection
