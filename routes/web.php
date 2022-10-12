<?php

use Illuminate\Support\Facades\Route;

Route::get('theme', function (){
    return view('theme');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('', [\App\Http\Controllers\AdminController::class, 'index'])->middleware('guest');
Route::post('post-login', [\App\Http\Controllers\AdminController::class, 'postLogin'])->name('login.post');

//Route::get('logout', [\App\Http\Controllers\AdminController::class, 'logout']);

Route::get('viewpost',[\App\Http\Controllers\PostController::class , 'viewpost']);

Route::group(['prefix' => 'posts'],function (){
    Route::get('add',[\App\Http\Controllers\PostController::class, 'addpost']);
    Route::post('store',[\App\Http\Controllers\PostController::class,'store']);
    Route::get('delete/{id}', [\App\Http\Controllers\PostController::class , 'delete']);
    Route::get('edit/{id}', [\App\Http\Controllers\PostController::class , 'edit']);
    Route::post('update/{id}', [\App\Http\Controllers\PostController::class , 'update']);
});

Route::group(['prefix' => 'types'],function (){
    Route::get('add',[\App\Http\Controllers\TypeController::class, 'addtype']);
    Route::post('store', [\App\Http\Controllers\TypeController::class, 'store']);
});



