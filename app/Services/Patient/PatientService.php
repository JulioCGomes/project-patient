<?php

namespace App\Services\Patient;

use App\Repositories\Patient\PatientRepositoryInterface;
use Exception;

/**
 * Class PatientService
 * @package App\Services
 * @author Julio Gomes <juliocgomes.aog@gmail.com>
 * @copyright 2023
 */
class PatientService implements PatientServiceInterface
{
    /** @var PatientRepositoryInterface $patientRepository */
    protected $patientRepository;

    /**
     * Construct patient service
     *
     * @param PatientRepositoryInterface $patientRepository
     */
    public function __construct(
        PatientRepositoryInterface $patientRepository,
    ) {
        $this->patientRepository = $patientRepository;
    }

    /**
     * Get all patient.
     *
     * @param string $search
     * @return array
     */
    public function getAllPatient(string $search)
    {
        return $this->patientRepository->getAllPatient((string) $search);
    }

    /**
     * Add Patient.
     *
     * @param array $dados
     * @return array
     */
    public function addPatient(array $patient)
    {
        return $this->patientRepository->addPatient((array) $patient);
    }

    /**
     * Update patient.
     *
     * @param array $updatePatient
     * @return array
     */
    public function updatePatient(array $updatePatient)
    {
        if (empty($updatePatient['id'])) {
            throw new Exception('ID patient not found.');
        }

        /** @var array $patient */
        $patient = $this->patientRepository->getPatientById((int) $updatePatient['id']);

        if (empty($patient)) {
            throw new Exception('Patient not found.', 500);
        }

        return $this->patientRepository->updatePatient((int) $updatePatient['id'], (array) $updatePatient);
    }

    /**
     * Delete patient.
     *
     * @param integer $idPatient
     * @return void
     */
    public function deletePatient(int $idPatient)
    {
        $patient = $this->patientRepository->getPatientById((int) $idPatient);

        if (empty($patient)) {
            throw new Exception('Patient not found.', 500);
        }

        $this->patientRepository->deletePatient((int) $idPatient);
    }
}
