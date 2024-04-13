<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Chapitres;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Chapitres>
 */
final class ChapitresFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = Chapitres::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'COURS_num_cours' => \App\Models\Cours::factory(),
            'num_chapitre' => fake()->randomNumber(),
            'titre_chapitre' => fake()->text,
        ];
    }
}
