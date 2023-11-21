<?php

use App\Http\Controllers\RegisterController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [RegisterController::class, 'create']);
Route::post('/store', [RegisterController::class, 'store'])->name('register.store');
Route::get('/send-otp', [RegisterController::class, 'sendOtp'])->name('send.otp');
