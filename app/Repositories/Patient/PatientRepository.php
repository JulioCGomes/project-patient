<?php

namespace App\Repositories\Patient;

use App\Repositories\Adapters\Eloquent\PatientRepositoryAdapter;

/**
 * Class PatientRepository
 *
 * @package App\Http\Repositories
 * @author Julio Gomes <juliocgomes.aog@gmail.com>
 * @copyright 2023
 */
class PatientRepository implements PatientRepositoryInterface
{
    /** @var PatientRepositoryAdapter $patientAdapter */
    protected $patientAdapter;

    /**
     * Construct Patient.
     *
     * @param PatientRepositoryAdapter $patientAdapter
     */
    public function __construct(
        PatientRepositoryAdapter $patientAdapter
    ) {
        $this->patientAdapter = $patientAdapter;
    }

    /**
     * List all patient.
     *
     * @return Mixed
     */
    public function getAllPatient(string $search)
    {
        return $this->patientAdapter->getAllPatient((string) $search);
    }

    /**
     * Get patient by id.
     *
     * @param integer $idPatient
     * @return array
     */
    public function getPatientById(int $idPatient)
    {
        return $this->patientAdapter->getPatientById((int) $idPatient);
    }

    /**
     * Add Patient.
     *
     * @param array $dados
     * @return Array
     */
    public function addPatient(array $patient)
    {
        return $this->patientAdapter->addPatient((array) $patient);
    }

    /**
     * Update patient.
     *
     * @param integer $idPatient
     * @param array $patient
     * @return array
     */
    public function updatePatient(int $idPatient, array $patient)
    {
        return $this->patientAdapter->updatePatient((int) $idPatient, (array) $patient);
    }

    /**
     * Delete patient.
     *
     * @param integer $idPatient
     * @return void
     */
    public function deletePatient(int $idPatient)
    {
        return $this->patientAdapter->deletePatient((int) $idPatient);
    }
}
