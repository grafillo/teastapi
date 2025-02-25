<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('/tasks', [ApiController::class, 'getTasks']);
Route::get('/task/{task}', [ApiController::class, 'showTask']);


Route::group([
    'middleware' => 'auth',
], function ($router) {
    Route::post('/task', [ApiController::class, 'createTask']);
    Route::patch('/update/{task}', [ApiController::class, 'updateTask']);
    Route::delete('/delete/{task}', [ApiController::class, 'deleteTask']);
});


Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [AuthController::class,'login']);
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});
