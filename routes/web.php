<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\NewsArticleController as AdminNewsArticleController;
use App\Http\Controllers\Front\HomepageController;

Route::get('/', [HomepageController::class, 'index'])->name('home');
Route::get('/news/{news}', [HomepageController::class, 'show'])->name('news.show');
Route::get('/category/{category}', [HomepageController::class, 'category'])->name('news.category');


Route::get('/dashboard', function () {
    return view('dashboardnew', ['totalUsers' => 1250,
        'revenue' => 153000000,
        'todayOrders' => 87,
        'activeProducts' => 342]);
})->name('dashboard');
// ->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('categories', AdminCategoryController::class);
    Route::resource('news', AdminNewsArticleController::class);
});


require __DIR__.'/auth.php';
