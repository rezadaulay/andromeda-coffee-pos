<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Andromeda Coffee</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="min-h-screen bg-gray-100">
    {{-- Hanya munculkan navbar ketika user sudah login --}}
    @auth
    <nav class="bg-white shadow-md fixed w-full z-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">

                <!-- Logo -->
                <div class="flex items-center">
                    <span class="text-xl font-bold text-teal-600">Andromeda</span>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex space-x-6">
                    <a href="#" class="text-gray-700 hover:text-indigo-600 font-medium">Penjualan</a>
                    <a href="#" class="text-gray-700 hover:text-indigo-600 font-medium">Produk</a>
                    <a href="#" class="text-gray-700 hover:text-indigo-600 font-medium">Kategori</a>
                    <a href="#" class="text-gray-700 hover:text-indigo-600 font-medium">User</a>
                    <a href="{{ route('dashboard.logout') }}" class="text-gray-700 hover:text-indigo-600 font-medium">Logout</a>
                </div>


            </div>
        </div>
    </nav>
    @endauth
    <main>
        @yield('content')
    </main>
</body>
</html>