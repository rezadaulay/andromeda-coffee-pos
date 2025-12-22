@extends('layouts.app')

@section('content')

<div class="bg-white rounded-lg shadow p-6">

    {{-- Header --}}
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-xl font-bold">Daftar Kategori</h1>

        <a
            href="{{ route('product-categories.create') }}"
            class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-lg text-sm font-semibold"
        >
            + Tambah Data
        </a>
    </div>

    {{-- Table --}}
    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left text-sm font-semibold border">Nama</th>
                    <th class="px-4 py-2 text-center text-sm font-semibold border">Aksi</th>
                </tr>
            </thead>

            <tbody>
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 border">
                        Minuman
                    </td>
                    <td class="px-4 py-2 border text-center space-x-2">
                        <a
                            href="#"
                            class="text-teal-600 hover:underline text-sm"
                        >
                            Edit
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</div>

@endsection