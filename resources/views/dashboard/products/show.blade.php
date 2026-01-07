@extends('layouts.app')

@section('content')

  <div class="max-w-2xl mx-auto">
    <div class="flex items-center justify-between">
      <h1 class="text-2xl font-semibold text-teal-600">{{ $product->name }}</h1>
      <div class="flex items-center gap-3">
        <a href="{{ route('products.index') }}" class="text-sm text-gray-600 hover:text-teal-600">&larr; Kembali</a>
        <a href="{{ route('products.edit', $product->id) }}" class="inline-flex items-center px-3 py-1.5 bg-teal-600 text-white text-sm rounded hover:bg-teal-700">Edit</a>

        <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kategori ini?');">
          @csrf
          @method('DELETE')
          <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-red-600 text-white text-sm rounded hover:bg-red-700">Hapus</button>
        </form>
      </div>
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
