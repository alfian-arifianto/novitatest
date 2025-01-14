<?php

use App\Http\Controllers\MatrixController;
use Illuminate\Support\Facades\Route;

// Route::prefix('matrix')->group(function() {
//     Route::get('/', [MatrixController::class, 'index'])->name('matrix.index');
//     Route::get('create', [MatrixController::class, 'create'])->name('matrix.create');
//     Route::get('show/{id}', [MatrixController::class, 'show'])->name('matrix.show');
// });

Route::resource('matrix', MatrixController::class);
Route::get('/', function () {
    return redirect()->route('matrix.index');
});
