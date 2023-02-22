<?php

namespace App\Http\Requests\Patient;

use App\Http\Requests\DefaultRequest;

class PatientUpdateRequest extends DefaultRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected $rules = [
        'id' => ['required', 'integer'],
        'name' => ['string', 'min:3', 'max:32'],
        'name_mother' => ['string', 'min:3', 'max:32'],
        'date_both' => ['date_format:Y-m-d'],
        'cpf' => ['string', 'min:13', 'max:14', 'cpf', 'formato_cpf', 'unique:patients,cpf'],
        'cns' => ['string', 'min:3', 'max:30'],
        'image' => ['image']
    ];

    /**
     * Get error messages that occur.
     *
     * @return array
     */
    protected $messages = [
        'name.string' => 'The name field must be string.',
        'name.min' => 'The name field must contain at least 3 characters.',
        'name.max' => 'The name field must contain a maximum of 32 characters.',
        'name_mother.string' => 'The name mother field must be string.',
        'name_mother.min' => 'The name mother field must contain at least 3 characters.',
        'name_mother.max' => 'The name mother field must contain a maximum of 32 characters.',
        'cpf.string' => 'The cpf field must be string.',
        'cpf.min' => 'The cpf field must contain at least 13 characters.',
        'cpf.max' => 'The cpf field must contain a maximum of 14 characters.',
        'cpf.cpf' => 'The cpf needs to be valid.',
        'cpf.formato_cpf' => 'The cpf needs to be valid.',
        'cpf.unique' => 'CPF already registered.',
        'cns.string' => 'The cns field must be string.',
        'cns.min' => 'The cns field must contain at least 3 characters.',
        'cns.max' => 'The cns field must contain a maximum of 30 characters.',
    ];
}
