<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class PatientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        /** @var array $arrPatient */
        $arrPatient = parent::toArray($request);

        /** @var array $patient */
        $patient = [];

        if (!empty($arrPatient['data'])) {
            foreach ($arrPatient['data'] as $value) {
                $patient[] = $this->getPatient($value);
            }
        }

        return [
            'data' => $patient,
            'perPage' => data_get($arrPatient, 'per_page', ''),
            'nextPage' => data_get($arrPatient, 'next_page_url', ''),
            'lastPage' => data_get($arrPatient, 'next_page_url', ''),
            'total' => data_get($arrPatient, 'total', ''),
        ];
    }

    /**
     * Get patient.
     *
     * @param array $patient
     * @return array
     */
    private function getPatient(array $patient): array
    {
        return [
            'id' => $patient['id'],
            'name' => $patient['name'],
            'nameMother' => $patient['name_mother'],
            'dateBoth' => Carbon::parse($patient['date_both'])->format('d/m/Y H:i:s'),
            'cpf' => $patient['cpf'],
            'cns' => $patient['cns'],
            'image' => env('APP_URL') .'/storage/'. data_get($patient, 'image', 'image/default.png'),
            'createAt' => Carbon::parse($patient['created_at'])->format('d/m/Y H:i:s'),
            'updateAt' => Carbon::parse($patient['updated_at'])->format('d/m/Y H:i:s'),
            'address' => $this->getAddress((array) data_get($patient, 'address', []))
        ];
    }

    /**
     * Get address patient.
     *
     * @param array $address
     * @return array
     */
    private function getAddress(array $address): array
    {
        if (empty($address)) {
            return [];
        }

        return [
            "id" => $address['id'],
            "cep" => $address['cep'],
            "address" => $address['address'],
            "number" => $address['number'],
            "complement" => $address['complement'],
            "neighborhood" => $address['neighborhood'],
            "city" => $address['city'],
            "state" => $address['state']
        ];
    }
}
