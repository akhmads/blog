<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Volt::route('/', 'site.home');
Volt::route('/post/{post:slug}', 'site.post');
Volt::route('/tag/{tag:slug}', 'site.tag');

Volt::route('/login', 'login')->name('login');
Volt::route('/page-not-found', '404');

Route::prefix('cp')->group(function () {

    Route::middleware('auth')->group(function () {

        Route::redirect('/', '/cp/home');
        Volt::route('/home', 'home');
        Volt::route('/user/profile', 'users.profile');

        Volt::route('/posts', 'posts.index');
        Volt::route('/posts/create', 'posts.create');
        Volt::route('/posts/{post}/edit', 'posts.edit');

        Volt::route('/tags', 'tags.index');
        Volt::route('/tags/create', 'tags.create');
        Volt::route('/tags/{tag}/edit', 'tags.edit');
    });

    Route::middleware(['auth','can:admin'])->group(function () {

        Volt::route('/users', 'users.index');
        Volt::route('/users/create', 'users.create');
        Volt::route('/users/{user}/edit', 'users.edit');

    });

    Route::get('/logout', function () {
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    });

});
