<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\InscriptionsCours;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\InscriptionsCours>
 */
final class InscriptionsCoursFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = InscriptionsCours::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'num_inscription' => fake()->randomNumber(),
            'UTILISATEURS_num_utilisateur' => \App\Models\Utilisateurs::factory(),
            'COURS_num_cours' => \App\Models\Cours::factory(),
            'montant_paye' => fake()->randomFloat(),
            'paye' => fake()->word,
            'date_paiement' => fake()->date(),
            'inscription_valide' => fake()->word,
            'date_insc_cours' => fake()->date(),
        ];
    }
}
