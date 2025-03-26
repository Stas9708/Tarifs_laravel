<?php

use App\Http\Controllers\TarifController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TarifController::class, 'index'])->name('tarifs.index');
Route::post('/tarifs/store', [TarifController::class, 'store'])->name('tarifs.store');
