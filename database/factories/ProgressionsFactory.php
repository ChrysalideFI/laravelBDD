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
            'UTILISATEURS_num_utilisateur' => \App\Models\Utilisateurs::inRandomOrder()->first()->num_utilisateur,
            'COURS_num_cours' => \App\Models\Cours::inRandomOrder()->first()->num_cours,
            'CHAPITRES_num_chapitre' => \App\Models\Chapitres::inRandomOrder()->first()->num_chapitre,
            'PARTIES_num_partie' => \App\Models\Parties::inRandomOrder()->first()->num_partie,
            'visible' => $this->faker->randomElement(['oui', 'non']),
        ];
    }
}
