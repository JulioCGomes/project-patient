<?php

use App\Http\Controllers\Api\AddressController;
use Illuminate\Support\Facades\Route;

Route::controller(AddressController::class)
    ->prefix('address')
    ->group(function() {
        Route::get('/', 'index');
        Route::post('/', 'create');
        Route::put('/{id}', 'update');
        Route::delete('/{id}', 'delete');
    }
);
