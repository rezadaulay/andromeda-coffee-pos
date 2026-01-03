@extends('layouts.app')

@section('content')

@if(session('success'))
    <div class="mb-4 p-2 bg-green-100 text-green-800 rounded">
        {{ session('success') }}
    </div>
@endif

<div class="flex justify-between items-center mb-4">
    <h1 class="text-xl font-bold">Daftar Payment Method</h1>
    <a href="{{ route('paymentmethod.create') }}" class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-lg text-sm font-semibold">
        + Tambah Data
    </a>
</div>

<div class="overflow-x-auto">
    <table class="min-w-full border border-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-2 border text-left">Nama</th>
                <th class="px-4 py-2 border text-left">Deskripsi</th>
                <th class="px-4 py-2 border text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($methods as $method)
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-2 border">{{ $method->name }}</td>
                <td class="px-4 py-2 border">{{ $method->description }}</td>
                <td class="px-4 py-2 border text-center space-x-2">
                    <!-- Edit -->
                    <a href="{{ route('paymentmethod.edit', $method->id) }}" class="text-teal-600 hover:underline text-sm">Edit</a>

                    <!-- Hapus langsung -->
                    <a href="#"
                       onclick="
                        event.preventDefault();
                         if(confirm('Anda yakin mau menghapus ini ?')) {
                            document.getElementById('{{ $method->id }}').submit();
                         }"
                       class="text-red-600 hover:underline text-sm">
                       Hapus
                    </a>

                    
                    <form id="{{ $method->id }}" action="{{ route('paymentmethod.destroy', $method->id) }}" method="POST" style="display:none;">
                        @csrf
                        @method('DELETE')
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $methods->links() }}
    </div>
</div>

@endsection
