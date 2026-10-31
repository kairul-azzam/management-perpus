<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BukuApiController;
use App\Http\Controllers\Api\SiswaApiController;
use App\Http\Controllers\Api\AuthApiController;
use Illuminate\Http\Request;

Route::get('/test', function () {
    return response()->json([
        'success' => true,
        'message' => 'API Management Perpus berhasil!'
    ]);
});

Route::get('/buku', [BukuApiController::class, 'index']);
Route::get('/buku/{id}', [BukuApiController::class, 'show']);


Route::get('/siswa', [SiswaApiController::class, 'index']);
Route::get('/siswa/{id}', [SiswaApiController::class, 'show']);
Route::post('/siswa', [SiswaApiController::class, 'store']);

Route::post('/register', [AuthApiController::class, 'register']);
Route::post('/login', [AuthApiController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/buku', [BukuApiController::class, 'store']);
    Route::put('/buku/{id}', [BukuApiController::class, 'update']);
    Route::delete('/buku/{id}', [BukuApiController::class, 'destroy']);
});