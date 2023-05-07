<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\v1\ElectionController;

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

Route::prefix('v1')->group(function () {
    Route::controller(ElectionController::class)->group(function () {
        Route::get('/index', 'index');
        Route::post('/email', 'checkEmail');
        Route::get('/confirm', 'confirmAccount');
        Route::get('/getaccount', 'getAccount');
    });
});
