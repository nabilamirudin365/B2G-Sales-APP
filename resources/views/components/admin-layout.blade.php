<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} - Admin Panel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="flex min-h-screen bg-gray-100">
        <aside class="w-64 flex-shrink-0 bg-gradient-to-b from-teal-700 to-blue-900 text-white">
            <div class="p-6 font-bold text-2xl border-b border-teal-600 text-center">
                <a href="{{ route('admin.dashboard') }}">Admin Panel</a>
            </div>
            <nav class="mt-4 space-y-1 px-4">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 py-2.5 px-4 rounded transition duration-200 hover:bg-teal-600 {{ request()->routeIs('admin.dashboard') ? 'bg-teal-600' : '' }}">
                    <span>📊</span><span>Dashboard</span>
                </a>
                <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 py-2.5 px-4 rounded transition duration-200 hover:bg-teal-600 {{ request()->routeIs('admin.users.*') ? 'bg-teal-600' : '' }}">
                    <span>👤</span><span>Mengelola Pengguna</span>
                </a>
                <a href="{{ route('admin.merchants.approvals.index') }}" class="flex items-center gap-3 py-2.5 px-4 rounded transition duration-200 hover:bg-teal-600 {{ request()->routeIs('admin.merchants.approvals.*') ? 'bg-teal-600' : '' }}">
                    <span>🤝</span><span>Persetujuan Merchant</span>
                </a>
                <a href="{{ route('admin.products.index') }}" class="flex items-center gap-3 py-2.5 px-4 rounded transition duration-200 hover:bg-teal-600 {{ request()->routeIs('admin.products.*') ? 'bg-teal-600' : '' }}">
                    <span>📦</span><span>Manajemen Produk</span>
                </a>
                <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-3 py-2.5 px-4 rounded transition duration-200 hover:bg-teal-600 {{ request()->routeIs('admin.categories.*') ? 'bg-teal-600' : '' }}">
                    <span>📚</span><span>Manajemen Kategori</span>
                </a>
                <a href="{{ route('admin.orders.index') }}" class="flex items-center gap-3 py-2.5 px-4 rounded transition duration-200 hover:bg-teal-600 {{ request()->routeIs('admin.orders.*') ? 'bg-teal-600' : '' }}">
                    <span>🛒</span><span>Manajemen Pesanan</span>
                </a>
                <a href="{{ route('admin.b2g_potentials.index') }}" class="flex items-center gap-3 py-2.5 px-4 rounded transition duration-200 hover:bg-teal-600 {{ request()->routeIs('admin.b2g_potentials.*') ? 'bg-teal-600' : '' }}">
                    <span>🛰️</span><span>Potensi SKPD</span>
                </a>
            </nav>
            <div class="absolute bottom-0 w-64 p-4">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left flex items-center gap-2 py-2 px-3 text-white rounded hover:bg-teal-600 text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" /></svg>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <main class="flex-1 p-6 lg:p-8">
            {{ $slot }}
        </main>
    </div>
</body>
</html>