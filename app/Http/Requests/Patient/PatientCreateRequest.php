<?php

namespace App\Http\Requests\Patient;

use App\Http\Requests\DefaultRequest;

class PatientCreateRequest extends DefaultRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected $rules = [
        'id' => ['nullable', 'integer'],
        'name' => ['required', 'string', 'min:3', 'max:32'],
        'name_mother' => ['required', 'string', 'min:3', 'max:32'],
        'date_both' => ['required', 'date_format:Y-m-d'],
        'cpf' => ['required', 'string', 'min:13', 'max:14', 'cpf', 'formato_cpf', 'unique:patients,cpf'],
        'cns' => ['required', 'string', 'min:3', 'max:30'],
        'image' => ['image', 'mimes:jpg,png,jpeg,gif,svg', 'max:2048']
    ];

    /**
     * Get error messages that occur.
     *
     * @return array
     */
    protected $messages = [
        'name.required' => 'The name field required.',
        'name.string' => 'The name field must be string.',
        'name.min' => 'The name field must contain at least 3 characters.',
        'name.max' => 'The name field must contain a maximum of 32 characters.',
        'name_mother.required' => 'The name mother field required.',
        'name_mother.string' => 'The name mother field must be string.',
        'name_mother.min' => 'The name mother field must contain at least 3 characters.',
        'name_mother.max' => 'The name mother field must contain a maximum of 32 characters.',
        'date_both.required' => 'The date both required.',
        'cpf.required' => 'The cpf field required.',
        'cpf.string' => 'The cpf field must be string.',
        'cpf.min' => 'The cpf field must contain at least 13 characters.',
        'cpf.max' => 'The cpf field must contain a maximum of 14 characters.',
        'cpf.cpf' => 'The cpf needs to be valid.',
        'cpf.formato_cpf' => 'The cpf needs to be valid.',
        'cpf.unique' => 'CPF already registered.',
        'cns.required' => 'The cns field required.',
        'cns.string' => 'The cns field must be string.',
        'cns.min' => 'The cns field must contain at least 3 characters.',
        'cns.max' => 'The cns field must contain a maximum of 30 characters.',
    ];
}
