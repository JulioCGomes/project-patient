<?php

namespace App\Repositories\Adapters\Eloquent;

use App\Models\Address;

/**
 * Class AddressRepositoryAdapter
 *
 * @package App\Http\Repositories\Adapters\Eloquent
 * @author Julio Gomes <juliocgomes.aog@gmail.com>
 * @copyright 2023
 */
class AddressRepositoryAdapter
{
    /** @var Address $addressModel */
    private $addressModel;

    /**
     * Construct.
     *
     * @param Address $addressModel
     */
    public function __construct(
        Address $addressModel
    ) {
        $this->addressModel = $addressModel;
    }

    /**
     * List all address
     *
     * @return array
     */
    public function getAllAddress(string $search): array
    {
        /** @var Collection $arrAddress */
        $arrAddress = $this->addressModel
            ->with(['patient']);

        if (!empty($search)) {
            $arrAddress
                ->orWhere('address', 'LIKE', "%$search%")
                ->orWhere('neighborhood',  'LIKE', "%$search%");
        }

        return $arrAddress
            ->paginate(3)
            ->toArray();
    }

    /**
     * Get address by id.
     *
     * @param integer $idAddress
     * @return array
     */
    public function getAddressById(int $idAddress): array
    {
        return $this->addressModel
            ->with(['patient'])
            ->where('id', $idAddress)
            ->get()
            ->toArray();
    }

    /**
     * Create address.
     *
     * @param array $address
     * @return array
     */
    public function addAddress(array $address): array
    {
        return $this->addressModel->create($address)->toArray();
    }

    /**
     * Update address.
     *
     * @param integer $idAddress
     * @param array $address
     * @return array
     */
    public function updateAddress(int $idAddress, array $address): array
    {
        $this->addressModel->where('id', $idAddress)->update($address);

        return $this->getAddressById($idAddress);
    }

    /**
     * Delete address.
     *
     * @param integer $idAddress
     * @return void
     */
    public function deleteAddress(int $idAddress): void
    {
        $this->addressModel->where('id', $idAddress)->delete();
    }
}
