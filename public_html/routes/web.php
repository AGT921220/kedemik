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

Route::group(['middleware' => ['auth']], function () {

    Route::resource('/home', 'Dashboard\HomeController')->only(['index']);

    Route::resource('/dashboard/clientes', 'Dashboard\ClientController');
    Route::resource('/dashboard/vales', 'Dashboard\VoucherController');
    Route::resource('/dashboard/vales-electronics', 'Dashboard\VoucherElectronicsController');

    
    Route::resource('/dashboard/payments', 'Dashboard\PaymentController');



    /**********REPORTES**********/
    Route::resource('/dashboard/reportes', 'Dashboard\ReportController')->only(['index']);

    /**********HISTORIAL**********/
    Route::get('/dashboard/historial/kedemik', 'Dashboard\VoucherController@history');
    Route::get('/dashboard/historial/kedemik-electronics', 'Dashboard\VoucherController@historyElectronics');

    
    

});

Route::get('{path}', function () {
    return view('welcome');
})->where('path', '(.*)');
