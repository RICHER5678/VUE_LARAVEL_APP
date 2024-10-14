<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OrganisationController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\GroupController;

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
//for handling the imports in the contacs tables
Route::post('/import-contacts', [ContactController::class, 'import']);




                       //AP1 ORGANISATIONS
//for storing data in the organisations tables
Route::post('/organisation', [OrganisationController::class, 'store']);
//for fetching data in the organisations tables
Route::get('/organisations', [OrganisationController::class, 'index']);
//for updating the data in the organisations table
Route::put('/organisation/{id}', [OrganisationController::class, 'update']);
//for deleting the data in the organisation table
Route::delete('/organisation/{id}', [OrganisationController::class, 'destroy']);



                       //AP1 DEPARTMENTS
//for storing data in the departments tables
Route::post('/department', [DepartmentController::class, 'store']);
//for fetching data in the departments tables
Route::get('/departments', [DepartmentController::class, 'index']);
//for updating the data in the departments tables
Route::put('/department/{id}', [DepartmentController::class, 'update']);
//for deleting the data in the departments tables
Route::delete('/department/{id}', [DepartmentController::class, 'destroy']);


                       //AP1 GROUPS
//for storing data in the groups tables
Route::post('/group', [GroupController::class, 'store']);
//for fetching data in the groups tables
Route::get('/groups', [GroupController::class, 'index']);
//for updating the data in the groups tables
Route::put('/group/{id}', [GroupController::class, 'update']);
//for deleting the data in the groups tables
Route::delete('/group/{id}', [GroupController::class, 'destroy']);
