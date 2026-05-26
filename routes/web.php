<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');

Route::get('/', function () {
    return 'Home Page';
})->name('home');

Route::get('/about', function () {
    return 'About Page';
})->name('about');

Route::get('/reservation', function () {
    return 'Reservation Page';
})->name('reservation');

Route::get('/gallery', function () {
    return 'Gallery Page';
})->name('gallery');

Route::get('/reviews', function () {
    return 'Reviews Page';
})->name('reviews');

Route::get('/contact', function () {
    return 'Contact Us Page';
})->name('contact');

Route::middleware(['role:admin'])->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::prefix('gallery')->name('gallery.')->group(function () {
            Route::get('/', function () {
                return 'Admin Gallery';
            })->name('index');
        });

        Route::prefix('reviews')->name('reviews.')->group(function () {
            Route::get('/', function () {
                return 'Admin Reviews';
            })->name('index');
        });

        Route::prefix('menu')->name('menu.')->group(function () {
            Route::get('/', function () {
                return 'Admin Menu - Manage Menu Items';
            })->name('index');
        });

        Route::prefix('users')->name('users.')->group(function () {
            Route::get('/', function () {
                return 'Admin Users - Manage Users';
            })->name('index');
        });

        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    });
});
