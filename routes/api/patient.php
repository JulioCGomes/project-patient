<?php

use App\Http\Controllers\Api\PatientController;
use Illuminate\Support\Facades\Route;

Route::controller(PatientController::class)
    ->prefix('patient')
    ->group(function() {
        Route::get('/', 'index');
        Route::post('/', 'create');
        Route::put('/{id}', 'update');
        Route::delete('/{id}', 'delete');
    }
);
