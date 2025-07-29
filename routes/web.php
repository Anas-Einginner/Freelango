<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\EmailVerificaionController;
use Illuminate\Support\Facades\Auth;
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
// Route to verify email
Route::get('verify-email/{guard}', [EmailVerificaionController::class, 'verify'])
    ->name('verification.verfiy')
    ->where('guard', 'freelancer|web');
Route::get('con', function () {
    return view('auth.confirm');
})->name('con');

Route::get('/index', function () {
    return view('auth.forget-password');
});

// Admin login 

Route::prefix('admin/')->name('admin.')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('login', 'indexLogin')->name('login')->defaults('guard', 'admin');
        Route::post('login', 'login')->name('login.submit')->defaults('guard', 'admin');
        Route::get('forget-password',  'indexForgetPassword')->name('forget-password')->defaults('guard', 'admin');
        Route::post('forget-password',  'forgetPassword')->name('forget-password.submit')->defaults('guard', 'admin');
        Route::get('reset-password/{token}',  'showResetForm')->name('password.reset')->defaults('guard', 'admin');
        Route::post('reset-password', 'resetPassword')->name('password.update')->defaults('guard', 'admin');
        Route::get('dashboard', 'dashboard')->defaults('guard', 'admin')->middleware('auth:admin')->name('dashboard');
    });
});



// Freelancer login 

Route::prefix('freelancer')->name('freelancer.')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('login', 'indexLogin')->name('login')->defaults('guard', 'freelancer');
        Route::post('login', 'login')->name('login.submit')->defaults('guard', 'freelancer');
        Route::get('register', 'indexRegister')->name('register')->defaults('guard', 'freelancer');
        Route::post('register', 'register')->name('register.submit')->defaults('guard', 'freelancer');
        
     Route::get('forget-password',  'indexForgetPassword')->name('forget-password')->defaults('guard', 'freelancer');
        Route::post('forget-password',  'forgetPassword')->name('forget-password.submit')->defaults('guard', 'freelancer');
        Route::get('reset-password/{token}',  'showResetForm')->name('password.reset')->defaults('guard', 'freelancer');
        Route::post('reset-password', 'resetPassword')->name('password.update')->defaults('guard', 'freelancer');
        Route::get('dashboard', 'dashboard')->defaults('guard', 'freelancer')->middleware('auth:freelancer')->name('dashboard');
    });
});




// User login
// User Routes
Route::prefix('user')->name('web.')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('login',  'indexLogin')->name('login')->defaults('guard', 'web');
        Route::post('login', 'login')->name('login.submit')->defaults('guard', 'web');

        Route::get('register',  'indexRegister')->name('web.register')->defaults('guard', 'web');
        Route::post('register',  'register')->name('web.register.submit')->defaults('guard', 'web');
        Route::get('dashboard', 'dashboard')->name('dashboard')->defaults('guard', 'web');
        Route::get('forget-password',  'indexForgetPassword')->name('forget-password')->defaults('guard', 'web');
        Route::post('forget-password',  'forgetPassword')->name('forget-password.submit')->defaults('guard', 'web');
        Route::get('reset-password/{token}',  'showResetForm')->name('password.reset')->defaults('guard', 'web');
        Route::post('reset-password', 'resetPassword')->name('password.update')->defaults('guard', 'web');
        Route::post('reset-password', 'resetPassword')
            ->name('password.update')
            ->defaults('guard', 'web');
    });
});
