<?php

namespace Tests\Feature;

use Tests\TestCase;

class ViaCepTest extends TestCase
{
    /** @var string API_CEP */
    const API_CEP = '/api/cep';

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
     * Test via cep invalid.
     *
     * @return void
     */
    public function test_get_invalid()
    {
        $response = $this->get(self::API_CEP.'/123');
        $response->assertStatus(500);
        $response->assertJsonValidationErrors(['viacep' => 'Error querying viacep.']);
    }

    /**
     * Test via cep success.
     *
     * @return void
     */
    public function test_get_success()
    {
        $response = $this->get(self::API_CEP.'/13070107');
        $response->assertStatus(200);
    }
}
