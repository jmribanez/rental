<?php

use App\Http\Controllers\ContractController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\UtilityController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Auth::routes(['register' => false, 'reset' => false]);

Route::resource('user', UserController::class);
Route::resource('property', PropertyController::class);
Route::resource('utility', UtilityController::class);
Route::resource('property.contract',ContractController::class)->shallow();
Route::resource('payment', PaymentController::class);
Route::post('/property/{id}/setUtility',[PropertyController::class, 'setUtility'])->name('property.setUtility');
Route::post('/property/{id}/unsetUtility',[PropertyController::class, 'unsetUtility'])->name('property.unsetUtility');
Route::get('tenant', [TenantController::class, 'index'])->name('tenant.index');
Route::get('tenant/{tenant}', [TenantController::class, 'show'])->name('tenant.show');
Route::get('tenant/{tenant}/contracts', [TenantController::class, 'listContracts'])->name('tenant.contracts');
Route::get('property/{property}/newpayment', [PropertyController::class, 'newPayment'])->name('property.newPayment');
Route::post('user/{id}/changepassword', [UserController::class, 'changePassword'])->name('user.changepassword');
Route::post('profile/changePassword', [UserController::class, 'selfChangePassword'])->name('user.selfchangepassword');
Route::get('profile', [UserController::class, 'showProfile'])->name('profile');
Route::get('report/{year}/{month}', [HomeController::class, 'report'])->whereNumber('year')->whereNumber('month')->name('report');