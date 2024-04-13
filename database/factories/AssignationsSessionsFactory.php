<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\AssignationsSessions;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\AssignationsSessions>
 */
final class AssignationsSessionsFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = AssignationsSessions::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'COURS_num_cours' => fake()->randomNumber(),
            'UTILISATEURS_num_utilisateur' => \App\Models\Utilisateurs::factory(),
            'SESSIONS_num_session' => \App\Models\Sessions::factory(),
        ];
    }
}
