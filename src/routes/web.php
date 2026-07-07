<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WeightController;

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

Route::post('/register/step1', [UserController::class, 'storeUser']);
Route::post('/register/step2', [WeightController::class, 'storeWeight']);
Route::post('/login', [UserController::class, 'loginUser']);
Route::middleware('auth')->group(function(){
    Route::get('/weight_logs', [WeightController::class, 'admin']);
    Route::get('/register/step2', [WeightController::class, 'weight']);
    Route::get('/weight_logs/goal_setting', [WeightController::class, 'goalSetting']);
    Route::patch('/weight_logs/goal_setting', [WeightController::class, 'goalUpdate']);
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy']);
    Route::get('/weight_logs/search', [WeightController::class, 'search']);
    Route::post('/weight_logs/create',[WeightController::class, 'store']);
    Route::get('/weight_logs/{weightLogId}', [WeightController::class, 'detail']);
    Route::patch('/weight_logs/{weightLogId}/update', [WeightController::class, 'update']);
    Route::delete('/weight_logs/{weightLogId}/delete', [WeightController::class, 'destroy']);
});