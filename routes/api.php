<?php

use Illuminate\Support\Facades\Route;


Route::get('/unauthorized', function () {
    return response()->json(['message' => 'Unauthorized']);
})->name('login');
