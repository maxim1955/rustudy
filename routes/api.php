<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\PartnerController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PublicationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/partners', [PartnerController::class, 'index']);
Route::post('/partners', [PartnerController::class, 'create'])->middleware('auth:sanctum');
Route::delete('/partners/{partner}', [PartnerController::class, 'destroy'])->middleware('auth:sanctum');

Route::get('/publications', [PublicationController::class, 'index']);
Route::get('/publications/{publication}', [PublicationController::class, 'show']);

// Route::resources([
//     'partners' => PartnerController::class,
//     'publications' => PublicationController::class
// ]);

Route::post('login', [AuthController::class, 'signin']);
Route::post('register', [AuthController::class, 'signup']);