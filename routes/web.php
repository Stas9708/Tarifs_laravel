<?php

use App\Http\Controllers\TarifController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TarifController::class, 'index'])->name('tarifs.index');
Route::post('/tarifs/store', [TarifController::class, 'store'])->name('tarifs.store');
Route::get('/chart', [\App\Http\Controllers\ChartController::class, 'showChartPage'])->name('chart');
Route::get('/table', [\App\Http\Controllers\TableController::class, 'index'])->name('table');
Route::get('/table/store', [\App\Http\Controllers\TableController::class, 'store'])->name('table.store');
