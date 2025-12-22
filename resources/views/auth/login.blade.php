@extends('layouts.app')

@section('content')
  <div class="min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md bg-white p-8 rounded-xl shadow">
            <h1 class="text-2xl font-bold text-center mb-6">Login</h1>

            @if ($errors->any())
                <div class="mb-4 text-center text-sm text-red-600">
                    Lengkapi semua kolom!
                </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST">
                @csrf

                <div>
                    <label class="block text-sm font-medium mb-1">Email</label>
                    <input
                        type="email"
                        name="email"
                        class="w-full p-2 rounded border-2 border-gray-300 focus:border-teal-500 focus:ring-teal-500"
                        required
                    >
                    @error('email')
                    {{-- jika ada errors dengan object `email` maka masuk ke kondisi --}}
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        {{-- jika ingin print error maka gunakan $message yang akan otomatis mengambil pesan error object `email` --}}
                    @enderror
                </div>
                <div class="mt-2">
                    <label class="block text-sm font-medium mb-1">Password</label>
                    <input
                        type="password"
                        name="password"
                        class="w-full p-2 rounded border-2 border-gray-300 focus:border-teal-500 focus:ring-teal-500"
                        required
                    >

                    @error('password')
                    {{-- jika ada errors dengan object `password` maka masuk ke kondisi --}}
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        {{-- jika ingin print error maka gunakan $message yang akan otomatis mengambil pesan error object `password` --}}
                    @enderror
                </div>

                <button
                    type="submit"
                    class="w-full mt-3 bg-teal-600 hover:bg-teal-700 text-white py-2 rounded-lg font-semibold"
                >
                    Masuk
                </button>
            </form>
        </div>
    </div>
@endsection