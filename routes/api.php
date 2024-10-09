<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OrganisationController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


                        //AP1 CONTACTS
//for storing data in the contacts table
Route::post('/contact', [ContactController::class, 'store']);
//for fetching data in the contacts table
Route::get('/contacts', [ContactController::class, 'index']);
//for updating the data in the contacts table
Route::put('/contact/{id}', [ContactController::class, 'update']);
//for deleting the data in the contacts table
Route::delete('/contact/{id}', [ContactController::class, 'destroy']);
//for handling the imports
Route::post('/import-contacts', [ContactController::class, 'import']);




                       //AP1 ORGANISATIONS
//for storing data in the contacts table
Route::post('/organisation', [OrganisationController::class, 'store']);
//for fetching data in the contacts table
Route::get('/organisations', [OrganisationController::class, 'index']);
//for updating the data in the contacts table
Route::put('/organisation/{id}', [OrganisationController::class, 'update']);
//for deleting the data in the contacts table
Route::delete('/organisation/{id}', [OrganisationController::class, 'destroy']);
