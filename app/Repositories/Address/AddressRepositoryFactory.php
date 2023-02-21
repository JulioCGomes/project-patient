<?php

namespace App\Repositories\Address;

use App\Repositories\Adapters\Eloquent\AddressRepositoryAdapter;

/**
 * Class AddressRepositoryFactory
 *
 * @package App\Repositories\Address
 * @author Julio Gomes <juliocgomes.aog@gmail.com>
 * @copyright 2023
 */
class AddressRepositoryFactory
{
    /**
     * @return AddressRepository
     */
    public function __invoke()
    {
        /** @var AddressRepositoryAdapter $addressAdapter */
        $addressAdapter = app(AddressRepositoryAdapter::class);

        return new AddressRepository(
            $addressAdapter
        );
    }
}
