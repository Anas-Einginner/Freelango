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
Route::get('verify-email/{guard}',[EmailVerificaionController::class,'verify'])
->name('verification.verfiy')
->where('guard', 'freelancer|web');


// Route::get('/', function () {
//     return view('welcome');
// });

// Admin login 

Route::prefix('admin/')->name('admin.')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('login', 'indexLogin')->name('login')->defaults('guard', 'admin');
        Route::post('login', 'login')->name('login.submit')->defaults('guard', 'admin');
        Route::get('dashboard', 'dashboard')->middleware('auth:admin')->name('dashboard');
    });
 
});



// Freelancer login 

Route::prefix('freelancer')->name('freelancer.')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('login','indexLogin')->name('login')->defaults('guard', 'freelancer');
        Route::post('login')->name('login.submit')->defaults('guard', 'freelancer');
        Route::get('register','indexRegister')->name('register')->defaults('guard', 'freelancer');
        Route::post('register','register')->name('register.submit')->defaults('guard', 'freelancer');
        Route::get('dashboard', 'dashboard')->middleware('auth:freelancer')->name('dashboard');
    });
  
});




// User login
Route::prefix('user')->name('user.')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('login','indexLogin')->name('login')->defaults('guard', 'web');
        Route::post('login')->name('login.submit')->defaults('guard', 'web');
        Route::get('register','indexRegister')->name('register')->defaults('guard', 'web');
        Route::post('register','register')->name('register.submit')->defaults('guard', 'web');
        Route::get('dashboard', 'dashboard')->middleware('auth:web')->name('dashboard');

    });

    
});
