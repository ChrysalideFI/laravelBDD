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
    { static $num_utilisateur = 1;
        return [
            'num_utilisateur' => $num_utilisateur++,
            'nom' => $this->faker->lastName(),
            'prenom' =>  $this->faker->firstName(), //
        ];
    }
}
