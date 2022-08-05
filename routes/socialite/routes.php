<?php

use Illuminate\Support\Facades\Route;

use Laravel\Socialite\Facades\Socialite;

use App\Http\Controllers\Socialite\AuthSocialite;


Route::group([ 'prefix' => 'auth' ],function(){
    
    Route::get('login/github/redirect',[AuthSocialite::class,'github_redirect_login'])->name('auth.github.login');
    Route::get('register/github/redirect',[AuthSocialite::class,'github_redirect_register'])->name('auth.github.register');
    Route::get('/github/callback',[AuthSocialite::class,'github_callback']);

});
