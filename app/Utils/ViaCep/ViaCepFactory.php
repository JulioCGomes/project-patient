<?php

namespace App\Utils\ViaCep;

use App\Utils\ViaCep\ViaCep;

/**
 * Class integration viacep.
 *
 * @package ViaCepFactory
 */
class ViaCepFactory
{
    /**
     * Factory for ViaCep
     *
     * @return ViaCep
     */
    public function __invoke()
    {
        /** @var string $urlApi */
        $urlApi = env('API_VIACEP', '');

        return new ViaCep(
            $urlApi,
        );
    }
}
