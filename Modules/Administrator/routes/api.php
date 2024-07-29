<?php

use Illuminate\Support\Facades\Route;
use Modules\Administrator\App\Http\Controllers\UserController;

Route::name('administrator.')
    ->prefix('administrator')
    ->middleware('auth:sanctum')
    ->group(function () {
        /* User */
        Route::name('users.')
            ->prefix('users')
            ->controller(UserController::class)
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::post('/', 'sync')->name('sync');
                Route::put('/', 'update')->name('update');
            });
    });
