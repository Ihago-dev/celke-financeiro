<?php

use App\Http\Controllers\ContaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Contas
Route::get('/index-conta', [ContaController::class, 'index'])->name('conta.index');
Route::get('/create-conta', [ContaController::class, 'create'])->name('conta.create');
Route::post('/store-conta', [ContaController::class, 'store'])->name('conta.store');
Route::get('/show-conta/{conta}', [ContaController::class, 'show'])->name('conta.show');
Route::get('/edit-conta/{conta}', [ContaController::class, 'edit'])->name('conta.edit');
Route::put('/update-conta/{conta}', [ContaController::class, 'update'])->name('conta.update');
Route::delete('/destroy-conta/{conta}', [ContaController::class, 'destroy'])->name('conta.destroy');

Route::get('/gerar-pdf-conta', [ContaController::class, 'gerarPdf'])->name('conta.gerar-pdf');