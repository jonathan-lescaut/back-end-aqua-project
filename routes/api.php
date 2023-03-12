<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\LivingController;
use App\Http\Controllers\API\OpinionController;
use App\Http\Controllers\API\ProjectController;
use App\Http\Controllers\API\MaterialController;
use App\Http\Controllers\API\DecorationController;
use App\Http\Controllers\API\CategorieLivingController;
use App\Http\Controllers\API\CategorieMaterialController;
use App\Http\Controllers\API\CategorieDecorationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
    Route::get('current-user', 'currentUser');
});

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::middleware('CheckRole')->group(function () {
// });


Route::middleware('CheckRole')->group(function () {
    Route::apiResource("users", UserController::class);
    Route::apiResource('categorie_decoration', CategorieDecorationController::class);
    Route::apiResource('categorie_living', CategorieLivingController::class);
    Route::apiResource('categorie_material', CategorieMaterialController::class);
    Route::apiResource('living', LivingController::class);
    Route::apiResource('decoration', DecorationController::class);
    Route::apiResource('material', MaterialController::class);
    Route::apiResource('opinion', OpinionController::class);
});
Route::apiResource('project', ProjectController::class);
Route::get('project/user/{user}', [ProjectController::class, 'indexUser'])->name('indexUser');
Route::get('decoration/categorie/{categorie_decoration}', [DecorationController::class, 'indexCategorie'])->name('indexCategorie');
