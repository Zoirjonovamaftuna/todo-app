<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SharedTodoListController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\TodoListController;
use Illuminate\Support\Facades\Route;

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
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});

Route::prefix('todo-lists')
    ->middleware('auth:api')
    ->group(function () {
        Route::get('/', [TodoListController::class, 'index']);
        Route::post('/', [TodoListController::class, 'store']);
        Route::get('/{todo_list_id}', [TodoListController::class, 'show']);
        Route::put('/{todo_list_id}', [TodoListController::class, 'edit']);
        Route::delete('/{todo_list_id}', [TodoListController::class, 'delete']);

        Route::post('/{todo_list_id}/todo', [TodoController::class, 'store']);
        Route::put('/{todo_list_id}/todo/{todo_id}', [TodoController::class, 'edit']);
        Route::delete('/{todo_list_id}/todo/{todo_id}', [TodoController::class, 'delete']);

        Route::get('/shared-to', [SharedTodoListController::class, 'getSharedTo']);
        Route::get('/shared-from', [SharedTodoListController::class, 'getSharedFrom']);
        Route::post('/{todo_list_id}/share', [SharedTodoListController::class, 'share']);
    });
