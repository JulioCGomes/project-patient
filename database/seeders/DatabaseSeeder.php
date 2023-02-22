<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Address;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(5)->create();
        Patient::factory(5)->create();
        Address::factory(5)->create();

        /**
         * User default
         */
        User::factory(1)->create([
            'email' => 'admin@admin.com'
        ]);

        /**
         * User testing.
         */
        User::factory(1)->create([
            'name' => 'testing',
            'email' => 'mailtesting@testing.com'
        ]);
    }
}
