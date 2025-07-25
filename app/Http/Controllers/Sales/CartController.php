<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Menampilkan halaman keranjang belanja.
     */
    public function index()
    {
        // Ambil data keranjang dari sesi
        $cart = session()->get('cart', []);

        return view('sales.cart.index', compact('cart'));
    }

    /**
     * Menambahkan produk ke keranjang belanja di sesi.
     */
    public function add(Request $request, Product $product)
    {
        // Ambil keranjang yang sudah ada dari sesi, atau buat array kosong jika belum ada
        $cart = session()->get('cart', []);

        // Cek apakah produk sudah ada di keranjang
        if(isset($cart[$product->id])) {
            // Jika sudah ada, tambahkan jumlahnya
            $cart[$product->id]['quantity']++;
        } else {
            // Jika belum ada, tambahkan produk baru ke keranjang
            $cart[$product->id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image_path" => $product->image_path
            ];
        }

        // Simpan kembali keranjang yang sudah diperbarui ke dalam sesi
        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Kuantitas berhasil diperbarui.');
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Produk berhasil dihapus dari keranjang.');
    }
}