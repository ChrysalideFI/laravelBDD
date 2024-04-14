<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Utilisateurs;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Utilisateurs>
 */
final class UtilisateursFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = Utilisateurs::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'num_utilisateur' => fake()->randomNumber(),
            'nom' => fake()->text,
            'prenom' => fake()->text,
        ];
    }
}
