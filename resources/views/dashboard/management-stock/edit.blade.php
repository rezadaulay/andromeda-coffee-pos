@extends('layouts.app')

@section('content')

<div class="max-w-2xl mx-auto">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-semibold text-teal-600">Edit Stok - {{ $product->name }}</h1>
        <a href="{{ route('management-stock.index', ['product_id' => $product->id]) }}" class="text-sm text-gray-600 hover:text-teal-600">&larr; Kembali</a>
    </div>

    <div class="bg-white shadow rounded p-6">
        <form action="{{ route('management-stock.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Nama Produk</label>
                <input type="text" id="name" name="name" value="{{ $product->name }}" readonly class="w-full px-3 py-2 border border-gray-300 rounded bg-gray-100 text-gray-600" />
            </div>

            <div class="mb-4">
                <label for="type" class="block text-sm font-semibold text-gray-700 mb-2">Jenis Perubahan <span class="text-red-500">*</span></label>
                <select id="type" name="type" required class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-teal-600 @error('type') border-red-500 @enderror" onchange="updateTotalStock()">
                    <option value="">-- Pilih Jenis Perubahan --</option>
                    <option value="increment">Penambahan</option>
                    <option value="decrement">Pengurangan</option>
                </select>
                @error('type')
                    <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="amount" class="block text-sm font-semibold text-gray-700 mb-2">Jumlah Perubahan <span class="text-red-500">*</span></label>
                <input type="number" id="amount" name="amount" value="0" required min="0" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-teal-600 @error('amount') border-red-500 @enderror" oninput="updateTotalStock()" />
                @error('amount')
                    <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Total Stok</label>
                <div class="grid grid-cols-3 gap-2">
                    <div>
                        <p class="text-xs text-gray-500">Stok Saat Ini</p>
                        <input type="number" id="current_quantity" value="{{ $product->quantity }}" readonly class="w-full px-3 py-2 border border-gray-300 rounded bg-gray-100 text-gray-600" />
                    </div>
                    <div class="flex items-end justify-center">
                        <span id="operator" class="text-2xl font-bold text-gray-400">-</span>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Stok Baru</p>
                        <input type="number" id="new_quantity" value="{{ $product->quantity }}" readonly class="w-full px-3 py-2 border border-gray-300 rounded bg-gray-100 text-gray-600" />
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <label for="note" class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi (Opsional)</label>
                <textarea id="note" name="note" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-teal-600" placeholder="Tambahkan deskripsi tentang perubahan stok..."></textarea>
            </div>

            <div class="flex gap-3">
                <button type="submit" class="px-6 py-2 bg-teal-600 text-white rounded hover:bg-teal-700 font-semibold">
                    Simpan
                </button>
                <a href="{{ route('management-stock.index', ['product_id' => $product->id]) }}" class="px-6 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 font-semibold">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    function updateTotalStock() {
        const currentQuantity = parseInt(document.getElementById('current_quantity').value) || 0;
        const amount = parseInt(document.getElementById('amount').value) || 0;
        const type = document.getElementById('type').value;
        const operatorSpan = document.getElementById('operator');
        let newQuantity = currentQuantity;

        if (type === 'increment') {
            newQuantity = currentQuantity + amount;
            operatorSpan.textContent = '+';
            operatorSpan.className = 'text-2xl font-bold text-green-500';
        } else if (type === 'decrement') {
            newQuantity = currentQuantity - amount;
            operatorSpan.textContent = '-';
            operatorSpan.className = 'text-2xl font-bold text-red-500';
        } else {
            operatorSpan.textContent = '-';
            operatorSpan.className = 'text-2xl font-bold text-gray-400';
        }

        document.getElementById('new_quantity').value = newQuantity;
    }
</script>

@endsection
