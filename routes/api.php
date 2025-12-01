<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\VisitLogController;
use App\Http\Middleware\JwtMiddleware;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'auth',
], function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::middleware([JwtMiddleware::class])->group(function () {
        Route::get('user', [AuthController::class, 'me']);
        Route::post('logout', [AuthController::class, 'logout']);
    });
});

Route::group([
    'prefix' => 'user',
    'middleware' => [JwtMiddleware::class]
], function () {
    Route::get('getAll',  [UsersController::class, 'getAll']);
    Route::post('store', [UsersController::class, 'store']);
    Route::post('update/{id}',  [UsersController::class, 'update']);
    Route::get('get/{id}',   [UsersController::class, 'get']);
    Route::post('delete/{id}', [UsersController::class, 'delete']);
});
Route::group([
    'prefix' => 'order',
    'middleware' => [JwtMiddleware::class]
], function () {
    Route::get('getAll',  [OrdersController::class, 'getAll']);
    Route::post('update',  [OrdersController::class, 'update']);
    Route::post('delete',  [OrdersController::class, 'delete']);
    Route::get('get',   [OrdersController::class, 'get']);
    Route::get('filter',   [OrdersController::class, 'filter']);

});
Route::get('/visit-logs', [VisitLogController::class, 'getReviewStats']);

Route::post('/feedback-email', [FeedbackController::class, 'feedbackEmail']);

