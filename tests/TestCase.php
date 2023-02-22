<?php

namespace Tests;

use App\Models\User;
use DateTime;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\DB;

use Laravel\Passport\Client;
use Laravel\Passport\Passport;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /** @var string EMAIL_TESTING */
    const EMAIL_TESTING = 'mailtesting@testing.com';

    public function authenticateUser()
    {
        Passport::actingAs(User::where('email', self::EMAIL_TESTING)->first());
    }
}
