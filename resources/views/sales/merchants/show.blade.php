<x-sales-layout>
     <div class="bg-white p-6 rounded-xl shadow-md mb-8">
        <h1 class="text-2xl font-bold text-blue-900">Detail Pengajuan Merchant</h1>
        <p class="text-gray-500 mt-1">{{ $merchant->name }}</p>
    </div>

    <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
        <div class="p-6">
            <div class="p-4 rounded-lg mb-6
                @if($merchant->status == 'approved') bg-green-50 border-green-200 @endif
                @if($merchant->status == 'rejected') bg-red-50 border-red-200 @endif
                @if($merchant->status == 'pending') bg-yellow-50 border-yellow-200 @endif">
                <h3 class="font-bold text-lg 
                    @if($merchant->status == 'approved') text-green-800 @endif
                    @if($merchant->status == 'rejected') text-red-800 @endif
                    @if($merchant->status == 'pending') text-yellow-800 @endif">
                    Status: {{ ucfirst($merchant->status) }}
                </h3>
                @if($merchant->approval_notes)
                    <p class="mt-2 text-sm text-gray-600"><strong>Catatan dari Admin:</strong> {{ $merchant->approval_notes }}</p>
                @endif
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                </div>
        </div>
        <div class="p-6 bg-gray-50 text-right">
            <a href="{{ route('sales.merchants.index') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50">
                &larr; Kembali ke Riwayat
            </a>
        </div>
    </div>
</x-sales-layout>