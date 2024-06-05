<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Volt::route('/login', 'login')->name('login');
Volt::route('/handover', '404');

Route::middleware('auth')->group(function () {

    Volt::route('/', 'home');
    Volt::route('/user/profile', 'users.profile');

    Volt::route('/product', 'product.index');
    Volt::route('/product/create', 'product.create');
    Volt::route('/product/{product}/edit', 'product.edit');

    Volt::route('/category', 'category.index');
    Volt::route('/category/create', 'category.create');
    Volt::route('/category/{category}/edit', 'category.edit');

    Route::get('/print-export-label', [\App\Http\Controllers\PrintController::class, 'exportLabel']);
    Route::get('/print-export-receipt', [\App\Http\Controllers\PrintController::class, 'exportReceipt']);
});

Route::middleware(['auth','can:admin'])->group(function () {

    Volt::route('/users', 'users.index');
    Volt::route('/users/create', 'users.create');
    Volt::route('/users/{user}/edit', 'users.edit');
    Volt::route('/country', 'country.index');
    Volt::route('/country/create', 'country.create');
    Volt::route('/country/{country}/edit', 'country.edit');
    Volt::route('/province', 'province.index');
    Volt::route('/province/create', 'province.create');
    Volt::route('/province/{province}/edit', 'province.edit');
    Volt::route('/city', 'city.index');
    Volt::route('/city/create', 'city.create');
    Volt::route('/city/{city}/edit', 'city.edit');
    Volt::route('/district', 'district.index');
    Volt::route('/district/create', 'district.create');
    Volt::route('/district/{district}/edit', 'district.edit');

    Route::get('/export-price/export', [\App\Http\Controllers\PriceController::class, 'export']);
});

Route::get('/logout', function () {
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
});
