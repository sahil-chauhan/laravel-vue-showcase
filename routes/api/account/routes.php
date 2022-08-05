<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AccountsController;

Route::group(['prefix' => 'accounts','middleware' =>'auth:sanctum'],function () {
	Route::post('/all',[AccountsController::class,'get_all_accounts']);   
});