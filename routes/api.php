<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\servicesController;
use App\Http\Controllers\clientsController;
use App\Http\Controllers\datingController;
use App\Http\Controllers\detailQuotesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::post('register', [authController::class, 'register']);
Route::post('login',[authController::class, 'login']);


Route::middleware(['auth:sanctum'])->group(function(){
    //crud servicios
    Route::get('services',[servicesController::class, 'index']);
    Route::post('services',[servicesController::class, 'store']);
    Route::get('service/{id}',[servicesController::class, 'show']);
    Route::delete('service/{id}',[servicesController::class, 'destroy']);
    Route::put('service/{id}', [servicesController::class, 'update']);

    //crud clientes
    Route::get('clients',[clientsController::class, 'index']);
    Route::post('clients',[clientsController::class, 'store']);
    Route::get('clients/{id}',[clientsController::class, 'show']);
    Route::delete('clients/{id}',[clientsController::class, 'destroy']);
    Route::put('clients/{id}',[clientsController::class, 'update']);

    //crud datings
    Route::get('dating', [datingController::class, 'index']);
    Route::post('dating', [datingController::class, 'store']);
    Route::get('dating/{id}', [datingController::class, 'show']);
    Route::put('dating/{id}', [datingController::class, 'update']);
    Route::delete('dating/{id}', [datingController::class, 'destroy']);
    Route::post('detail', [detailQuotesController::class, 'store']);
    Route::get('logout',[authController::class, 'logout']);


});
