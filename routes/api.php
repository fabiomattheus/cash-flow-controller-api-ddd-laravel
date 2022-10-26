<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Presentation\Controllers\Api\HelpApiController;
use Presentation\Controllers\Api\HelpRequestApiController;

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



Route::prefix('v1')->namespace('api')->group(function () {
    Route::post('/help/create', [HelpApiController::class, 'create'])->name('api.help.create');
    Route::get('/help/find/{id}', [HelpApiController::class, 'getById'])->name('api.help.find');
    Route::get('/help/find-by-type/{type}', [HelpApiController::class, 'getByType'])->name('api.help.find_by_type');
    Route::put('/help/update', [HelpApiController::class, 'update'])->name('api.help.update');
    Route::delete('/help/destroy', [HelpApiController::class, 'destroy'])->name('api.help.destroy');
});


Route::prefix('v1')->namespace('api')->group(function () {
    Route::post('/help-request/create', [HelpRequestApiController::class, 'create'])->name('api.helpRequest.create');
    Route::get('/help-request/find/{id}', [HelpRequestApiController::class, 'getById'])->name('api.helpRequest.find');

});
