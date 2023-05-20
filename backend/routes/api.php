<?php

use App\Http\Controllers\Api\V1\CampaignController;
use App\Http\Controllers\Api\V1\PaymentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('payment/status/{id}', [PaymentController::class, 'status'])->name('api.payment.status');
Route::post('payment/{campaign}', [PaymentController::class, 'payment']);
Route::apiResource('campaigns', CampaignController::class)->only('index', 'show');
