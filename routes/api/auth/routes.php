<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;

Route::group(['prefix' => 'auth'],function () {
	Route::post('/register',[AuthController::class,'register']);      
	Route::post('/login',[AuthController::class,'login']);      
	Route::post('/logout',[AuthController::class,'logout']);     
	Route::post('/forgot-password',[AuthController::class,'sendResetLinkEmail']);
	Route::post('/reset-password',[AuthController::class,'submitResetPasswordForm']);
	Route::post('/social/login/callback',[AuthController::class,'socialLogin']);
	Route::post('/social/register/callback',[AuthController::class,'socialRegister']);
});