@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-8">
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-2xl font-bold mb-4">Pembayaran untuk {{ $sale->sale_number }}</h2>

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
                            <div>{{ $d->product->name }} × {{ $d->quantity }}</div>
                            <div class="text-xs text-gray-500">Harga satuan: Rp {{ number_format($unitPrice,0,',','.') }}</div>
                        </div>
                        <div class="font-semibold">Rp {{ number_format($d->subtotal,0,',','.') }}</div>
                    </div>
                @endforeach
            </div>
        </div>

        <form method="POST" action="{{ route('selling.update', $sale->id) }}">
            @csrf
            @method('PATCH')
            <h4 class="text-sm font-semibold mb-2">Pilih Metode Pembayaran</h4>
            <div class="space-y-2 mb-4">
                @foreach($paymentMethods as $pm)
                    <label class="flex items-center gap-3 p-3 rounded-lg border cursor-pointer">
                        <input type="radio" name="payment_method" value="{{ $pm->id }}" class="form-radio">
                        <div>
                            <div class="font-semibold">{{ $pm->name }}</div>
                            <div class="text-xs text-gray-500">{{ $pm->description }}</div>
                        </div>
                    </label>
                @endforeach
            </div>

            <div class="flex gap-3">
                <button type="submit" class="ml-auto px-5 py-3 bg-teal-600 hover:bg-teal-500 text-white font-bold rounded-lg">Bayar</button>
                <a href="{{ route('selling.index') }}" class="px-4 py-3 bg-gray-100 rounded-lg">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection
