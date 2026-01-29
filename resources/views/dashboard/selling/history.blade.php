@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8 antialiased">
    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-end mb-8 gap-4">
        <div>
            <h1 class="text-4xl font-black text-gray-900 tracking-tight">History Penjualan</h1>
            <p class="text-gray-500 mt-1">Lihat semua transaksi penjualan Anda.</p>
        </div>
        <div class="group-content flex items-center gap-4">
            <a href="{{ route('selling.index') }}" class="flex items-center justify-center bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-2xl shadow-sm transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                    <path d="M12 5v14M5 12h14"></path>
                </svg>
                Kasir Baru
            </a>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 mb-8">
        <form method="GET" action="{{ route('selling.history') }}" class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Filter Status -->
            <div class="flex flex-col">
                <label for="status" class="text-sm font-semibold text-gray-700 mb-2">Status Penjualan</label>
                <select name="status" id="status" class="px-4 py-2 border border-gray-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                    <option value="">-- Semua Status --</option>
                    @foreach($statuses as $status)
                        <option value="{{ $status->value }}" {{ request('status') === $status->value ? 'selected' : '' }}>
                            {{ ucfirst($status->value) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Filter ID/Nomor Penjualan -->
            <div class="flex flex-col">
                <label for="sale_search" class="text-sm font-semibold text-gray-700 mb-2">Cari ID/Nomor Penjualan</label>
                <input 
                    type="text" 
                    name="sale_search" 
                    id="sale_search" 
                    placeholder="Cari ID atau Nomor Transaksi..." 
                    value="{{ request('sale_search') }}"
                    class="px-4 py-2 border border-gray-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                />
            </div>

            <!-- Button Actions -->
            <div class="flex flex-col justify-end gap-2">
                <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white px-6 py-2 rounded-2xl font-semibold transition-colors duration-200 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.35-4.35"></path>
                    </svg>
                    Filter
                </button>
                <a href="{{ route('selling.history') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-6 py-2 rounded-2xl font-semibold transition-colors duration-200 text-center">
                    Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Sales Table -->
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        @if($sales->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-200 bg-gray-50">
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">No. Transaksi</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Tanggal</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Total</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Metode Pembayaran</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Status</th>
                            <th class="px-6 py-4 text-center text-sm font-semibold text-gray-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sales as $sale)
                            <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-6 py-4">
                                    <div class="flex flex-col">
                                        <span class="font-semibold text-gray-900">{{ $sale->sale_number }}</span>
                                        <span class="text-xs text-gray-500">ID: #{{ $sale->id }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-col">
                                        <span class="text-gray-900">{{ $sale->created_at->format('d M Y') }}</span>
                                        <span class="text-xs text-gray-500">{{ $sale->created_at->format('H:i') }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="font-semibold text-teal-600">Rp{{ number_format($sale->total, 0, ',', '.') }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-gray-900">
                                        {{ $sale->paymentMethod?->name ?? 'Tidak ada' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $statusColor = match($sale->status->value) {
                                            'pending' => 'bg-yellow-50 text-yellow-700',
                                            'completed' => 'bg-green-50 text-green-700',
                                            'canceled' => 'bg-red-50 text-red-700',
                                            default => 'bg-gray-50 text-gray-700'
                                        };
                                    @endphp
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $statusColor }}">
                                        {{ ucfirst($sale->status->value) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-2">
                                        @if($sale->status->value !== 'completed')
                                            <a href="{{ route('selling.show', $sale->id) }}" class="inline-flex items-center justify-center bg-teal-100 hover:bg-teal-200 text-teal-700 w-10 h-10 rounded-full transition-colors duration-200" title="Lihat Detail">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="14" x="2" y="5" rx="2"></rect><line x1="2" x2="22" y1="10" y2="10"></line></svg>
                                            </a>
                                        @else
                                            <span class="text-xs text-gray-400 font-semibold">Selesai</span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                {{ $sales->links() }}
            </div>
        @else
            <div class="px-6 py-16 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="mx-auto text-gray-300 mb-4">
                    <path d="M6 9l6 6 6-6"></path>
                    <path d="M3 3h18a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z"></path>
                </svg>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Tidak ada transaksi ditemukan</h3>
                <p class="text-gray-500 mb-6">Coba ubah filter atau mulai transaksi baru.</p>
                <a href="{{ route('selling.index') }}" class="inline-flex items-center bg-teal-600 hover:bg-teal-700 text-white px-6 py-2 rounded-2xl font-semibold transition-colors duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                        <path d="M12 5v14M5 12h14"></path>
                    </svg>
                    Kasir Baru
                </a>
            </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
    // Auto-submit form when status changes
    document.getElementById('status').addEventListener('change', function() {
        this.form.submit();
    });
</script>
@endpush
@endsection
