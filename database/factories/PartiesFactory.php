<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Parties;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Parties>
 */
final class PartiesFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = Parties::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'COURS_num_cours' => fake()->randomNumber(),
            'CHAPITRES_num_chapitre' => \App\Models\Chapitres::factory(),
            'num_partie' => fake()->randomNumber(),
            'titre_partie' => fake()->word,
            'contenu_partie' => fake()->text,
        ];
    }
}
