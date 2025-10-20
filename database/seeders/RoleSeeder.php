<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'name' => 'client', 'description' => 'Client de l\'agence immobilière'
            ],
            [
                'name' => 'bailleur', 'description' => 'Propriétaire de biens immobiliers'
            ],
            [
                'name' => 'agent', 'description' => 'Agent immobilier'
            ],
            [
                'name' => 'manager', 'description' => 'Manager de l\'agence'
            ],
        ]);
    }
}