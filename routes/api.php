<?php

use App\Http\Controllers\PostingController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SkillController;
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

Route::get('/postings', [PostingController::class, 'index']);

Route::get('/skills', [SkillController::class, 'index']);

Route::post('/search', [SearchController::class, 'store']);
Route::get('/search/{search}', [SearchController::class, 'results']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
