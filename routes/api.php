<?php

use App\Http\Controllers\API\APIAdminController;
use App\Http\Controllers\API\APIPostController;
use App\Http\Controllers\API\APITypeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'types', 'middleware' => 'auth:sanctum'], function () {
    Route::get('get', [APITypeController::class, 'index']);
    Route::get('show', [APITypeController::class, 'show']);
    Route::post('create', [APITypeController::class, 'create']);
    Route::post('update', [APITypeController::class, 'update']);
    Route::post('delete', [APITypeController::class, 'delete']);
});

Route::group(['prefix' => 'posts', 'middleware' => 'auth:sanctum'], function () {
    Route::get('get', [APIPostController::class, 'index']);
    Route::get('show', [APIPostController::class, 'show']);
    Route::post('create', [APIPostController::class, 'create']);
    Route::post('update', [APIPostController::class, 'update']);
    Route::post('delete', [APIPostController::class, 'delete']);
});

Route::group(['prefix' => 'admin'], function () {
    Route::post('Login', [APIAdminController::class, 'postLogin']);
    Route::post('Logout', [APIAdminController::class, 'logout']);
});

Route::group(['prefix' => 'user'], function () {
    Route::post('register', [\App\Http\Controllers\Auth\UserController::class, 'register']);
    Route::post('login', [\App\Http\Controllers\Auth\UserController::class, 'login']);
    Route::post('logout', [\App\Http\Controllers\Auth\UserController::class, 'logout'])->middleware('auth:sanctum');

});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

