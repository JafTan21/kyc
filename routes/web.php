<?php

use App\Http\Controllers\KYCController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::resource('KYC', KYCController::class)->except(['update']);
});
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('KYC', KYCController::class)->only(['update']);
    Route::get('KYC-list', [KYCController::class, 'list'])->name('kyc-list');
});

Route::get('/', function () {
    if (auth()->check()) {
        if (auth()->user()->hasRole('admin')) {
            return redirect()->route('kyc-list');
        } else {
            return redirect()->route('KYC.index');
        }
    } else {
        return redirect()->route('login');
    }
});

Route::redirect('/dashboard', '/');


require __DIR__ . '/auth.php';

Route::middleware('auth')->group(function () {
    Route::view('about', 'about')->name('about');

    Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');

    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
});