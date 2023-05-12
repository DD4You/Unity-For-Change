<?php

use App\Http\Controllers\Dpanel\CampaignController;
use App\Http\Controllers\Dpanel\CampaignImageController;
use App\Http\Controllers\Dpanel\CategoryController;
use Illuminate\Support\Facades\Route;

Route::namespace('App\Http\Controllers\Dpanel')->group(function () {
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    Route::resource('category', CategoryController::class)->except('create', 'edit', 'show');

    Route::resource('campaign', CampaignController::class)->except('destroy');
    Route::resource('campaign-image', CampaignImageController::class)->only('store', 'destroy');
});
Route::get('/logout', [\DD4You\Dpanel\Http\Controllers\AuthController::class, 'logout'])->name('logout');
Route::resource('global-settings', \DD4You\Dpanel\Http\Controllers\GlobalSettingController::class)->only('index', 'store');
