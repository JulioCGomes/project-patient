<?php

namespace App\Services\Address;

use App\Repositories\Address\AddressRepositoryInterface;
use App\Repositories\Patient\PatientRepositoryInterface;
use App\Utils\ViaCep\ViaCepInterface;

/**
 * Class AddressServiceFactory
 *
 * @package App\Services\Address
 * @author Julio Gomes <juliocgomes.aog@gmail.com>
 * @copyright 2023
 */
class AddressServiceFactory
{
    /**
     * @return AddressService
     */
    public function __invoke()
    {
        /** @var AddressRepositoryInterface $addressRepository */
        $addressRepository = app(AddressRepositoryInterface::class);

        /** @var PatientRepositoryInterface $patientRepository */
        $patientRepository = app(PatientRepositoryInterface::class);

        /** @var ViaCepInterface $viaCepInterface */
        $viaCepInterface = app(ViaCepInterface::class);

        return new AddressService(
            $addressRepository,
            $patientRepository,
            $viaCepInterface
        );
    }
}
