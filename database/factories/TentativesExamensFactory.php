<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\TentativesExamens;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\TentativesExamens>
 */
final class TentativesExamensFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = TentativesExamens::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'UTILISATEURS_num_utilisateur' => \App\Models\Utilisateurs::factory(),
            'EXAMENS_num_examen' => \App\Models\Examens::factory(),
            'num_tentative' => fake()->randomNumber(),
            'date_tentative' => fake()->date(),
            'score_obtenu' => fake()->randomNumber(),
            'valide' => fake()->boolean,
        ];
    }
}
