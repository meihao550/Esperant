<?php

use App\Http\Controllers\ForumController;
use App\Http\Controllers\GeminiTestController;
use App\Http\Controllers\GenerateController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\OAuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});
Route::resource('/forums', ForumController::class)->middleware('auth'); // 認証されていなければloginにルート
Route::post('/forums/{forum}/reply', [ForumController::class, 'reply'])->name('forums.reply')->middleware('auth'); // viewのformルートのためにエイリアスの作成
Route::get('/generate', [GenerateController::class, 'index']);
Route::post('/generate', [GenerateController::class, 'generate'])->name('generate');

//　認証にLaravel Socialiteを使用。
Route::get('/auth/redirect', [OAuthController::class, 'redirectToProvider'])->name('login');
Route::get('/auth/callback', [OAuthController::class, 'handleProviderCallback']);

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
});
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

// AI
Route::get('/gemini-test', [GeminiTestController::class, 'index']);
Route::post('/gemini-test', [GeminiTestController::class, 'review'])->name('gemini-review');
