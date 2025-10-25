<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Role>
 */
class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->randomElement(['manager', 'agent', 'bailleur', 'client']),
            'description' => $this->faker->unique()->randomElement([
                'Manager de l\'agence',
                'Agent immobilier',
                'Propriétaire de biens immobiliers',
                'Client de l\'agence immobilière'
            ]),
        ];
    }
}