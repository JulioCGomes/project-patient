<?php

namespace App\Services\Patient;

use App\Repositories\Patient\PatientRepositoryInterface;

/**
 * Class PatientServiceFactory
 * @package App\Services
 * @author Julio Gomes <juliocgomes.aog@gmail.com>
 * @copyright 2023
 */
class PatientServiceFactory
{
    /**
     * @return PatientService
     */
    public function __invoke()
    {
        /** @var PatientRepositoryInterface $patientRepository */
        $patientRepository = app(PatientRepositoryInterface::class);

        return new PatientService(
            $patientRepository,
        );
    }
}
