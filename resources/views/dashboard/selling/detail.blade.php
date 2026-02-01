@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-8">
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-2xl font-bold mb-4">Detail Transaksi {{ $sale->sale_number }}</h2>

        <div class="mb-4">
            <div class="text-sm text-gray-500">Status</div>
            <div class="text-lg font-semibold">{{ $sale->status }}</div>
        </div>

        <div class="mb-4">
            <div class="text-sm text-gray-500">Total</div>
            <div class="text-3xl font-black text-green-600">Rp {{ number_format($sale->total,0,',','.') }}</div>
            <div class="text-sm text-gray-500 mt-1">Total Item: {{ $sale->detailSales->sum('quantity') }}</div>
        </div>

        <div class="mb-6">
            <h3 class="text-lg font-semibold mb-2">Rincian Item</h3>
            <div class="space-y-2">
                @foreach($sale->detailSales as $d)
                    @php
                        $unitPrice = $d->quantity ? ($d->subtotal / $d->quantity) : 0;
                    @endphp
                    <div class="flex justify-between">
                        <div>
                            <div class="font-semibold">{{ $d->product->name }}</div>
                            <div class="text-xs text-gray-500">Jumlah: {{ $d->quantity }}</div>
                            <div class="text-xs text-gray-500">Harga satuan: Rp {{ number_format($d->price,0,',','.') }}</div>
                        </div>
                        <div class="font-semibold">Rp {{ number_format($d->subtotal,0,',','.') }}</div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="mb-4">
            <h3 class="text-lg font-semibold mb-2">Informasi Tambahan</h3>
            <div class="text-sm text-gray-600">Pembayaran: {{ $sale->paymentMethod?->name ?? '-' }}</div>
            <div class="text-sm text-gray-600">Kasir: {{ $sale->user?->name ?? '-' }}</div>
            <div class="text-sm text-gray-600">Tanggal: {{ $sale->created_at?->format('Y-m-d H:i') ?? '-' }}</div>
        </div>

        <div class="flex gap-3">
            <a href="{{ route('selling.history') }}" class="px-4 py-3 bg-gray-100 rounded-lg">Kembali</a>
        </div>
    </div>
</div>
@endsection
