<?php

use Illuminate\Support\Facades\Route;
use Modules\Document\App\Http\Controllers\DocumentController;

Route::name('documents.')
    ->prefix('documents')
    ->middleware('auth:sanctum')
    ->controller(DocumentController::class)
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/sync', 'syncGet')->name('sync-get');
        Route::post('/sync', 'syncPost')->name('sync-post');
        Route::post('/sync-file', 'syncFile')->name('sync-file');
        Route::get('/metadata/{document_id}', 'metadata')->name('metadata');
        Route::get('/file/{document_id}', 'file')->name('file');
    });
