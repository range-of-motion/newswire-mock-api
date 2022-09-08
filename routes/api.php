<?php

use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\OutletController;
use App\Http\Controllers\Api\PersonController;
use App\Http\Controllers\Api\PopularMediaTypeController;
use App\Http\Controllers\Api\PopularOutletController;
use App\Http\Controllers\Api\PopularRoleController;
use App\Http\Controllers\Api\PopularTopicController;
use App\Http\Controllers\Api\SearchController;
use App\Http\Controllers\PerformSearchController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/search', PerformSearchController::class);
Route::get('/searches/recent', [SearchController::class, 'recent']);
Route::get('/searches/saved', [SearchController::class, 'saved']);

Route::get('/people/{id}', [PersonController::class, 'show']);

Route::get('/articles/{id}', [ArticleController::class, 'show']);

Route::get('/outlets/{id}', [OutletController::class, 'show']);

Route::get('/popular-media-types', [PopularMediaTypeController::class, 'index']);
Route::get('/popular-outlets', [PopularOutletController::class, 'index']);
Route::get('/popular-roles', [PopularRoleController::class, 'index']);
Route::get('/popular-topics', [PopularTopicController::class, 'index']);
