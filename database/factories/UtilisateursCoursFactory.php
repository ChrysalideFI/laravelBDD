<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\UtilisateursCours;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\UtilisateursCours>
 */
final class UtilisateursCoursFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = UtilisateursCours::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            // 'UTILISATEURS_num_utilisateur' => \App\Models\Utilisateurs::factory(),
            // 'COURS_num_cours' => \App\Models\Cours::factory(),
        ];
    }
}
