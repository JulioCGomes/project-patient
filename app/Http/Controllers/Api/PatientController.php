<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Patient\PatientCreateRequest;
use App\Http\Requests\Patient\PatientSearchRequest;
use App\Http\Requests\Patient\PatientUpdateRequest;
use App\Http\Resources\PatientResource;
use App\Services\Patient\PatientServiceInterface;
use Exception;
use Illuminate\Support\Facades\DB;

class PatientController extends Controller
{
    /** @var PatientServiceInterface $patientService */
    private $patientService;

    /**
     * Construtor do controller ApostaController
     *
     * @param PatientServiceInterface $patientService
     */
    public function __construct(
        PatientServiceInterface $patientService
    ) {
        $this->patientService = $patientService;
    }

    /**
     * List all get patient.
     *
     * @return Mixed
     */
    public function index(PatientSearchRequest $request)
    {
        try {
            /** @var string $search */
            $search = data_get($request->validated(), 'search', '');

            /** @var Array|Colletion $arrPatient */
            $arrPatient = $this->patientService->getAllPatient((string) $search);

            return new PatientResource($arrPatient);
        } catch (Exception $e) {
            return response()->json([
                'msg' => 'Unable to list patients. Error: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Add patient.
     *
     * @param PatientCreateRequest $request
     * @return Json
     */
    public function create(PatientCreateRequest $request)
    {
        DB::beginTransaction();

        try {
            /** @var array $dataPatient*/
            $dataPatient = $request->validated();

            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                /** @var string $pathImage */
                $pathImage = $request->file('image')->store('image', 'public');
                $dataPatient['image'] = $pathImage;
            }

            /** @var array $newPatient */
            $newPatient = $this->patientService->addPatient($dataPatient);

            /** @var PatientResource $patient */
            $patient = new PatientResource(['data' => [$newPatient]]);

            DB::commit();

            return $patient;
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'msg' => 'Unable to add patient. Error: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update patient.
     *
     * @param PatientUpdateRequest $request
     * @return Json
     */
    public function update($idPatient, PatientUpdateRequest $request)
    {
        DB::beginTransaction();

        try {
            /** @var array $dataPatient*/
            $dataPatient = $request->validated();

            $dataPatient['id'] = (int) $idPatient;

            /** @var array $updatePatient */
            $updatePatient = $this->patientService->updatePatient($dataPatient);

            /** @var PatientResource $patient */
            $patient = new PatientResource(['data' => $updatePatient]);

            DB::commit();

            return $patient;
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'msg' => 'Unable to update patient. Error: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete patient.
     *
     * @param [type] $idPatient
     * @return Json
     */
    public function delete($idPatient)
    {
        DB::beginTransaction();

        try {
            $this->patientService->deletePatient(intval($idPatient));

            DB::commit();

            return response()->json([
                'deleted' => true
            ], 202);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'msg' => 'Unable to delete patient. Error: ' . $e->getMessage()
            ], 500);
        }
    }
}
