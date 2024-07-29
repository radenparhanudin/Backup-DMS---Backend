<?php

use App\Facades\ResponseJson;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;

Route::fallback(function (Request $request) {
    if ($request->is('api/*')) {
        return ResponseJson::error(
            message: 'Halaman tidak ditemukan!',
            code: Response::HTTP_NOT_FOUND
        );
    } else {
        return view('fallback');
    }
});
