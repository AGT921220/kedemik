<?php

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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::resource('/', 'HomeController')->only(['index']);
Route::resource('/home', 'Dashboard\HomeController')->only(['index']);

Route::resource('/dashboard/clientes', 'Dashboard\ClientController');
Route::resource('/dashboard/vales', 'Dashboard\VoucherController');
Route::resource('/dashboard/payments', 'Dashboard\PaymentController');
