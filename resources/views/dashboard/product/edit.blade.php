@extends('layouts.app')

@section('content')
  <div class="min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md bg-white p-8 rounded-xl shadow">
            <h1 class="text-2xl font-bold text-center mb-6">Edit Produk</h1>

            @if (session('success'))
                <div class="mb-4 text-center text-sm text-teal-600">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 text-center text-sm text-red-600">
                    Lengkapi semua kolom!
                </div>
            @endif

            <form action="{{ route('product.update', $product->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-medium mb-1">Name</label>
                    <input
                        type="text"
                        name="name"
                        value="{{ old('name', $product->name) }}"
                        class="w-full p-2 rounded border-2 border-gray-300 focus:border-teal-500 focus:ring-teal-500"
                        required
                    >
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <br>
                <div>
                    <label class="block text-sm font-medium mb-1">Price</label>
                    <input
                        type="number"
                        name="price"
                        value="{{ old('price', $product->price) }}"
                        class="w-full p-2 rounded border-2 border-gray-300 focus:border-teal-500 focus:ring-teal-500"
                        required
                        step="0.01"
                    >
                    @error('price')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <br>
                <div>
                    <label class="block text-sm font-medium mb-1">Product Category</label>
                    <select name="product_category_id" class="w-full p-2 rounded border-2 border-gray-300 focus:border-teal-500 focus:ring-teal-500" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{old('product_category_id', $product->product_category_id) == $category->id ? 'selected' : ''}}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('product_category_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <button
                    type="submit"
                    class="w-full mt-3 bg-teal-600 hover:bg-teal-700 text-white py-2 rounded-lg font-semibold"
                >
                    Simpan Perubahan
                </button>
            </form>
        </div>
    </div>
@endsection
