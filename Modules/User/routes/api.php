<?php

use Illuminate\Support\Facades\Route;
use Modules\User\App\Http\Controllers\UserController;

Route::name('user.')
    ->prefix('user')
    ->middleware('auth:sanctum')
    ->controller(UserController::class)
    ->group(function () {
        Route::get('/profile', 'profile')->name('profile');
        Route::get('/roles', 'roles')->name('roles');
    });
