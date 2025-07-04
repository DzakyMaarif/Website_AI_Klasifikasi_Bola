<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BallClassifierController;

Route::get('/', [BallClassifierController::class, 'index']);
Route::post('/predict', [BallClassifierController::class, 'predict'])->name('predict');