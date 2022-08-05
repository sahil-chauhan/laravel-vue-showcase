<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[HomeController::class,'index'])->name('vue.home');

// require __DIR__.'/socialite/routes.php';
require __DIR__.'/admin/routes.php';



Route::get('/{any}',[HomeController::class,'indexCheck'])->where('any', '.*')->name('vue');