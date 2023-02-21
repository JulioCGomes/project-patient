<?php

namespace App\Services\Address;

/**
 * Interface AddressServiceInterface
 *
 * @package App\Services\Address
 * @author Julio Gomes <juliocgomes.aog@gmail.com>
 * @copyright 2023
 */
interface AddressServiceInterface
{
    /**
     * Get all address.
     *
     * @param string $search
     * @return array
     */
    public function getAllAddress(string $search): array;

    /**
     * Create address.
     *
     * @param array $address
     * @return array
     */
    public function addAddress(array $address): array;

    /**
     * Delete address.
     *
     * @param integer $idAddress
     * @return void
     */
    public function deleteAddress(int $idAddress): void;
}
