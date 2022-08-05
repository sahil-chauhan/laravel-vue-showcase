<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\LicenseController;
use App\Http\Controllers\Admin\ActivationController;


Route::group(['prefix' => 'admin','middleware' => ['auth','admin'] ], function () {

    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::resource('users', UserController::class);
    Route::resource('accounts', AccountController::class);
    Route::resource('products', ProductController::class);
    Route::resource('coupons', CouponController::class);
    
    Route::group([ 'prefix' => 'licenses' ],function(){
        Route::resource('{license}/activations', ActivationController::class);
    });

    Route::resource('licenses', LicenseController::class);

        
    
});
