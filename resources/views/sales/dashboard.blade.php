<x-sales-layout>
    <div class="flex justify-between items-center bg-white p-6 rounded-xl shadow-md mb-8">
        <div>
            @if(Auth::user()->role == 'tim_b2g')
                <h1 class="text-2xl font-bold text-blue-900">Dashboard B2G Partnership</h1>
            @else
                <h1 class="text-2xl font-bold text-blue-900">Dashboard Merchant Partnership</h1>
            @endif
            <p class="text-gray-500 mt-1">Selamat datang kembali, {{ Auth::user()->name }}!</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white p-6 rounded-xl shadow-md transition hover:scale-105">
            <h3 class="text-sm font-medium text-gray-500">Total Visit Anda</h3>
            <p class="text-3xl font-bold text-blue-800 mt-2">{{ $totalVisits }}</p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-md transition hover:scale-105">
            <h3 class="text-sm font-medium text-gray-500">Total Akuisisi Merchant</h3>
            <p class="text-3xl font-bold text-blue-800 mt-2">{{ $totalMerchants }}</p>
        </div>

        @if(Auth::user()->role == 'tim_b2g')
            <div class="bg-white p-6 rounded-xl shadow-md transition hover:scale-105">
                <h3 class="text-sm font-medium text-gray-500">Potensi SKPD</h3>
                <p class="text-3xl font-bold text-blue-800 mt-2">0</p> </div>
        @else
            <div class="bg-white p-6 rounded-xl shadow-md transition hover:scale-105">
                <h3 class="text-sm font-medium text-gray-500">Kemitraan Aktif</h3>
                <p class="text-3xl font-bold text-blue-800 mt-2">0</p> </div>
        @endif
    </div>

    <div class="mt-8 bg-white p-6 rounded-xl shadow-md">
    <h2 class="text-xl font-bold text-gray-800 mb-4">Aktivitas Terbaru</h2>

    <div class="space-y-4">
        @forelse ($latestActivities as $activity)
            <div class="flex items-center p-3 rounded-lg hover:bg-gray-50">
                <div class="w-12 h-12 rounded-lg flex items-center justify-center text-white mr-4
                    @if($activity instanceof \App\Models\Visit) bg-green-500 @endif
                    @if($activity instanceof \App\Models\Merchant) bg-blue-500 @endif
                    @if($activity instanceof \App\Models\B2gPotential) bg-purple-500 @endif
                ">
                    @if($activity instanceof \App\Models\Visit) <i class="fas fa-clipboard-check"></i> @endif
                    @if($activity instanceof \App\Models\Merchant) <i class="fas fa-store"></i> @endif
                    @if($activity instanceof \App\Models\B2gPotential) <i class="fas fa-file-contract"></i> @endif
                </div>

                <div class="flex-grow">
                    <p class="font-semibold text-gray-800">
                        @if($activity instanceof \App\Models\Visit) Laporan Kunjungan @endif
                        @if($activity instanceof \App\Models\Merchant) Akuisisi Merchant Baru @endif
                        @if($activity instanceof \App\Models\B2gPotential) Laporan Potensi SKPD @endif
                    </p>
                    <p class="text-sm text-gray-600">
                         @if($activity instanceof \App\Models\Visit) ke {{ $activity->partner_name }} @endif
                         @if($activity instanceof \App\Models\Merchant) {{ $activity->name }} @endif
                         @if($activity instanceof \App\Models\B2gPotential) Proyek: {{ $activity->project_name }} @endif
                    </p>
                </div>

                <div class="text-sm text-gray-400">
                    {{ $activity->created_at->diffForHumans() }}
                </div>
            </div>
        @empty
            <!-- <div class="text-center py-8">
                <p class="text-gray-500">Belum ada aktivitas untuk ditampilkan.</p>
                <a href="{{ route('sales.visits.create') }}" class="mt-4 inline-block bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700">
                    + Buat Laporan Pertama Anda
                </a>
            </div> -->
        @endforelse
    </div>
</div>

</x-sales-layout>