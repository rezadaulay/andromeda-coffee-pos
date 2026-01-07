@extends('layouts.app')

@section('content')

  

  <div class="flex justify-between items-center mb-4">
        <h1 class="text-xl font-bold">Daftar Product</h1>

        <a
            href="{{ route('products.create') }}"
            class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-lg text-sm font-semibold"
        >
            + Tambah Data
        </a>
    </div>
    <div class="overflow-x-auto">
        @if (session('success'))
            <div class="mb-4 p-2 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="mb-4 p-2 bg-red-100 text-red-800 rounded">{{ session('error') }}</div>
        @endif
       

        <table class="min-w-full border border-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left text-sm font-semibold border">Nama</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold border">Harga</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold border">Kategori</th>
                    <th class="px-4 py-2 text-center text-sm font-semibold border">Aksi</th>
                </tr>
            </thead>

            <tbody>
                

                @foreach($products as $product)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 border">
                       {{$product->name}}
                    </td>
                    <td class="px-4 py-2 border">
                       {{$product->price}}
                    </td>
                    <td class="px-4 py-2 border">
                        {{$product->category ? $product->category->name : '-'}}
                    </td>
                    <td class="px-4 py-2 border text-center space-x-2">
                        <a
                            href="{{ route('products.detail', $product->id) }}"
                            class="text-blue-600 hover:underline text-sm mr-2"
                        >
                            Detail
                        </a>
                        <a
                            href="{{ route('products.edit', $product->id) }}"
                            class="text-yellow-600 hover:underline text-sm"
                        >
                            Edit
                        </a>
                    </td>
                </tr>
                
               
                @endforeach
            </tbody>
        </table>
          <div class="mt-4">
            {{ $products->links() }}
        </div>
        </div>
        
    </div>
@endsection