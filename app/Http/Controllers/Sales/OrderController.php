<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Merchant;

class OrderController extends Controller
{
    /**
     * Menampilkan daftar riwayat pesanan milik user.
     */
    public function index()
    {
        $orders = Order::with('merchant') // <-- TAMBAHKAN INI
                   ->where('user_id', Auth::id())
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

public function startOrder(Merchant $merchant)
{
    // Pastikan merchant ini milik sales yang login
    if ($merchant->user_id !== Auth::id()) {
        abort(403);
    }

    // 1. Kosongkan keranjang yang mungkin ada sebelumnya
    session()->forget('cart');

    // 2. Simpan informasi merchant yang akan dipesankan ke dalam sesi
    session()->put('order_for_merchant', [
        'id' => $merchant->id,
        'name' => $merchant->name,
    ]);

    // 3. Arahkan ke E-Katalog untuk mulai memilih produk
    return redirect()->route('sales.catalog.index');
}

}