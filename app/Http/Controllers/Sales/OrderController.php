<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Menampilkan daftar riwayat pesanan milik user.
     */
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
                       ->latest()
                       ->paginate(10);

        return view('sales.orders.index', compact('orders'));
    }
    public function show(Order $order)
{
    // Pastikan user hanya bisa melihat pesanannya sendiri
    if ($order->user_id !== Auth::id()) {
        abort(403);
    }

    // Muat relasi 'items' dan 'product' di dalam items
    $order->load('items.product');

    return view('sales.orders.show', compact('order'));
}
}