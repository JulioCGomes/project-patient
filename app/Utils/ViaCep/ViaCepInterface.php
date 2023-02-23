<?php

namespace App\Utils\ViaCep;

/**
 * Class integration viacep.
 *
 * @package ViaCepInterface
 */
interface ViaCepInterface
{
    /**
     * Get info via cep.
     *
     * @param string $cep
     * @return array
     */
    public function getInfoCep(string $cep);
}
