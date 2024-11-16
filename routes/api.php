<?php

use App\Http\Controllers\EspacoCafeAPIController;
use App\Http\Controllers\PessoaAPIController;
use App\Http\Controllers\SalaAPIController;
use App\Http\Resources\EspacoCafeCollection;
use App\Http\Resources\PessoaCollection;
use App\Http\Resources\SalaCollection;
use App\Models\EspacoCafe;
use App\Models\Pessoa;
use App\Models\Sala;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => '/sala'], function() {
    Route::get('/', [SalaAPIController::class, 'index']);
    Route::post('/store', [SalaAPIController::class, 'store']);
    Route::put('/update/{id}', [SalaAPIController::class, 'update']);
    Route::delete('/destroy/{id}', [SalaAPIController::class, 'destroy']);
});

Route::group(['prefix' => '/espacoCafe'], function() {
    Route::get('/', [EspacoCafeAPIController::class, 'index']);
    Route::post('/store', [EspacoCafeAPIController::class, 'store']);
    Route::put('/update/{id}', [EspacoCafeAPIController::class, 'update']);
    Route::delete('/destroy/{id}', [EspacoCafeAPIController::class, 'destroy']);
});

Route::group(['prefix' => '/pessoa'], function() {
    Route::get('/', [PessoaAPIController::class, 'index']);
    Route::post('/store', [PessoaAPIController::class, 'store']);
    Route::put('/update/{id}', [PessoaAPIController::class, 'update']);
    Route::delete('/destroy/{id}', [PessoaAPIController::class, 'destroy']);
});
