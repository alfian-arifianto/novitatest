<?php

use App\Http\Controllers\MatrixController;
use Illuminate\Support\Facades\Route;

Route::prefix('matrix')->group(function() {
    Route::get('/', [MatrixController::class, 'index'])->name('matrix.index');
    Route::get('show/{id}', [MatrixController::class, 'show'])->name('matrix.show');
    Route::get('create', [MatrixController::class, 'create'])->name('matrix.create');
    Route::get('edit/{id}', [MatrixController::class, 'edit'])->name('matrix.edit');
});
Route::get('/', function () {
    return redirect()->route('matrix.index');
});
