<?php

use Illuminate\Support\Facades\Route;

Route::get('theme', function () {
    return view('theme');
});


Route::get('/', [\App\Http\Controllers\AdminController::class, 'index'])->middleware('guest')->name('login');
Route::post('post-login', [\App\Http\Controllers\AdminController::class, 'postLogin'])->name('login.post');
Route::get('logout', [\App\Http\Controllers\AdminController::class, 'logout']);


Route::group(['prefix' => 'posts', 'middleware' => 'auth:admin'], function () {
    Route::get('add', [\App\Http\Controllers\PostController::class, 'create'])->name('add.post');
    Route::post('fetchType', [\App\Http\Controllers\PostController::class, 'fetchType']);
    Route::post('store', [\App\Http\Controllers\PostController::class, 'store'])->name('store.post');
    Route::post('delete', [\App\Http\Controllers\PostController::class, 'delete'])->name('delete.posts');
    Route::get('edit/{id}', [\App\Http\Controllers\PostController::class, 'edit']);
    Route::post('update/{id}', [\App\Http\Controllers\PostController::class, 'update']);
    Route::get('photos/{id}', [\App\Http\Controllers\PhotoController::class, 'index']); //
    Route::get('view', [\App\Http\Controllers\PostController::class, 'viewpost'])->name('view.post');
});


Route::group(['prefix' => 'types', 'middleware' => 'auth:admin'], function () {
    Route::get('add', [\App\Http\Controllers\TypeController::class, 'index']);
    Route::post('store', [\App\Http\Controllers\TypeController::class, 'store']);
    Route::get('delete/{id}', [\App\Http\Controllers\TypeController::class, 'delete']);
    Route::get('edit/{id}', [\App\Http\Controllers\TypeController::class, 'edit']);
    Route::post('update/{id}', [\App\Http\Controllers\TypeController::class, 'update']);
    Route::get('view', [\App\Http\Controllers\TypeController::class, 'getTypes'])->name('get.Type');
});

///////////////////////// Ajax routes ////////////////////
//Route::get('viewtype', [\App\Http\Controllers\APIController::class, 'getTypes'])->name('ggetType');


/////////////////////////Dropzone routes ///////////////////
Route::get('addphoto/{id}', [\App\Http\Controllers\PhotoController::class, 'index']);
Route::get('getphoto/{id}', [\App\Http\Controllers\PhotoController::class, 'getPhotos'])->name('get.photo');
Route::post('storePhoto/{id}', [\App\Http\Controllers\PhotoController::class, 'store'])->name('store.photo');
Route::post('destroy', [\App\Http\Controllers\PhotoController::class, 'destroy']);



