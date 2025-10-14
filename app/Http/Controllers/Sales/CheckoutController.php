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
        // 1. Ambil keranjang DAN info merchant dari sesi
        $cart = session()->get('cart');
        $merchantInfo = session()->get('order_for_merchant'); // <-- PERUBAHAN 1

        // 2. Validasi: pastikan keranjang dan sesi merchant ada
        if (!$cart || !$merchantInfo) { // <-- PERUBAHAN 2
            return redirect()->route('sales.dashboard')->with('error', 'Sesi pesanan tidak valid. Silakan mulai lagi dari halaman merchant.');
        }

        // Mulai transaksi database
        DB::beginTransaction();

        try {
            // 3. Hitung total harga
            $totalAmount = 0;
            foreach ($cart as $details) {
                $totalAmount += $details['price'] * $details['quantity'];
            }

            // 4. Buat pesanan baru di tabel 'orders' dengan menyertakan merchant_id
            $order = Order::create([
                'user_id' => Auth::id(),
                'merchant_id' => $merchantInfo['id'], // <-- PERUBAHAN 3 (KUNCI)
                'order_number' => 'ORD-' . strtoupper(Str::random(8)),
                'total_amount' => $totalAmount,
                'status' => 'pending',
            ]);

            // 5. Simpan setiap item di keranjang ke tabel 'order_items'
            foreach ($cart as $id => $details) {
                $product = Product::find($id);

                if ($product->stock < $details['quantity']) {
                    throw new \Exception('Stok produk ' . $product->name . ' tidak mencukupi.');
                }

                $order->items()->create([
                    'product_id' => $id,
                    'quantity' => $details['quantity'],
                    'price' => $details['price'],
                ]);

                // 6. Kurangi stok produk (menggunakan cara yang lebih aman)
                $product->decrement('stock', $details['quantity']);
            }

            // Konfirmasi transaksi jika semua berhasil
            DB::commit();

            // 7. Kosongkan keranjang DAN sesi merchant
            session()->forget('cart');
            session()->forget('order_for_merchant'); // <-- PERUBAHAN 4

            // Berikan pesan sukses yang lebih informatif
            return redirect()->route('sales.dashboard')->with('success', 'Pesanan untuk ' . $merchantInfo['name'] . ' berhasil dibuat dengan nomor #' . $order->order_number);

        } catch (\Exception $e) {
            // Batalkan semua perubahan jika terjadi error
            DB::rollBack();

            return redirect()->route('sales.cart.index')->with('error', 'Terjadi kesalahan saat memproses pesanan: ' . $e->getMessage());
        }
    }
}