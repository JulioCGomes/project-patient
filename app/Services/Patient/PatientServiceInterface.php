<?php

namespace App\Services\Patient;

/**
 * Interface PatientServiceInterface
 * @package App\Services
 * @author Julio Gomes <juliocgomes.aog@gmail.com>
 * @copyright 2023
 */
interface PatientServiceInterface
{
    public function getAllPatient(string $search);

    public function addPatient(array $dataPatient);

    public function updatePatient(array $patient);

    public function deletePatient(int $idPatient);
}
