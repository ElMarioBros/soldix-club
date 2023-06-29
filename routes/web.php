<?php

use App\Http\Controllers\AdminsController;
use App\Http\Controllers\CorporatesController;
use App\Http\Controllers\CouponsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WalletsController;
use App\Http\Controllers\BrandsController;
use Illuminate\Support\Facades\Route;

// HOME
Route::get('/', function () {
    return view('welcome');
});
// END HOME

Route::get('/dashboard', [DashboardController::class, 'redirect'])->middleware(['auth', 'verified'])->name('dashboard');

// USER
Route::middleware(['auth', 'verified', 'is_user'])->group(function () {
    Route::get('/wallet', function () {
        return view('user.index');
    })->name('wallet');

    Route::get('/coupon/{id}', function ($id) {
        return view('user.coupon');
    })->name('coupon');
});
// END USER

// CASHIER
Route::get('/pos', function () {
    return view('pos.pos');
})->middleware(['auth', 'verified'])->name('pos');

Route::get('/result', function () {
    return view('pos.result');
})->middleware(['auth', 'verified'])->name('result');
// END CASHIER

// CORPORATE
Route::middleware(['auth', 'verified', 'is_corporate'])->group(function () {
    Route::get('/corporate/users', [CorporatesController::class, 'index'])->name('corporate.index');
    Route::post('/corporate/users', [CorporatesController::class, 'store'])->name('corporate.store');
    Route::get('/corporate/coupons', [CouponsController::class, 'index'])->name('corporate.coupons');
    Route::get('/corporate/brands', [BrandsController::class, 'index'])->name('corporate.brands');
    Route::post('/corporate/brands', [BrandsController::class, 'store'])->name('corporate.brands.store');
    Route::get('/corporate/coupons/new', [CouponsController::class, 'new'])->name('corporate.coupons.new');
    Route::get('/corporate/coupon-wallets', [WalletsController::class, 'index'])->name('corporate.coupon-wallets');
});
// END CORPORATE

// SUPERADMIN
Route::middleware(['auth', 'verified', 'is_admin'])->group(function () {
    Route::get('/admin/users', [AdminsController::class, 'index'])->name('admin.index');
    Route::post('/admin/users', [AdminsController::class, 'store'])->name('admin.store');
    Route::delete('/admin/{id}', [AdminsController::class, 'destroy'])->name('admin.destroy');

    Route::get('/admin/corporate', [CorporatesController::class, 'index'])->name('admin.corporate.index');
    Route::post('/admin/corporate', [CorporatesController::class, 'store_local_admin'])->name('admin.corporate.store');
    Route::delete('/admin/corporate/{id}', [CorporatesController::class, 'destroy'])->name('admin.corporate.destroy');
});
// END SUPERADMIN

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// TESTS
Route::get('/test', function () {
    return view('test');
});

Route::get('/test-select-gadget', function () {
    return view('test-select-gadget');
});
// END TESTS

require __DIR__.'/auth.php';
