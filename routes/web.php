<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\AdminAuthController;

Route::get('/test', function () {
    return view('user.login'); 
});


Route::middleware('auth')->group(function () {
    Route::get('/home', function () {
        return view('user.home'); 
    })->name('user.home');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::prefix('admin')->middleware('auth:admin')->group(function () {
    Route::get('/dashboard', [AdminAuthController::class, 'showDashboard'])->name('admin.dashboard');
    Route::get('/orders', [AdminAuthController::class, 'showOrders'])->name('admin.orders');
    Route::get('/sales', [AdminAuthController::class, 'showSales'])->name('admin.sales');
    //Route::get('/sales/calculate', [AdminAuthController::class, 'calculateSales'])->name('sales.calculate');
    Route::get('/reviews', [AdminAuthController::class, 'showReviews'])->name('admin.reviews');
    Route::get('reviews/delete/{id}', [AdminAuthController::class, 'deleteReview'])->name('reviews.delete');
    Route::get('/admins', [AdminAuthController::class, 'showAdminList'])->name('admin.adminList');
    Route::put('/admins/{id}', [AdminAuthController::class, 'update'])->name('admin.update');
    Route::delete('/orders/{id}', [AdminAuthController::class, 'destroyOrder'])->name('orders.delete');
    Route::delete('/admins/{id}', [AdminAuthController::class, 'destroy'])->name('admin.delete');
    Route::put('/orders/{id}', [AdminAuthController::class, 'updateOrder'])->name('orders.update');
    Route::delete('/orders/{id}', [AdminAuthController::class, 'destroyOrder'])->name('orders.delete');
    Route::put('/sales/{sale}', [AdminAuthController::class, 'updateSale'])->name('sales.update');
    Route::delete('/sales/delete/{id}', [AdminAuthController::class, 'destroySale'])->name('sales.delete');
    Route::post('/sales', [AdminAuthController::class, 'store'])->name('sales.store');

});

require __DIR__.'/auth.php';

Route::prefix('user')->group(function () {
    Route::get('login', [UserAuthController::class, 'showLogin'])->name('user.login');
    Route::post('login', [UserAuthController::class, 'login']);
    Route::get('register', [UserAuthController::class, 'showRegister'])->name('user.register');
    Route::post('register', [UserAuthController::class, 'register']);
    Route::get('home', [UserAuthController::class, 'home'])->name('user.home');
    Route::get('/cek-tiket', [UserAuthController::class, 'cekTiketForm'])->name('user.ticket');
    Route::post('/cek-tiket/search', [UserAuthController::class, 'searchTicket'])->name('cek.tiket.search');
    Route::get('/outlet', [UserAuthController::class, 'outlet'])->name('user.outlet');
    Route::post('/book', [UserAuthController::class, 'book'])->name('ticket.book');
    Route::get('/contact', [UserAuthController::class, 'contact'])->name('user.contact');
    Route::post('logout', [UserAuthController::class, 'logout'])->name('user.logout');
});

Route::prefix('admin')->group(function () {
    Route::get('login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
    Route::post('login', [AdminAuthController::class, 'login']);
    Route::get('register', [AdminAuthController::class, 'showRegister'])->name('admin.register');
    Route::post('register', [AdminAuthController::class, 'register']);
    Route::post('logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
});

Route::fallback(function () {
    return view('global.notfound');
});