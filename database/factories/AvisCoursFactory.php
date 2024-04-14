<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\AvisCours;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\AvisCours>
 */
final class AvisCoursFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = AvisCours::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'UTILISATEURS_num_utilisateur' =>  \App\Models\Utilisateurs::inRandomOrder()->first()->num_utilisateur,
            'COURS_num_cours' => \App\Models\Cours::inRandomOrder()->first()->num_cours,
            'note_cours' => rand(0, 5),
            'commentaire_cours' => fake()->optional()->text,
        ];
    }
}
