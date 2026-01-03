<?php

use App\Http\Controllers\Api\CategoryController;
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

// Route::get('categories' , ['App\Http\Controllers\Api\CategoryController' , 'index']);
Route::get('categories' , [CategoryController::class,  'index']);
Route::post('categories' , [CategoryController::class,  'store']);
Route::put('categories/{identifier}' , [CategoryController::class,  'update']);
Route::delete('categories/{id}' , [CategoryController::class,  'destroy']);
