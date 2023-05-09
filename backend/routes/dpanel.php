<?php

use Illuminate\Support\Facades\Route;

Route::namespace('App\Http\Controllers\Dpanel')->group(function () {
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
});
Route::get('/logout', [\DD4You\Dpanel\Http\Controllers\AuthController::class, 'logout'])->name('logout');
Route::resource('global-settings', \DD4You\Dpanel\Http\Controllers\GlobalSettingController::class)->only('index', 'store');
