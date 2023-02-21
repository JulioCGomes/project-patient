<?php

namespace App\Repositories\Patient;

/**
 * Class PatientRepositoryInterface
 *
 * @package App\Repositories
 * @author Julio Gomes <juliocgomes.aog@gmail.com>
 * @copyright 2023
 */
interface PatientRepositoryInterface
{
    public function getAllPatient(string $search);

    public function getPatientById(int $idPatient);

    public function addPatient(array $dataPatient);

    public function updatePatient(int $idPatient, array $patient);

    public function deletePatient(int $idPatient);
}
