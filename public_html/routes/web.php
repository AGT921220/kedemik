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
use Illuminate\Support\Facades\Session;

Auth::routes();

Route::resource('/', 'HomeController')->only(['index']);
Route::resource('propiedades-en-venta', 'PropertiesController')->only(['index','show']);
Route::get('propiedades-pagination', 'PropertiesController@pagination')->name('properties-pagination');

Route::resource('avaluos', 'AppraiseController')->only(['index','show']);
Route::resource('temas-de-infonavit', 'InfonavitController')->only(['index','show']);
Route::resource('temas-de-fovissste', 'FovisssteController')->only(['index','show']);
Route::resource('asesoria-juridica', 'AdvisoryController')->only(['index','show']);
Route::resource('construccion-y-remodelacion', 'ConstructionController')->only(['index','show']);


/*DASHBOARD*/
//middleware('auth')
Route::group(['middleware'=>['auth']],function()
{
Route::get('/home', 'Dashboard\DashboardController@index')->name('dashboard');

/*SLIDERS*/
Route::resource('/dashboard/sliders', 'Dashboard\SlidersController');
/*PROPIEDADES*/
Route::resource('/dashboard/propiedades', 'Dashboard\PropertiesController');
/*APPRAISE*/
Route::resource('/dashboard/avaluos', 'Dashboard\AppraiseController');
/*INFONAVIT*/
Route::resource('/dashboard/infonavit', 'Dashboard\InfonavitController');
/*FOVISSSTE*/
Route::resource('/dashboard/fovissste', 'Dashboard\FovisssteController');
/*ASESORIAS*/
Route::resource('/dashboard/asesorias', 'Dashboard\AdvisoryController');
/*CONSTRUCCION Y REMODELACION*/
Route::resource('/dashboard/construccion-y-remodelacion', 'Dashboard\ConstructionController');
});

//Route::get('{slug}','HomeController')->only();

// Route::get('locale',function ()
// {
//     return app()->getLocale();
// });
// Route::get('locale/{locale}', function ($locale)
// {
//     Session::put('locale', $locale);
//     return redirect('/');
// });
// Route::get('{slug}', 'Dashboard\DashboardController@index')->name('dashboard');
