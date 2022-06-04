<?php

use App\Http\Controllers\API\AuthBaseController;
use App\Http\Controllers\API\homeController;
use App\Http\Controllers\API\quizController;
use App\Http\Controllers\API\responseAnswerController;
use App\Http\Controllers\API\responseController;
use App\Http\Controllers\API\UserApiAuthController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
