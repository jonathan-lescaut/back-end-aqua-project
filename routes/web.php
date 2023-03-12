<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LivingController;
use App\Http\Controllers\OpinionController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\ParameterController;
use App\Http\Controllers\DecorationController;
use App\Http\Controllers\CategorieLivingController;
use App\Http\Controllers\CategorieMaterialController;
use App\Http\Controllers\CategorieDecorationController;

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

Route::get('/', function () {
    return view('welcome');
});
