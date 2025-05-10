<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/', [TaskController::class, 'index']);
Route::post('/tasks', [TaskController::class, 'store']);
Route::patch('/tasks/{task}', [TaskController::class, 'toggle']);
Route::delete('/tasks/{task}', [TaskController::class, 'destroy']);
Route::get('/tasks/{task}/edit', [TaskController::class, 'edit']);
Route::put('/tasks/{task}', [TaskController::class, 'update']);
Route::patch('/tasks/{task}/status', [TaskController::class, 'toggle']);
Route::post('/tasks/reorder', [TaskController::class, 'reorder']);





// Optional: keep auth routes
require __DIR__.'/auth.php';

