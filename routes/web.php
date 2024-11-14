<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EspacoCafeController;
use App\Http\Controllers\PessoaController;
use App\Http\Controllers\SalaController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function() {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::group(['prefix' => '/salas', 'as' => 'salas.'], function () {
    Route::get('/index', [SalaController::class, 'index'])->name('index');
    Route::post('/store', [SalaController::class, 'store'])->name('store');
    Route::get('/show/{id}', [SalaController::class, 'show'])->name('show');
    Route::get('/edit/{id}', [SalaController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [SalaController::class, 'update'])->name('update');
    Route::post('/destroy/{id}', [SalaController::class, 'destroy'])->name('destroy');
    Route::post('/vincularParticipantesEtapa1/{id}', [SalaController::class, 'vincularParticipantesEtapa1'])->name('vincularParticipantesEtapa1');
    Route::post('/vincularParticipantesEtapa2/{id}', [SalaController::class, 'vincularParticipantesEtapa2'])->name('vincularParticipantesEtapa2');
});

Route::group(['prefix' => '/espacoCafes', 'as' => 'espacoCafes.'], function () {
    Route::get('/index', [EspacoCafeController::class, 'index'])->name('index');
    Route::post('/store', [EspacoCafeController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [EspacoCafeController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [EspacoCafeController::class, 'update'])->name('update');
    Route::post('/destroy/{id}', [EspacoCafeController::class, 'destroy'])->name('destroy');
});

Route::group(['prefix' => '/pessoas', 'as' => 'pessoas.'], function () {
    Route::get('/index', [PessoaController::class, 'index'])->name('index');
    Route::post('/store', [PessoaController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [PessoaController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [PessoaController::class, 'update'])->name('update');
    Route::post('/destroy/{id}', [PessoaController::class, 'destroy'])->name('destroy');

    Route::get('/desvincularPrimeiraEtapa/{id}', [PessoaController::class, 'desvincularPrimeiraEtapa'])->name('desvincularPrimeiraEtapa');
    Route::get('/desvincularSegundaEtapa/{id}', [PessoaController::class, 'desvincularSegundaEtapa'])->name('desvincularSegundaEtapa');
    Route::get('/desvincularPrimeiroIntervalo/{id}', [PessoaController::class, 'desvincularPrimeiroIntervalo'])->name('desvincularPrimeiroIntervalo');
    Route::get('/desvincularSegundoIntervalo/{id}', [PessoaController::class, 'desvincularSegundoIntervalo'])->name('desvincularSegundoIntervalo');
});
