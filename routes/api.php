<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ReplyController;
use Illuminate\Support\Facades\Route;


Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/logout', [AuthController::class, 'logout']);


Route::apiResource('/questions', QuestionController::class);
Route::apiResource('/categories', CategoryController::class);
Route::apiResource('/questions/{question}/replies', ReplyController::class);

Route::post('/like/{reply}', [LikeController::class, 'like']);
Route::delete('/like/{reply}', [LikeController::class, 'unlike']);
