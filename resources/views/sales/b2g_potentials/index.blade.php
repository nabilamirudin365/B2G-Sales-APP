<x-sales-layout>
    <div class="flex justify-between items-center bg-white p-6 rounded-xl shadow-md mb-8">
        <div>
            <h1 class="text-2xl font-bold text-blue-900">Papan Potensi Pengadaan (SKPD)</h1>
            <p class="text-gray-500 mt-1">Lacak progres setiap potensi proyek di sini.</p>
        </div>
        <a href="{{ route('sales.b2g_potentials.create') }}" class="bg-blue-700 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded-lg shadow-md">
            + Tambah Potensi Baru
        </a>
    </div>

    <div class="flex gap-6 overflow-x-auto pb-4">
        @foreach ($statuses as $status)
            @php
                // Logika untuk judul kolom dan warna
                $title = ucwords(str_replace('-', ' ', $status));
                $bgColor = 'bg-gray-100';
                if ($status === 'menang') $bgColor = 'bg-green-100';
                if ($status === 'kalah') $bgColor = 'bg-red-100';
            @endphp

            <div class="w-72 flex-shrink-0 {{ $bgColor }} rounded-lg">
                <div class="p-4 border-b">
                    <h3 class="font-bold text-gray-800">{{ $title }}</h3>
                </div>
                <div class="p-4 space-y-4">
                    @forelse ($potentialsByStatus[$status] ?? [] as $potential)
                        <a href="{{ route('sales.b2g_potentials.show', $potential) }}" class="block bg-white p-4 rounded-md shadow-sm hover:shadow-lg transition-shadow">
                            <h4 class="font-bold text-gray-900">{{ $potential->project_name }}</h4>
                            <p class="text-sm text-gray-600 mt-1">{{ $potential->skpd_name }}</p>
                            <p class="text-sm font-semibold text-blue-800 mt-2">Rp {{ number_format($potential->estimated_value, 0, ',', '.') }}</p>
                        </a>
                    @empty
                        <p class="text-xs text-gray-500 p-4 text-center">Belum ada potensi.</p>
                    @endforelse
                </div>
            </div>
        @endforeach
    </div>
</x-sales-layout>