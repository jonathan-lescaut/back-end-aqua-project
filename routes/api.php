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

Route::controller(MaterialController::class)->group(function () {
    Route::get('material/categoriekit', 'indexCategorieIncludeKit')->name('indexCategorieIncludeKit');
});

Route::apiResource("users", UserController::class);
Route::apiResource('categorie_decoration', CategorieDecorationController::class);
Route::apiResource('categorie_living', CategorieLivingController::class);
Route::apiResource('categorie_material', CategorieMaterialController::class);
Route::apiResource('opinion', OpinionController::class);
Route::apiResource('living', LivingController::class);
Route::apiResource('material', MaterialController::class);
Route::apiResource('decoration', DecorationController::class);

Route::controller(DecorationController::class)->group(function () {
    Route::get('decoration', 'index');
    Route::post('decoration', 'store')->middleware('CheckRole');
    Route::get('decoration/{decoration}', 'show')->middleware('CheckRole');
    Route::post('decoration/{decoration}', 'update')->middleware('CheckRole');
    Route::delete('decoration/{decoration}', 'destroy')->middleware('CheckRole');
});

Route::controller(MaterialController::class)->group(function () {
    Route::get('material', 'index');
    Route::post('material', 'store')->middleware('CheckRole');
    Route::get('material/{material}', 'show')->middleware('CheckRole');
    Route::post('material/{material}', 'update')->middleware('CheckRole');
    Route::delete('material/{material}', 'destroy')->middleware('CheckRole');
});

Route::controller(LivingController::class)->group(function () {
    Route::get('living', 'index');
    Route::post('living', 'store')->middleware('CheckRole');
    Route::get('living/{living}', 'show')->middleware('CheckRole');
    Route::post('living/{living}', 'update')->middleware('CheckRole');
    Route::delete('living/{living}', 'destroy')->middleware('CheckRole');
});

// Route::middleware(['auth'])->group(function () {
//     Route::get('project/user/{user}', [ProjectController::class, 'indexUser'])->name('indexUser');
// });
// Route::get('project/user/{user}', function ($user) {
//     return response()->json(['data' => '...'])->header('Access-Control-Allow-Origin', '*');
// })->middleware(\Fruitcake\Cors\HandleCors::class);

// Route::apiResource('project', ProjectController::class);
Route::middleware('auth:api')->apiResource('project', ProjectController::class);

Route::post('project', [ProjectController::class, 'store'])->name('storeProject')->middleware(\Fruitcake\Cors\HandleCors::class);
// Route::get('project/user/{user}', [ProjectController::class, 'indexUser'])->name('indexUser');


Route::get('project/user/{user}', [ProjectController::class, 'indexUser'])->middleware(\Fruitcake\Cors\HandleCors::class);
Route::get('project/living/{project}', [ProjectController::class, 'indexLiving'])->name('indexLiving')->middleware(\Fruitcake\Cors\HandleCors::class);
Route::get('project/material/{project}', [ProjectController::class, 'indexMaterial'])->name('indexMaterial')->middleware(\Fruitcake\Cors\HandleCors::class);
Route::get('project/decoration/{project}', [ProjectController::class, 'indexDecoration'])->name('indexDecoration')->middleware(\Fruitcake\Cors\HandleCors::class);
Route::delete('project/{project}/living/{living}', [ProjectController::class, 'destroyLiving'])->name('destroyLiving')->middleware(\Fruitcake\Cors\HandleCors::class);
Route::delete('project/{project}/material/{material}', [ProjectController::class, 'destroyMaterial'])->name('destroyMaterial')->middleware(\Fruitcake\Cors\HandleCors::class);
Route::delete('project/{project}/decoration/{decoration}', [ProjectController::class, 'destroyDecoration'])->name('destroyDecoration')->middleware(\Fruitcake\Cors\HandleCors::class);
Route::put('project/{project}/living/{living}/quantity', [ProjectController::class, 'updateLivingQuantity'])->name('updateLivingQuantity')->middleware(\Fruitcake\Cors\HandleCors::class);
Route::put('project/{project}/material/{material}/quantity', [ProjectController::class, 'updateMaterialQuantity'])->name('updateMaterialQuantity')->middleware(\Fruitcake\Cors\HandleCors::class);
Route::put('project/{project}/decoration/{decoration}/quantity', [ProjectController::class, 'updateDecorationQuantity'])->name('updateDecorationQuantity')->middleware(\Fruitcake\Cors\HandleCors::class);


Route::get('decoration/categorie/{categorie_decoration}', [DecorationController::class, 'indexCategorie'])->name('indexCategorie')->middleware(\Fruitcake\Cors\HandleCors::class);
Route::get('material/categorie/{categorie_material}', [MaterialController::class, 'indexCategorie'])->name('indexCategorie')->middleware(\Fruitcake\Cors\HandleCors::class);
Route::get('living/categorie/{categorie_living}', [LivingController::class, 'indexCategorie'])->name('indexCategorie')->middleware(\Fruitcake\Cors\HandleCors::class);
