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
    { static $num_examen = 1;
        return [
            'num_examen' => $num_examen++,
            'COURS_num_cours' => \App\Models\Cours::inRandomOrder()->first()->num_cours,
            'CHAPITRES_num_chapitre' => \App\Models\Chapitres::inRandomOrder()->first()->num_chapitre,
            'PARTIES_num_partie' => \App\Models\Parties::inRandomOrder()->first()->num_partie,
            'titre_exam' => fake()->word,
            'contenu_exam' => fake()->text,
            'score_minimum' => $this->faker->numberBetween(40, 100),
        ];
    }
}
