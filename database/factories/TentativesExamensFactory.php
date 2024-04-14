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
    { static $num_tentative =1;
        return [
            'UTILISATEURS_num_utilisateur' => \App\Models\Utilisateurs::inRandomOrder()->first()->num_utilisateur,
            'EXAMENS_num_examen' => \App\Models\Examens::inRandomOrder()->first()->num_examen,
            'num_tentative' => $num_tentative++,
            'date_tentative' => fake()->date(),
            'score_obtenu' =>  $this->faker->numberBetween(0, 100),
            'valide' => $this->faker->randomElement(['oui', 'non']),
        ];
    }
}
