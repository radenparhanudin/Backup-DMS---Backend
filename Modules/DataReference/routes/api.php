<?php

use Illuminate\Support\Facades\Route;
use Modules\DataReference\App\Http\Controllers\DocumentStatusController;
use Modules\DataReference\App\Http\Controllers\DocumentTypeController;
use Modules\DataReference\App\Http\Controllers\UnitOrganisasiController;

Route::name('data-reference.')
    ->prefix('data-reference')
    ->middleware('auth:sanctum')
    ->group(function () {
        /* Document Type */
        Route::name('document-types.')
            ->prefix('document-types')
            ->controller(DocumentTypeController::class)
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::post('/', 'sync')->name('sync');
                Route::get('/search', 'search')->name('search');
            });

        /* Document Status */
        Route::name('document-statuses.')
            ->prefix('document-statuses')
            ->controller(DocumentStatusController::class)
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::post('/', 'sync')->name('sync');
                Route::get('/search', 'search')->name('search');
            });

        /* Unit Organisasi */
        Route::name('unit-organisasis.')
            ->prefix('unit-organisasis')
            ->controller(UnitOrganisasiController::class)
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::post('/', 'sync')->name('sync');
            });
    });
