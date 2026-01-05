<?php /* blade template */ ?>
@extends('layouts.app')

@section('content')
  <div class="min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md bg-white p-8 rounded-xl shadow">
            <h1 class="text-2xl font-bold text-center mb-6">Tambah Metode Pembayaran</h1>

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

            <form action="{{ route('payment-methods.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="block text-sm font-medium mb-1">Name</label>
                    <input
                        type="text"
                        name="name"
                        class="w-full p-2 rounded border-2 border-gray-300 focus:border-teal-500 focus:ring-teal-500"
                        required
                    >
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="block text-sm font-medium mb-1">Description</label>
                    <textarea
                        name="description"
                        class="w-full p-2 rounded border-2 border-gray-300 focus:border-teal-500 focus:ring-teal-500"
                        rows="4"
                        required
                    ></textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <button
                    type="submit"
                    class="w-full mt-3 bg-teal-600 hover:bg-teal-700 text-white py-2 rounded-lg font-semibold"
                >
                    Simpan
                </button>
            </form>
        </div>
    </div>
@endsection
