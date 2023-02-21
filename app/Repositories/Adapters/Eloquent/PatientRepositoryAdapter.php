<?php

namespace App\Repositories\Adapters\Eloquent;

use App\Models\Patient;

/**
 * Class PatientRepositoryAdapter
 *
 * @package App\Http\Repositories\Adapters\Eloquent
 * @author Julio Gomes <juliocgomes.aog@gmail.com>
 * @copyright 2023
 */
class PatientRepositoryAdapter
{
    /** @var Patient $patientModel */
    private $patientModel;

    /**
     * Construct.
     *
     * @param Patient $patientModel
     */
    public function __construct(
        Patient $patientModel
    ) {
        $this->patientModel = $patientModel;
    }

    /**
     * List all patient
     *
     * @return array
     */
    public function getAllPatient(string $search)
    {
        /** @var Collection $arrPatients */
        $arrPatients = $this->patientModel
            ->with(['address']);

        if (!empty($search)) {
            $arrPatients
                ->orWhere('name', 'LIKE', "%$search%")
                ->orWhere('name_mother',  'LIKE', "%$search%");
        }

        return $arrPatients
            ->paginate(3)
            ->toArray();
    }

    /**
     * Get patient by id.
     *
     * @param integer $idPatient
     * @return array
     */
    public function getPatientById(int $idPatient)
    {
        return $this->patientModel
            ->with(['address'])
            ->where('id', $idPatient)
            ->get()
            ->toArray();
    }

    /**
     * Add Patient
     *
     * @param array $dados
     * @return array
     */
    public function addPatient(array $dataPatient)
    {
        return $this->patientModel->create($dataPatient)->toArray();
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
        $this->patientModel->where('id', $idPatient)->update($patient);

        return $this->getPatientById($idPatient);
    }

    /**
     * Delete patient.
     *
     * @param integer $idPatient
     * @return boolean
     */
    public function deletePatient(int $idPatient)
    {
        return $this->patientModel->where('id', $idPatient)->delete();
    }
}
