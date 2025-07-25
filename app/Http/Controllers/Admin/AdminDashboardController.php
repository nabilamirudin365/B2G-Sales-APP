<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use App\Models\Merchant;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Data untuk kartu metrik
        $totalUsers = User::where('role', '!=', 'admin')->count();
        $totalOrders = Order::count();
        $totalMerchants = Merchant::where('status', 'approved')->count();

        // Data untuk tabel
        $recentUsers = User::where('role', '!=', 'admin')->latest()->take(5)->get();
        $recentOrders = Order::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalOrders',
            'totalMerchants',
            'recentUsers',
            'recentOrders'
        ));
    }
}
