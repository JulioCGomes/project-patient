<?php

namespace App\Repositories\Patient;

use App\Repositories\Adapters\Eloquent\PatientRepositoryAdapter;

/**
 * Class PatientRepositoryFactory
 * @package App\Repositories
 * @author Julio Gomes <juliocgomes.aog@gmail.com>
 * @copyright 2023
 */
class PatientRepositoryFactory
{
    /**
     * @return PatientRepository
     */
    public function __invoke()
    {
        /** @var PatientRepositoryAdapter $patientAdapter */
        $patientAdapter = app(PatientRepositoryAdapter::class);

        return new PatientRepository(
            $patientAdapter
        );
    }
}
