<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Modules\Automobile\Http\Controllers\AutomobileController;


Route::group([
    'middleware' => 'auth:sanctum',
    'prefix' => 'api/automobiles'

], function ($router) {
    Route::post('/createOrUpdateAutomobile', [EquipmentController::class, 'createOrUpdateAutomobile']);

});
