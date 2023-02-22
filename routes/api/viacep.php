<?php

use App\Http\Controllers\Api\ViaCepController;
use Illuminate\Support\Facades\Route;

Route::controller(ViaCepController::class)
    ->prefix('cep')
    ->group(function() {
        Route::get('/{cep}', 'index');
    }
);
