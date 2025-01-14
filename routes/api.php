<?php

use App\Http\Controllers\Api\MatrixController;
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

Route::prefix('matrix')->group(function() {
    Route::get('/', [MatrixController::class, 'data'])->name('api.matrix.data');
    Route::get('{id?}', [MatrixController::class, 'detail'])->name('api.matrix.detail');
    Route::post('/', [MatrixController::class, 'creating'])->name('api.matrix.creating');
    Route::put('{id}', [MatrixController::class, 'updating'])->name('api.matrix.updating');
    Route::delete('{id}', [MatrixController::class, 'deleting'])->name('api.matrix.deleting');
});