<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\MenuCategoryController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');

Route::get('/language/{locale}', function (Request $request, string $locale) {
    abort_unless(in_array($locale, ['id', 'en'], true), 404);

    session(['locale' => $locale]);

    return back();
})->name('language.switch');

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/reservation', [PageController::class, 'reservation'])->name('reservation');
Route::get('/gallery', [PageController::class, 'gallery'])->name('gallery');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/menu', [PageController::class, 'menu'])->name('menu');
Route::get('/menu/data', [PageController::class, 'menuData'])->name('menu.data');

Route::middleware(['role:admin'])->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('menu-category', MenuCategoryController::class);
        Route::resource('reviews', ReviewController::class);
        Route::resource('menu', MenuController::class);
        Route::resource('gallery', GalleryController::class)->except(['show', 'create']);
        Route::resource('users', UserController::class)->except(['show']);

        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    });
});
