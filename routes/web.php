<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ThreeDLoginController;

// Auth

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login.post');

Route::get('3d-login', [ThreeDLoginController::class, 'index'])->name('login3d');
Route::post('3d-login', [ThreeDLoginController::class, 'login'])->name('login3d.post');

Route::group([], __DIR__.'/pertials/2d.php');
Route::group([], __DIR__.'/pertials/3d.php');

Route::get('test', function () {
    return view('test');
});
