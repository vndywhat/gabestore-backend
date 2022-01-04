<?php

namespace Database\Seeders;

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
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'user',
            'email' => 'user@test.com',
            'password' => bcrypt('password'),
        ]);

        \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
        ]);
    }
}
