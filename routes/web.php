<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\OAuthController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\GenerateController;

Route::get('/', function () {
    return view('home');
});
Route::resource('/forums', ForumController::class)->middleware('auth'); //認証されていなければloginにルート
Route::get('/generate', [GenerateController::class, 'index']);
Route::post('/generate', [GenerateController::class, 'generate'])->name('generate');

//　認証にLaravel Socialiteを使用。
Route::get('/auth/redirect', [OAuthController::class, 'redirectToProvider'])->name('login');
Route::get('/auth/callback', [OAuthController::class, 'handleProviderCallback']);

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
});
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

