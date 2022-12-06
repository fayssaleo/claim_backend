<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Modules\Estimate\Http\Controllers\EstimateController;

Route::group([
    'middleware' => 'auth:sanctum',
    'prefix' => 'api/estimates'

], function ($router) {
    Route::get('/indexEquipment', [EstimateController::class, 'indexEquipment']);
    Route::get('/indexContainer', [EstimateController::class, 'indexContainer']);
    Route::get('/indexAutomobile', [EstimateController::class, 'indexAutomobile']);
    Route::get('/{id}', [EstimateController::class, 'get']);
    Route::post('/create', [EstimateController::class, 'create']);
    Route::post('/update', [EstimateController::class, 'update']);
    Route::post('/delete', [EstimateController::class, 'delete']);
    Route::get('/file/sendEstimateFileStoragePath', [EstimateController::class, 'sendEstimateFileStoragePath']);
    Route::post('/file/Addfile', [EstimateController::class, 'Addfile']);
    Route::post('/file/delete', [EstimateController::class, 'deleteFile']);
});
