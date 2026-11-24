<?php

use App\Http\Controllers\ComplaintController;
use Illuminate\Support\Facades\Route;

// Public: residents submit complaints
Route::post('/complaints', [ComplaintController::class, 'store']);

// Staff only -- wrap in your auth middleware (e.g. auth:sanctum)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/complaints', [ComplaintController::class, 'index']);
    Route::get('/complaints/{complaint}', [ComplaintController::class, 'show']);
    Route::patch('/complaints/{complaint}', [ComplaintController::class, 'update']);
    Route::get('/stats', [ComplaintController::class, 'stats']);
    Route::post('/retrain', [ComplaintController::class, 'retrain']);
});
