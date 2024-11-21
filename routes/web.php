<?php

use App\Http\Controllers\ContractController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\UtilityController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Auth::routes(['register' => false]);

Route::resource('user', UserController::class);
Route::resource('property', PropertyController::class);
Route::resource('utility', UtilityController::class);
Route::resource('property.contract',ContractController::class)->shallow();
Route::post('/property/{id}/setUtility',[PropertyController::class, 'setUtility'])->name('property.setUtility');
Route::post('/property/{id}/unsetUtility',[PropertyController::class, 'unsetUtility'])->name('property.unsetUtility');
