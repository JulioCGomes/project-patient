<?php

namespace App\Repositories\Address;

/**
 * Class AddressRepositoryInterface
 *
 * @package App\Repositories
 * @author Julio Gomes <juliocgomes.aog@gmail.com>
 * @copyright 2023
 */
interface AddressRepositoryInterface
{
    /**
     * Get all address.
     *
     * @param string $search
     * @return array
     */
    public function getAllAddress(string $search): array;

    /**
     * Get address by id.
     *
     * @param integer $idAddress
     * @return array
     */
    public function getAddressById(int $idAddress): array;

    /**
     * Create address.
     *
     * @param array $address
     * @return array
     */
    public function addAddress(array $address): array;

    /**
     * Delete Address.
     *
     * @param integer $idAddress
     * @return void
     */
    public function deleteAddress(int $idAddress): void;
}
