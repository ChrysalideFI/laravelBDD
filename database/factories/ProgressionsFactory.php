<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Progressions;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Progressions>
 */
final class ProgressionsFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = Progressions::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'UTILISATEURS_num_utilisateur' => \App\Models\Utilisateurs::factory(),
            'COURS_num_cours' => fake()->randomNumber(),
            'CHAPITRES_num_chapitre' => fake()->randomNumber(),
            'PARTIES_num_partie' => \App\Models\Parties::factory(),
            'partie_termine' => fake()->boolean,
        ];
    }
}
