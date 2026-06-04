<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\OAuthController;
use App\Http\Controllers\LogoutController;

Route::get('/', function () {
    return view('home');
});

//　認証にLaravel Socialiteを使用。
Route::get('/auth/redirect', [OAuthController::class, 'redirectToProvider']);
Route::get('/auth/callback', [OAuthController::class, 'handleProviderCallback']);

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
});
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');