<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Models\User;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Admin\SalesController;
use App\Http\Controllers\Admin\PartnershipController;
use App\Http\Controllers\Sales\DashboardController;
use App\Http\Controllers\Sales\VisitController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Sales\MerchantController;
use App\Http\Controllers\Admin\MerchantApprovalController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Sales\CatalogController;
use App\Http\Controllers\Sales\CartController;
use App\Http\Controllers\Sales\CheckoutController;
use App\Http\Controllers\Sales\OrderController;
use App\Http\Controllers\Admin\OrderManagementController;
use App\Http\Controllers\Sales\B2gController;
use App\Http\Controllers\Admin\B2gPotentialController;
use App\Http\Controllers\Warehouse\OrderController as WarehouseOrderController;

Route::get('/', function () {
    return redirect('/dashboard');
})->middleware('auth');

Route::get('/logout-darurat', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::resource('/users', UserManagementController::class);
    Route::resource('/sales', SalesController::class);
    Route::resource('/partnerships', PartnershipController::class);

    //route approval merchant
    Route::get('/merchant-approvals', [MerchantApprovalController::class, 'index'])->name('merchants.approvals.index');
    Route::patch('/merchant-approvals/{merchant}', [MerchantApprovalController::class, 'update'])->name('merchants.approvals.update');
    Route::get('/merchant-approvals/{merchant}', [MerchantApprovalController::class, 'show'])->name('merchants.approvals.show');

    //route kategori katalog
    Route::resource('categories', CategoryController::class);

    //route produk
    Route::resource('products', ProductController::class);

    //route order manage
    Route::get('/orders', [OrderManagementController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderManagementController::class, 'show'])->name('orders.show');
    Route::patch('/orders/{order}', [OrderManagementController::class, 'update'])->name('orders.update');

    //route b2g potential 
    Route::resource('b2g_potentials', B2gPotentialController::class)->only(['index', 'show', 'destroy']);
});

Route::middleware(['auth', 'role:tim_b2g,tim_merchant'])->prefix('sales')->name('sales.')->group(function () {
    // Route untuk dasbor sales
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Route lain untuk sales nanti diletakkan di sini
    Route::resource('visits', VisitController::class);

    //route buat merchant
    Route::resource('merchants', MerchantController::class)->only(['index','show','create', 'store']);

    //route katalog produk
    Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog.index');

    //route kranjang
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

    //route checkout
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

    //route order
    Route::resource('orders', OrderController::class)->only(['index', 'show']);
    Route::post('/orders/start/{merchant}', [OrderController::class, 'startOrder'])->name('orders.start');


    //route B2G
    Route::resource('b2g_potentials', B2gController::class);
});

Route::middleware(['auth', 'role:tim_gudang'])->prefix('warehouse')->name('warehouse.')->group(function () {
    // Arahkan dashboard utama ke halaman daftar pesanan
    Route::get('/dashboard', [WarehouseOrderController::class, 'index'])->name('dashboard');

    // Sediakan route untuk melihat detail dan mengupdate status
    Route::resource('orders', WarehouseOrderController::class)->only(['index', 'show', 'update']);
});

Route::get('/test-role', function () {
    $user = User::first();
    $user->assignRole('admin');
    return 'Role admin berhasil diberikan ke user: ' . $user->email;
});

Route::get('/test-admin', function () {
    return 'HALO ADMIN!';
})->middleware(['auth', 'admin']);


require __DIR__.'/auth.php';
