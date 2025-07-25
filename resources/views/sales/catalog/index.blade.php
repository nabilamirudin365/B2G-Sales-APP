<x-sales-layout>
    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif
    <div class="bg-white p-6 rounded-xl shadow-md mb-8">
        <h1 class="text-2xl font-bold text-blue-900">E-Katalog Produk</h1>
        <p class="text-gray-500 mt-1">Pilih produk yang akan dipesan untuk merchant.</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse ($products as $product)
            <div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform duration-300 hover:scale-105">
                <div class="h-48 bg-gray-200 flex items-center justify-center">
                    @if($product->image_path)
                        <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="h-full w-full object-cover">
                    @else
                        <i class="fas fa-image fa-3x text-gray-400"></i>
                    @endif
                </div>

                <div class="p-4">
                    <p class="text-xs text-gray-500 uppercase">{{ $product->category->name }}</p>
                    <h3 class="text-lg font-bold text-gray-800 truncate">{{ $product->name }}</h3>
                    <p class="text-xl font-light text-blue-800 mt-1">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    <p class="text-sm text-gray-600 mt-1">Stok: {{ $product->stock }}</p>

                    <div class="mt-4">
                        <form action="{{ route('sales.cart.add', $product->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full bg-blue-700 text-white py-2 rounded-lg hover:bg-blue-800 transition duration-300 flex items-center justify-center gap-2">
                        <i class="fas fa-cart-plus"></i>
                        <span>Tambah</span>
                        </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-16">
                <p class="text-gray-500">Belum ada produk yang tersedia di katalog.</p>
            </div>
        @endforelse
    </div>

    @if ($products->hasPages())
        <div class="mt-8">
            {{ $products->links() }}
        </div>
    @endif

</x-sales-layout>