<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Examens;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Examens>
 */
final class ExamensFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = Examens::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'num_examen' => fake()->randomNumber(),
            'COURS_num_cours' => fake()->randomNumber(),
            'CHAPITRES_num_chapitre' => fake()->randomNumber(),
            'PARTIES_num_partie' => \App\Models\Parties::factory(),
            'titre_exam' => fake()->word,
            'contenu_exam' => fake()->text,
            'score_minimum' => fake()->randomNumber(),
        ];
    }
}
