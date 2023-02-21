<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        /** @var array $arrAddress */
        $arrAddress = parent::toArray($request);

        /** @var array $address */
        $address = [];

        if (!empty($arrAddress['data'])) {
            foreach ($arrAddress['data'] as $value) {
                $address[] = $this->getAddress($value);
            }
        }

        return [
            'data' => $address,
            'perPage' => data_get($arrAddress, 'per_page', ''),
            'nextPage' => data_get($arrAddress, 'next_page_url', ''),
            'lastPage' => data_get($arrAddress, 'next_page_url', ''),
            'total' => data_get($arrAddress, 'total', ''),
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
            "id" => data_get($address, 'id', ''),
            "cep" => data_get($address, 'cep', ''),
            "address" => data_get($address, 'address', ''),
            "number" => data_get($address, 'number', ''),
            "complement" => data_get($address, 'complement', ''),
            "neighborhood" => data_get($address, 'neighborhood', ''),
            "city" => data_get($address, 'city', ''),
            "state" => data_get($address, 'state', ''),
            "patient" => $this->getPatient((array) data_get($address, 'patient', []))
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
        if (empty($address)) {
            return [];
        }

        return [
            'id' => $patient['id'],
            'name' => $patient['name'],
            'nameMother' => $patient['name_mother'],
            'dateBoth' => Carbon::parse($patient['date_both'])->format('d/m/Y H:i:s'),
            'cpf' => $patient['cpf'],
            'cns' => $patient['cns'],
            'image' => env('APP_URL') .'/'. data_get($patient, 'image', 'image/default.png'),
            'createAt' => Carbon::parse($patient['created_at'])->format('d/m/Y H:i:s'),
            'updateAt' => Carbon::parse($patient['updated_at'])->format('d/m/Y H:i:s'),
        ];
    }
}
