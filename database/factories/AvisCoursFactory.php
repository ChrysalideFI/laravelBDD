<?php

declare(strict_types=1);

namespace Database\Factories;

use Exception;
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
    // public function definition(): array
    // {
    //     return [
    //         'UTILISATEURS_num_utilisateur' =>  \App\Models\Utilisateurs::inRandomOrder()->first()->num_utilisateur,
    //         'COURS_num_cours' => \App\Models\Cours::inRandomOrder()->first()->num_cours,
    //         'note_cours' => rand(0, 5),
    //         'commentaire_cours' => fake()->optional()->text, //
    //     ];
    // }


    public function definition(): array
    {
        $utilisateur = \App\Models\Utilisateurs::inRandomOrder()->first();
        $cours = \App\Models\Cours::whereNotExists(function ($query) use ($utilisateur) {
            $query->select('*')
                ->from('avis_cours')
                ->whereColumn('COURS_num_cours', 'cours.num_cours')
                ->where('UTILISATEURS_num_utilisateur', $utilisateur->num_utilisateur);
        })->inRandomOrder()->first();

        if (!$utilisateur || !$cours) {
            throw new Exception('No users or courses found. Please seed these tables before running this factory.');
        }

        try {
            return [
                'UTILISATEURS_num_utilisateur' => $utilisateur->num_utilisateur,
                'COURS_num_cours' => $cours->num_cours,
                'note_cours' => rand(0, 5),
                'commentaire_cours' => $this->faker->optional()->text,
            ];
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 23000) {
                // Ignore duplicate key exception
                return [];
            }

            throw $e;
        }
    }

}
