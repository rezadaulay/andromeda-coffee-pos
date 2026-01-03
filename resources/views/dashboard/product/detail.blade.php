@extends('layouts.app')

@section('content')

  <div class="max-w-2xl mx-auto">
    <div class="flex justify-between items-center mb-4">
      <h1 class="text-xl font-bold">Detail Produk</h1>
      <a href="{{ route('products.index') }}" class="text-sm text-teal-600 hover:underline">Kembali</a>
    </div>

    <div class="bg-white shadow rounded p-4 space-y-2">
      <div>
        <span class="font-semibold">Nama:</span>
        <span>{{ $product->name }}</span>
      </div>
      <div>
        <span class="font-semibold">Harga:</span>
        <span>{{ $product->price }}</span>
      </div>
      <div>
        <span class="font-semibold">Kategori:</span>
        <span>{{ $product->category ? $product->category->name : '-' }}</span>
      </div>
      <div>
        <span class="font-semibold">Dibuat:</span>
        <span>{{ $product->created_at }}</span>
      </div>
      <div>
        <span class="font-semibold">Diupdate:</span>
        <span>{{ $product->updated_at }}</span>
      </div>
    </div>
  </div>

@endsection
