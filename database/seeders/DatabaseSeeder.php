<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Specialist;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            // SpecialistSeeder::class,
            SessionsSeeder::class
            //CategorySeeder::class,
            // AdminUserSeeder::class,
        ]);
        // \App\Models\User::factory(10)->create();
    }
}
