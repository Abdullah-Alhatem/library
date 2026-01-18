<?php

use App\Http\Controllers\Api\AuthorController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\BookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

/** api/test */
Route::get('test' , function(){
    return "I am for test only";
});
Route::get('test/{x}' , function($x1){
    return "I am for test only: $x1";
});

// Category Routes
// Route::get('categories' , ['App\Http\Controllers\Api\CategoryController' , 'index']);
Route::get('categories' , [CategoryController::class,  'index']);
Route::post('categories' , [CategoryController::class,  'store']);
Route::put('categories/{identifier}' , [CategoryController::class,  'update']);
Route::delete('categories/{id}' , [CategoryController::class,  'destroy']);

// Author Routes
Route::get('authors', [AuthorController::class, 'index']);
Route::post('authors', [AuthorController::class, 'store']);
Route::put('authors/{id}', [AuthorController::class, 'update']);
Route::delete('authors/{id}', [AuthorController::class, 'destroy']);

// Book Routes
// Route::apiResource('books' , BookController::class)->except('show');
// Route::apiResource('books' , BookController::class)->only('index' ,'show');
Route::apiResource('books' , BookController::class);


/** **************** test routes ***************/
Route::get('env' , function(){
    return env('APP_NAME' , 'not found');
});

Route::get('config' , function(){
    return config('app.name' , 'not found');
});
Route::get('public-path' , function(){
    return storage_path('app/public');
});
