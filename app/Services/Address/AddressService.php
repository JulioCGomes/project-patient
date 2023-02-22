<?php

namespace App\Services\Address;

use App\Repositories\Address\AddressRepositoryInterface;
use App\Repositories\Patient\PatientRepositoryInterface;
use App\Utils\ViaCep\ViaCepInterface;
use Exception;

/**
 * Class AddressService
 *
 * @package App\Services\Address
 * @author Julio Gomes <juliocgomes.aog@gmail.com>
 * @copyright 2023
 */
class AddressService implements AddressServiceInterface
{
    /** @var AddressRepositoryInterface $addressRepository */
    protected $addressRepository;

    /** @var PatientRepositoryInterface $patientRepository */
    protected $patientRepository;

    /** @var ViaCepInterface $viaCepInterface */
    protected $viaCepInterface;

    /**
     * Construct Address service
     *
     * @param AddressRepositoryInterface $addressRepository
     * @param PatientRepositoryInterface $patientRepository
     * @param ViaCepInterface $viaCepInterface
     */
    public function __construct(
        AddressRepositoryInterface $addressRepository,
        PatientRepositoryInterface $patientRepository,
        ViaCepInterface $viaCepInterface,
    ) {
        $this->addressRepository = $addressRepository;
        $this->patientRepository = $patientRepository;
        $this->viaCepInterface = $viaCepInterface;
    }

    /**
     * Get all address.
     *
     * @param string $search
     * @return array
     */
    public function getAllAddress(string $search): array
    {
        return $this->addressRepository->getAllAddress((string) $search);
    }

    /**
     * Create address.
     *
     * @param array $address
     * @return array
     */
    public function addAddress(array $address): array
    {
        $address['address'] = data_get($address, 'address', '');
        $address['neighborhood'] = data_get($address, 'neighborhood', '');
        $address['city'] = data_get($address, 'city', '');
        $address['state'] = data_get($address, 'state', '');

        if (data_get($address, 'via_cep', null) || empty($address['address'])) {
            /** @var array $viacep */
            $viacep = $this->viaCepInterface->getInfoCep((string) $address['cep']);

            if (empty($viacep)) {
                throw new Exception('Not found cep', 500);
            }

            $address['address'] = data_get($viacep, 'logradouro', '');
            $address['neighborhood'] = data_get($viacep, 'bairro', '');
            $address['city'] = data_get($viacep, 'localidade', '');
            $address['state'] = data_get($viacep, 'uf', '');
        }

        /** @var array $patientAddress */
        $patientAddress = current($this->patientRepository->getPatientById((int) $address['patient_id']));

        if (!empty($patientAddress['address'])) {
            throw new Exception('Patient already has a registered address.', 500);
        }

        return $this->addressRepository->addAddress((array) $address);
    }

    /**
     * Update address.
     *
     * @param array $address
     * @return array
     */
    public function updateAddress(array $address): array
    {
        if (empty($address['id'])) {
            throw new Exception('ID address not found.');
        }

        /** @var array $currentAddress */
        $currentAddress = $this->addressRepository->getAddressById((int) $address['id']);

        if (empty($currentAddress)) {
            throw new Exception('Address not found.', 500);
        }

        return $this->addressRepository->updateAddress((int) $address['id'],  (array) $address);
    }

    /**
     * Delete address.
     *
     * @param integer $idAddress
     * @return void
     */
    public function deleteAddress(int $idAddress): void
    {
        $address = $this->addressRepository->getAddressById((int) $idAddress);

        if (empty($address)) {
            throw new Exception('Address not found.', 500);
        }

        $this->addressRepository->deleteAddress((int) $idAddress);
    }
}
