<?php

namespace Tests\Feature;

use Tests\TestCase;

class PatientTest extends TestCase
{
    /** @var string API_CREATE */
    const API_CREATE = '/api/patient';

    /**
     * Before each test method
     *
     * @return void
     * */
    public function setUp(): void
    {
        parent::setUp();
        $this->authenticateUser();
    }

    /**
     * Test patient creating.
     *
     * @param array $fields
     * @param array $errors
     * @dataProvider creating_invalid_patient
     * @return void
     */
    public function test_creating_invalid(array $fields, array $errors)
    {
        $response = $this->post(self::API_CREATE, $fields);
        $response->assertStatus(500);
        $response->assertJsonValidationErrors($errors);
    }

    /**
     * Creating invalid patient.
     *
     * @return void
     */
    private function creating_invalid_patient(): array
    {
        return [
            'Empty Data' => [
                'fields' => [],
                'errors' => [
                    'name' => 'The name field required.',
                    'name_mother' => 'The name mother field required.',
                    'date_both' => 'The date both required.',
                    'cpf' => 'The cpf field required.',
                    'cns' => 'The cns field required.'
                ]
            ],
            'Field String' => [
                'fields' => [
                    'name' => 123,
                    'name_mother' => 123,
                    'date_both' => '1997-09-30',
                    'cpf' => 1234567891012,
                    'cns' => 123
                ],
                'errors' => [
                    'name' => 'The name field must be string.',
                    'name_mother' => 'The name mother field must be string.',
                    'cpf' => [
                        'The cpf field must be string.',
                        'The cpf needs to be valid.'
                    ],
                    'cns' => 'The cns field must be string.'
                ]
            ],
            'Field Min' => [
                'fields' => [
                    'name' => '1',
                    'name_mother' => '1',
                    'date_both' => '1997-09-30',
                    'cpf' => '1',
                    'cns' => '1'
                ],
                'errors' => [
                    'name' => 'The name field must contain at least 3 characters.',
                    'name_mother' => 'The name mother field must contain at least 3 characters.',
                    'cpf' => 'The cpf field must contain at least 13 characters.',
                    'cns' => 'The cns field must contain at least 3 characters.'
                ]
            ],
            'Field Max' => [
                'fields' => [
                    'name' => 'Name Max Caracter - Name Max Caracter - Name Max Caracter',
                    'name_mother' => 'Name Mother Max Caracter - Name Mother Max Caracter - Name Mother Max Caracter',
                    'date_both' => '1997-09-30',
                    'cpf' => '123456789123456789',
                    'cns' => '123456789123456789123456789123456789'
                ],
                'errors' => [
                    'name' => 'The name field must contain a maximum of 32 characters.',
                    'name_mother' => 'The name mother field must contain a maximum of 32 characters.',
                    'cpf' => 'The cpf field must contain a maximum of 14 characters.',
                    'cns' => 'The cns field must contain a maximum of 30 characters.'
                ]
            ],
            'Field Extra' => [
                'fields' => [
                    'name' => 'Name Patient',
                    'name_mother' => 'Name Mother',
                    'date_both' => '1997-09-30',
                    'cpf' => '1234567894',
                    'cns' => '123456789123'
                ],
                'errors' => [
                    'cpf' => 'The cpf needs to be valid.',
                ]
            ],
        ];
    }
}
