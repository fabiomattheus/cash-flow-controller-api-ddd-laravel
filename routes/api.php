<?php

use Illuminate\Support\Facades\Route;
use Presentation\Controllers\Api\CashFlow\AddCashFlowApiController;
use Presentation\Controllers\Api\CashFlow\DeleteCashFlowApiController;
use Presentation\Controllers\Api\CashFlow\FindCashFlowByIdApiController;
use Presentation\Controllers\Api\CashFlow\UpdateCashFlowApiController;
use Presentation\Controllers\Api\CashFlow\FindAllCashFlowsByDateApiController;

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
    Route::post('/cash-flow/add', [AddCashFlowApiController::class, 'add'])->name('api.cash.flow.create');
    Route::get('/cash-flow/find/{id}', [FindCashFlowByIdApiController::class, 'findById'])->name('api.cash.flow.find.by.id');
    Route::put('/cash-flow/update', [UpdateCashFlowApiController::class, 'update'])->name('api.cash.flow.update');
    Route::delete('/cash-flow/delete', [DeleteCashFlowApiController::class, 'delete'])->name('api.cash.flow.destroy');
    Route::get('/cash-flow/find-all-by-date/{initialDate}/{type}/{page}/{finalDate?}', [FindAllCashFlowsByDateApiController::class, 'findAllByDate'])->name('api.cash.flow.find.all.by.date');
});
