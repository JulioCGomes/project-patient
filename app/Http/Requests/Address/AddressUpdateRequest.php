<?php

namespace App\Http\Requests\Address;

use App\Http\Requests\DefaultRequest;

class AddressUpdateRequest extends DefaultRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected $rules = [
        'id'  => ['nullable'],
        'patient_id' => ['required', 'exists:patients,id'],
        'cep' => ['string', 'min:8', 'max:9'],
        'address'  => ['nullable', 'string'],
        'number'  => ['string'],
        'complement'  => ['nullable', 'string'],
        'neighborhood'  => ['nullable', 'string'],
        'city'  => ['nullable', 'string'],
        'state'  => ['nullable', 'string'],
        'via_cep'  => ['nullable', 'string'],
    ];

    /**
     * Get error messages that occur.
     *
     * @return array
     */
    protected $messages = [
        'patient_id.exists' => 'The selected patient id is invalid.',
        'cep.string' => 'The cep field is string.',
        'cep.min' => 'The cep field is min 8 caracters.',
        'cep.max' => 'The cep field is max 9 caracters.',
        'address.string' => 'The address field is string.',
        'complement.string' => 'The cep field is string.',
        'neighborhood.string' => 'The cep field is string.',
        'city.string' => 'The cep field is string.',
        'state.string' => 'The cep field is string.',
    ];
}
