<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\RankingController;
use App\Http\Controllers\API\PageController;

Route::get('/ranking/player', [RankingController::class, 'player']);
Route::get('/ranking/guild', [RankingController::class, 'guild']);
Route::get('/ranking/unique', [RankingController::class, 'unique']);
Route::get('/ranking/level', [RankingController::class, 'level']);
Route::get('/ranking/fortress-player', [RankingController::class, 'fortress_player']);
Route::get('/ranking/fortress-guild', [RankingController::class, 'fortress_guild']);

Route::get('/timers', [PageController::class, 'timers']);
Route::get('/uniques', [PageController::class, 'uniques']);

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
