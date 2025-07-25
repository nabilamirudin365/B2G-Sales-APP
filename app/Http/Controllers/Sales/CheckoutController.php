<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    /**
     * Memproses keranjang belanja dan membuat pesanan baru.
     */
    public function store(Request $request)
    {
        // 1. Ambil keranjang dari sesi
        $cart = session()->get('cart');

        // 2. Validasi: pastikan keranjang tidak kosong
        if (!$cart) {
            return redirect()->route('sales.cart.index')->with('error', 'Keranjang Anda kosong.');
        }

        // Mulai transaksi database untuk memastikan semua proses berhasil atau tidak sama sekali
        DB::beginTransaction();

        try {
            // 3. Hitung total harga
            $totalAmount = 0;
            foreach ($cart as $details) {
                $totalAmount += $details['price'] * $details['quantity'];
            }

            // 4. Buat pesanan baru di tabel 'orders'
            $order = Order::create([
                'user_id' => Auth::id(),
                'order_number' => 'ORD-' . strtoupper(Str::random(8)),
                'total_amount' => $totalAmount,
                'status' => 'pending', // Status awal pesanan
            ]);

            // 5. Simpan setiap item di keranjang ke tabel 'order_items'
            foreach ($cart as $id => $details) {
                $product = Product::find($id);

                // Cek ketersediaan stok
                if ($product->stock < $details['quantity']) {
                    throw new \Exception('Stok produk ' . $product->name . ' tidak mencukupi.');
                }

                $order->items()->create([
                    'product_id' => $id,
                    'quantity' => $details['quantity'],
                    'price' => $details['price'],
                ]);

                // 6. Kurangi stok produk
                $product->stock -= $details['quantity'];
                $product->save();
            }

            // Jika semua berhasil, konfirmasi transaksi
            DB::commit();

            // 7. Kosongkan keranjang belanja dari sesi
            session()->forget('cart');

            return redirect()->route('sales.dashboard')->with('success', 'Pesanan berhasil dibuat dengan nomor #' . $order->order_number);

        } catch (\Exception $e) {
            // Jika terjadi error, batalkan semua perubahan di database
            DB::rollBack();

            return redirect()->route('sales.cart.index')->with('error', 'Terjadi kesalahan saat memproses pesanan: ' . $e->getMessage());
        }
    }
}