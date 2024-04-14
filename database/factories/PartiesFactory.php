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
    { static $num_partie = 1;
        return [
            'COURS_num_cours' => \App\Models\Cours::inRandomOrder()->first()->num_cours,
            'CHAPITRES_num_chapitre' => \App\Models\Chapitres::inRandomOrder()->first()->num_chapitre,
            'num_partie' => $num_partie++,
            'titre_partie' => $this->faker->sentence,
            'contenu_partie' => fake()->text,
        ];
    }
}
