@extends('layouts.app')

@section('content')

<div class="bg-white rounded-lg shadow p-6">

    {{-- Header --}}
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-xl font-bold">Daftar Metode Pembayaran</h1>

        <a
            href="{{ route('payment-methods.create') }}"
            class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-lg text-sm font-semibold"
        >
            + Tambah Data
        </a>
    </div>

    {{-- Action area --}}
    <div class="overflow-x-auto">
        @if (session('success'))
            <div class="mb-4 text-sm text-teal-600">{{ session('success') }}</div>
        @endif

        <div class="p-6 text-center text-gray-600">
            {{-- good luck pojan :) --}}
        </div>
    </div>

</div>

@endsection
