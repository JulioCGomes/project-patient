<?php

namespace App\Repositories\Address;

use App\Repositories\Adapters\Eloquent\AddressRepositoryAdapter;

/**
 * Class AddressRepository
 *
 * @package App\Http\Repositories\Address
 * @author Julio Gomes <juliocgomes.aog@gmail.com>
 * @copyright 2023
 */
class AddressRepository implements AddressRepositoryInterface
{
    /** @var AddressRepositoryAdapter $addressAdapter */
    protected $addressAdapter;

    /**
     * Construct address.
     *
     * @param AddressRepositoryAdapter $addressAdapter
     */
    public function __construct(
        AddressRepositoryAdapter $addressAdapter
    ) {
        $this->addressAdapter = $addressAdapter;
    }

    /**
     * Get all address.
     *
     * @param string $search
     * @return array
     */
    public function getAllAddress(string $search): array
    {
        return $this->addressAdapter->getAllAddress((string) $search);
    }

    /**
     * Get address by id.
     *
     * @param integer $idAddress
     * @return array
     */
    public function getAddressById(int $idAddress): array
    {
        return $this->addressAdapter->getAddressById((int) $idAddress);
    }

    /**
     * Create address.
     *
     * @param array $address
     * @return array
     */
    public function addAddress(array $address): array
    {
        return $this->addressAdapter->addAddress((array) $address);
    }

    /**
     * Delete address.
     *
     * @param integer $idAddress
     * @return void
     */
    public function deleteAddress(int $idAddress): void
    {
        $this->addressAdapter->deleteAddress((int) $idAddress);
    }
}
