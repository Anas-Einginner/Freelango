<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Admin login 

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [LoginController::class, 'index'])->name('login')->defaults('guard', 'admin');
    Route::post('login', [LoginController::class, 'login'])->name('login.submit')->defaults('guard', 'admin');
       Route::get('dashboard', function () {
        return view('admin.index');
    })->middleware('auth:admin')->name('dashboard');
});



// Freelancer login 

Route::prefix('freelancer')->name('freelancer.')->group(function () {
    Route::get('login', [LoginController::class, 'index'])->name('login')->defaults('guard', 'freelancer');
    Route::post('login', [LoginController::class, 'login'])->name('login.submit')->defaults('guard', 'freelancer');
        Route::get('dashboard', function () {
        return view('freelancer.index');
    })->middleware('auth:freelancer')->name('dashboard');
});




// // Web user login
Route::prefix('user')->name('user.')->group(function () {
Route::get('login', [LoginController::class, 'index'])->name('login')->defaults('guard', 'user');
Route::post('login', [LoginController::class, 'login'])->name('login.submit')->defaults('guard', 'user');

Route::get('dashboard', function () {
    return view('user.index');
})->middleware('auth:user')->name('dashboard');
});

