<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Sales Dashboard</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">
    <div class="flex min-h-screen">
        <aside class="w-72 bg-gradient-to-b from-blue-900 to-blue-700 text-white fixed h-full shadow-lg">
            <div class="p-5 text-center border-b border-white/10">
                <a href="{{ route('sales.dashboard') }}" class="text-xl font-bold">B2G Partnership</a>
            </div>

            <nav class="mt-5">
                <a href="{{ route('sales.dashboard') }}" class="flex items-center py-3 px-6 transition duration-300 hover:bg-white/10 {{ request()->routeIs('sales.dashboard') ? 'bg-white/10 border-l-4 border-blue-400 pl-5' : 'border-l-4 border-transparent' }}">
                    <i class="fas fa-tachometer-alt fa-fw mr-4"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('sales.visits.index') }}" class="flex items-center py-3 px-6 transition duration-300 hover:bg-white/10 {{ request()->routeIs('sales.visits.*') ? 'bg-white/10 border-l-4 border-blue-400 pl-5' : 'border-l-4 border-transparent' }}">
                    <i class="fas fa-clipboard-check fa-fw mr-4"></i>
                    <span>Laporan Visit</span>
                </a>
                <a href="{{ route('sales.merchants.index') }}" class="flex items-center py-3 px-6 transition duration-300 hover:bg-white/10 border-l-4 border-transparent">
                    <i class="fas fa-store fa-fw mr-4"></i>
                    <span>Akuisisi Merchant</span>
                </a>
                <a href="{{ route('sales.catalog.index') }}" class="flex items-center py-3 px-6 transition duration-300 hover:bg-white/10 {{ request()->routeIs('sales.catalog.*') ? 'bg-white/10 border-l-4 border-blue-400 pl-5' : 'border-l-4 border-transparent' }}">
                    <i class="fas fa-book-open fa-fw mr-4"></i>
                    <span>E-Katalog</span>
                </a>
                <a href="{{ route('sales.cart.index') }}" class="flex items-center justify-between py-3 px-6 transition duration-300 hover:bg-white/10 {{ request()->routeIs('sales.cart.*') ? 'bg-white/10 border-l-4 border-blue-400 pl-5' : 'border-l-4 border-transparent' }}">
                    <div class="flex items-center">
                    <i class="fas fa-shopping-cart fa-fw mr-4"></i>
                    <span>Keranjang</span>
                    </div>
    @if(session('cart'))
        <span class="bg-blue-500 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">
            {{ count(session('cart')) }}
        </span>
    @endif
</a>
<a href="{{ route('sales.orders.index') }}" class="flex items-center py-3 px-6 transition duration-300 hover:bg-white/10 {{ request()->routeIs('sales.orders.*') ? 'bg-white/10 border-l-4 border-blue-400 pl-5' : 'border-l-4 border-transparent' }}">
    <i class="fas fa-history fa-fw mr-4"></i>
    <span>Riwayat Pesanan</span>
</a>

                <a href="#" class="flex items-center py-3 px-6 transition duration-300 hover:bg-white/10 border-l-4 border-transparent">
                    <i class="fas fa-file-contract fa-fw mr-4"></i>
                    <span>Potensi SKPD</span>
                </a>
            </nav>

            <div class="absolute bottom-0 w-full border-t border-white/10 p-4">
                <div class="flex items-center">
                    <div class="w-10 h-10 rounded-full bg-white/20 flex-shrink-0"></div>
                    <div class="ml-3">
                        <p class="font-bold text-sm">{{ Auth::user()->name }}</p>
                        <p class="text-xs opacity-80 capitalize">{{ str_replace('_', ' ', Auth::user()->role) }}</p>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="ml-auto">
                        @csrf
                        <button type="submit" title="Logout" class="text-white/80 hover:text-white">
                            <i class="fas fa-sign-out-alt fa-lg"></i>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <main class="flex-1 ml-72">
            <div class="p-8">
                {{ $slot }}
            </div>
        </main>
    </div>
</body>
</html>