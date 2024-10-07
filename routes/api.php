<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



//for storing data in the contacts table
Route::post('/contact', [ContactController::class, 'store']);
//for fetching data in the contacts table
Route::get('/contacts', [ContactController::class, 'index']);
//for updating the data in the contacts table
Route::put('/contact/{id}', [ContactController::class, 'update']);
//for deleting the data in the contacts table
Route::delete('/contact/{id}', [ContactController::class, 'destroy']);
