<?php

namespace App\Http\Controllers\Warehouse;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
{
    // 1. Ambil semua sales (HANYA TIM MERCHANT) untuk filter dropdown
    $salesTeam = User::where('role', 'tim_merchant')->orderBy('name')->get(); // <-- PERUBAHAN DI SINI

    // 2. Ambil input filter dari URL
    $selectedUserId = $request->input('user_id');
    $selectedMonth = $request->input('month', Carbon::now()->month);
    $selectedYear = $request->input('year', Carbon::now()->year);

    // 3. Bangun query pesanan secara dinamis
    $query = Order::with('user', 'merchant')->latest();

    // Terapkan filter bulan dan tahun (selalu aktif)
    $query->whereYear('created_at', $selectedYear)
            ->whereMonth('created_at', $selectedMonth);

    // Terapkan filter sales jika dipilih
    if ($selectedUserId) {
        $query->where('user_id', $selectedUserId);
    }

    // 4. Eksekusi query dengan paginasi
    $orders = $query->paginate(15)->withQueryString();

    return view('warehouse.orders.index', compact(
        'orders',
        'salesTeam',
        'selectedUserId',
        'selectedMonth',
        'selectedYear'
    ));
}

    public function show(Order $order)
    {
        $order->load('items.product', 'user', 'merchant');
        return view('warehouse.orders.show', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,completed,cancelled',
        ]);

        $order->status = $request->status;
        $order->save();

        return redirect()->route('warehouse.orders.show', $order)->with('success', 'Status pesanan berhasil diperbarui.');
    }


}