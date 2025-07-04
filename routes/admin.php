<?php

use App\Http\Controllers\Admin\AdminAuthenticationController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\ProfileController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('login', [AdminAuthenticationController::class, 'create'])->name('login');
    Route::post('login', [AdminAuthenticationController::class, 'store']);
    Route::post('logout', [AdminAuthenticationController::class, 'destroy'])->name('logout');
    Route::get('forgot-password', [AdminAuthenticationController::class, 'forgot'])->name('forgot-password');
    Route::post('forgot-password', [AdminAuthenticationController::class, 'send']);
    Route::get('reset-password/{token}', [AdminAuthenticationController::class, 'reset'])->name('reset-password');
    Route::post('reset-password', [AdminAuthenticationController::class, 'change'])->name('change-password');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile
    Route::put('update-password/{id}', [ProfileController::class, 'change'])->name('update-password');
    Route::resource('profile', ProfileController::class);

    // Languages
    Route::resource('languages', LanguageController::class);

    // Categories
    Route::resource('categories', CategoryController::class);

    // News
    Route::get('news/categories', [NewsController::class, 'categories'])->name('news.categories');
    Route::get('news/duplicate/{news}', [NewsController::class, 'duplicate'])->name('news.duplicate');
    Route::resource('news', NewsController::class);
});
