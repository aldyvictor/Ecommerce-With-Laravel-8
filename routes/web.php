<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/categories', [App\Http\Controllers\CategoryCtrl::class, 'index'])->name('categories');
Route::get('/categories/{id}', [App\Http\Controllers\CategoryCtrl::class, 'detail'])->name('categories-detail');

Route::get('/details/{id}', [App\Http\Controllers\DetailCtrl::class, 'index'])->name('detail');
Route::post('/details/{id}', [App\Http\Controllers\DetailCtrl::class, 'addToCart'])->name('detail-add');

Route::post('/checkout/callback', [App\Http\Controllers\CheckoutCtrl::class, 'callbackCheckout'])->name('callback-checkout');

Route::get('/success', [App\Http\Controllers\CartCtrl::class, 'success'])->name('success');

Route::group(['middleware' => ['auth']], function() {
    Route::get('/cart', [App\Http\Controllers\CartCtrl::class, 'index'])->name('cart');
    Route::delete('/cart/{id}', [App\Http\Controllers\CartCtrl::class, 'delete'])->name('cart-delete');

    Route::post('/checkout', [App\Http\Controllers\CheckoutCtrl::class, 'process'])->name('checkout');

    Route::get('/dashboard', [App\Http\Controllers\DashboardCtrl::class, 'index'])->name('dashboard');

    Route::get('/dashboard/products', [App\Http\Controllers\DashboardProductCtrl::class, 'index'])
        ->name('dashboard-products');
    Route::get('/dashboard/products/create', [App\Http\Controllers\DashboardProductCtrl::class, 'create'])
        ->name('dashboard-product-create');
    Route::post('/dashboard/products', [App\Http\Controllers\DashboardProductCtrl::class, 'store'])
        ->name('dashboard-product-store');
    Route::get('/dashboard/products/{id}', [App\Http\Controllers\DashboardProductCtrl::class, 'details'])
        ->name('dashboard-product-details');
    Route::post('/dashboard/products/{id}', [App\Http\Controllers\DashboardProductCtrl::class, 'update'])
        ->name('dashboard-product-update');

    Route::post('/dashboard/products/gallery/upload', [App\Http\Controllers\DashboardProductCtrl::class, 'uploadGallery'])
        ->name('dashboard-product-upload-gallery');
    Route::get('/dashboard/products/gallery/delete/{id}', [App\Http\Controllers\DashboardProductCtrl::class, 'deleteGallery'])
        ->name('dashboard-product-gallery-delete');

    Route::get('/dashboard/transactions', [App\Http\Controllers\DashboardTransactionsCtrl::class, 'index'])
        ->name('dashboard-transactions');
    Route::get('/dashboard/transactions/{id}', [App\Http\Controllers\DashboardTransactionsCtrl::class, 'details'])
        ->name('dashboard-transactions-details');
    Route::post('/dashboard/transactions/{id}', [App\Http\Controllers\DashboardTransactionsCtrl::class, 'update'])
        ->name('dashboard-transactions-update');

    Route::get('/dashboard/settings', [App\Http\Controllers\DashboardAccountSettingsCtrl::class, 'store'])
        ->name('dashboard-settings-store');
    Route::get('/dashboard/account', [App\Http\Controllers\DashboardAccountSettingsCtrl::class, 'account'])
        ->name('dashboard-settings-account');
    Route::post('/dashboard/account/{redirect}', [App\Http\Controllers\DashboardAccountSettingsCtrl::class, 'update'])
        ->name('dashboard-settings-redirect');
});

Route::prefix('admin')
    ->namespace('App\Http\Controllers\Admin')
    ->middleware(['auth', 'admin'])
    ->group(function() {
        Route::get('/', [App\Http\Controllers\Admin\AdminDashboardCtrl::class, 'index'])
            ->name('admin-dashboard');
        Route::resource('category', CategoryAdminCtrl::class);
        Route::resource('user', UserAdminCtrl::class);
        Route::resource('product', ProductCtrl::class);
        Route::resource('product-gallery', ProductGalleryCtrl::class);
    });

Auth::routes();
