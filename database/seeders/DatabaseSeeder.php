<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Role::factory(4)->create();
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'manager1',
            'lastName' => 'manager1',
            'email' => 'manager1@gmail.com',
            'phone' => '1234567890',
            'address' => '123 Manager St, Cityville',
            'password' => bcrypt('password'),
            'role_id' => Role::where('name', 'manager')->first()->id,
        ]);
    }
}