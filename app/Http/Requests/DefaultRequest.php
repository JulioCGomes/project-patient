<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

abstract class DefaultRequest extends FormRequest
{
    /**
     * Variable to store the rules.
     *
     * Example:
     * protected array $rules = ['field' => 'required|integer']
     *
     * @var array
     */
    protected $rules = [];

    /**
     * Variable for storing custom messages for each rule.
     *
     * Example:
     * protected array $message = ['field.required' => 'Field XXX required.']
     *
     * @var array
     */
    protected $messages = [];

    /**
     * Method for Definition of Rules
     *
     * @return array
     */
    public function rules()
    {
        return $this->rules;
    }

    /**
     * Method for return of customized messages.
     *
     * @return array
     */
    public function messages()
    {
        return $this->messages;
    }

    /**
     * Return if validation is invalid.
     *
     * @param \Illuminate\Contracts\Validation\Validator $validator
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        throw (
            new ValidationException(
                $validator,
                response()->json([
                    'errors' => $validator->getMessageBag()->getMessages()
                ], 500)
            )
        )->errorBag($this->errorBag);
    }
}
