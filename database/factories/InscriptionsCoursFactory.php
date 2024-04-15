<?php

declare(strict_types=1);

namespace Database\Factories;

use Exception;
use database\Seeders\DatabaseSeeder;
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
    // { static $num_inscription = 1;
    //     return [
    //         'num_inscription' => $num_inscription++,
    //         // 'UTILISATEURS_num_utilisateur' => \App\Models\Utilisateurs::inRandomOrder()->first()->num_utilisateur,
    //         // 'UTILISATEURS_num_utilisateur' => utilisateur->num_utilisateur,
    //         //'COURS_num_cours' => \App\Models\Cours::inRandomOrder()->first()->num_cours,
    //         'montant_paye' => $this->faker->optional(0.5)->randomFloat(2, 0, 1000) ?? 0,
    //         'paye' => $this->faker->randomElement(['oui', 'non']),
    //         'date_paiement' => fake()->date(),
    //         'inscription_valide' => $this->faker->randomElement(['oui', 'non']),
    //         'date_insc_cours' => fake()->date(),
    //     ];
    // }
    {static $num_inscription = 1;
    return [
        'num_inscription' => $num_inscription++,
        'UTILISATEURS_num_utilisateur' => \App\Models\Utilisateurs::inRandomOrder()->first()->num_utilisateur,
        'COURS_num_cours' => \App\Models\Cours::inRandomOrder()->first()->num_cours,
        'montant_paye' => $this->faker->optional(0.5)->randomFloat(2, 0, 1000) ?? 0,
        'paye' => $this->faker->randomElement(['oui', 'non']),
        'date_paiement' => $this->faker->date(),
        'inscription_valide' => $this->faker->randomElement(['oui', 'non']),
        'date_insc_cours' => $this->faker->date(),
    ];



}
}
