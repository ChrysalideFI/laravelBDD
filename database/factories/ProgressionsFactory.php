<?php

declare(strict_types=1);

namespace Database\Factories;

use Exception;
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
    // public function definition(): array
    // {
    //     return [
    //         'UTILISATEURS_num_utilisateur' => \App\Models\Utilisateurs::inRandomOrder()->first()->num_utilisateur,
    //         'COURS_num_cours' => \App\Models\Cours::inRandomOrder()->first()->num_cours,
    //         'CHAPITRES_num_chapitre' => \App\Models\Chapitres::inRandomOrder()->first()->num_chapitre,
    //         'PARTIES_num_partie' => \App\Models\Parties::inRandomOrder()->first()->num_partie,
    //         'partie_termine' => $this->faker->randomElement(['oui', 'non']),
    //     ];
    // }

// public function definition(): array
// {
//     $partie = \App\Models\Parties::inRandomOrder()->first();

//     return [
//         'UTILISATEURS_num_utilisateur' => \App\Models\Utilisateurs::inRandomOrder()->first()->num_utilisateur,
//         'COURS_num_cours' => $partie->COURS_num_cours,
//         'CHAPITRES_num_chapitre' => $partie->CHAPITRES_num_chapitre,
//         'PARTIES_num_partie' => $partie->num_partie,
//         'partie_termine' => $this->faker->randomElement(['oui', 'non']),
//     ];
// }


public function definition(): array
{
    $utilisateur = \App\Models\Utilisateurs::inRandomOrder()->first();
    $partie = \App\Models\Parties::whereNotExists(function ($query) use ($utilisateur) {
        $query->select('*')
            ->from('progressions')
            ->whereColumn('COURS_num_cours', 'parties.COURS_num_cours')
            ->whereColumn('CHAPITRES_num_chapitre', 'parties.CHAPITRES_num_chapitre')
            ->whereColumn('PARTIES_num_partie', 'parties.num_partie')
            ->where('UTILISATEURS_num_utilisateur', $utilisateur->num_utilisateur);
    })->inRandomOrder()->first();

    if (!$utilisateur || !$partie) {
        throw new Exception('No users or parties found. Please seed these tables before running this factory.');
    }

    return [
        'UTILISATEURS_num_utilisateur' => $utilisateur->num_utilisateur,
        'COURS_num_cours' => $partie->COURS_num_cours,
        'CHAPITRES_num_chapitre' => $partie->CHAPITRES_num_chapitre,
        'PARTIES_num_partie' => $partie->num_partie,
        'partie_termine' => $this->faker->randomElement(['oui', 'non']),
    ];
}


}
