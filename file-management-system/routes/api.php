<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\FolderController;
use App\Http\Controllers\Api\FileController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/folder/create', [FolderController::class, 'create']);
Route::get('/folder/edit/{id}', [FolderController::class, 'edit']);
Route::post('/folder/edit/{id}', [FolderController::class, 'update']);
Route::get('/folder/delete/{id}', [FolderController::class, 'delete']);

Route::get('/home/get-data', [HomeController::class, 'getDataHome']);

Route::get('/file/get-data/{id}', [FileController::class, 'getData']);
Route::post('/file/upload/{id}', [FileController::class, 'upload']);
Route::get('/file/download/{id}', [FileController::class, 'download']);
Route::get('/file/delete/{id}', [FileController::class, 'delete']);
Route::post('/file/search/', [FileController::class, 'search']);

