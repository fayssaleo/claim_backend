<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Modules\Vessel\Http\Controllers\VesselController;

Route::group([
    'middleware' => 'auth:sanctum',
    'prefix' => 'api/containers'

], function ($router) {
    Route::post('/createOrUpdateVessel', [VesselController::class, 'createOrUpdateVessel']);
    Route::get('/allClaim', [VesselController::class, 'allClaim']);
    Route::get('/allIncident', [VesselController::class, 'allIncident']);


});
