<?php
use App\Http\Controllers\mainController;
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
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Route::get('/{any}',  [mainController::class, 'index'])->where('any', '.*');
Route::get('/paypal', 'PaypalController@index');
Route::post('/charge', 'PaypalController@charge');
Route::get('/paypalsuccess', 'PaypalController@payment_success');
Route::get('/paypalerror', 'PaypalController@payment_error');
 
//для тестового платежа 
Route::get('/test', function () {
    return view('general.test');
}); // в папке resources/views/ должна быть папка general и в ней файл test.blade.php

