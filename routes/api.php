<?php

use App\Http\Controllers\JwtAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NameValidationController;
use App\Http\Controllers\QueryController;

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

Route::post('login', [JwtAuthController::class, 'login']);
Route::post('register', [JwtAuthController::class, 'register']);

Route::group(['middleware' => ['jwt.verify']], function() {
    // Route::get('logout', [ApiController::class, 'logout']);

    Route::post("/validate", [NameValidationController::class, 'index']);

    Route::get("/logs/{uuid}", [QueryController::class, 'show']);
});





