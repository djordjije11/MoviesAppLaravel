<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ReviewerController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('reviewer', [ReviewerController::class, 'index']);
Route::get('reviewer/{id}', [ReviewerController::class, 'show']);
Route::get('movie', [MovieController::class, 'index']);
Route::get('movie/{id}', [MovieController::class, 'show']);
Route::get('review', [ReviewController::class, 'index']);
Route::get('review/{id}', [ReviewController::class, 'show']);
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::post('logout', [AuthController::class, 'logout']);
    Route::delete('reviewer/{id}', [ReviewerController::class,'destroy']);
    Route::delete('movie/{id}', [MovieController::class,'destroy']);
    Route::delete('review/{id}', [ReviewController::class,'destroy']);
    Route::post('movie', [MovieController::class,'store']);
    Route::post('reviewer', [ReviewerController::class,'store']);
    Route::post('review', [ReviewController::class,'store']);
    Route::put('movie/{id}', [MovieController::class, 'update']);
    Route::put('reviewer/{id}', [ReviewerController::class, 'update']);
});
