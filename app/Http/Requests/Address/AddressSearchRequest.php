<?php

namespace App\Http\Requests\Address;

use App\Http\Requests\DefaultRequest;

class AddressSearchRequest extends DefaultRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected $rules = [
        'search' => ['string', 'min:2', 'max:30'],
    ];

    /**
     * Get error messages that occur.
     *
     * @return array
     */
    protected $messages = [
        'search.string' => 'The search field must be string',
        'search.min' => 'The search field must contain at least 2 characters.',
        'search.max' => 'The search field must contain a maximum of 2 characters.',
    ];
}
