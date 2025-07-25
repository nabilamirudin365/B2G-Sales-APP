<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Visit;
use App\Models\Merchant;
use App\Models\B2gPotential; // <-- Import model baru

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // 1. Ambil data yang bersifat umum untuk semua role sales
        $totalVisits = Visit::where('user_id', $user->id)->count();
        $totalMerchants = Merchant::where('user_id', $user->id)->count();

        // 2. Siapkan variabel untuk data spesifik role
        $roleSpecificData = [];
        $latestActivities = collect(); // Inisialisasi sebagai collection kosong

        // 3. Ambil data khusus berdasarkan role
        if ($user->role == 'tim_b2g') {
            $roleSpecificData['totalPotensi'] = B2gPotential::where('user_id', $user->id)->count();
            // Ambil 5 aktivitas terakhir dari B2G
            $latestActivities = B2gPotential::where('user_id', $user->id)->latest()->take(5)->get();
        
        } elseif ($user->role == 'tim_merchant') {
            // Role merchant mungkin punya data spesifik lain nanti, contoh:
            $roleSpecificData['kemitraanAktif'] = Merchant::where('user_id', $user->id)->where('status', 'active')->count();
             // Ambil 5 akuisisi merchant terakhir
            $latestActivities = Merchant::where('user_id', $user->id)->latest()->take(5)->get();
        }
        
        // 4. Gabungkan semua data menjadi satu array untuk dikirim ke view
        $data = array_merge([
            'totalVisits' => $totalVisits,
            'totalMerchants' => $totalMerchants,
            'latestActivities' => $latestActivities,
        ], $roleSpecificData);

        return view('sales.dashboard', $data);
    }
}