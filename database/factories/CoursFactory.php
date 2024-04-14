<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Cours;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Cours>
 */
final class CoursFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = Cours::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'num_cours' => fake()->randomNumber(),
            'intitule_cours' => fake()->text,
            'description' => fake()->text,
            'pre_requis' => fake()->text,
            'prix_cours' => fake()->randomFloat(),
            'date_debut' => fake()->optional()->date(),
            'date_fin' => fake()->optional()->date(),
            'visible' => fake()->optional()->boolean,
            'accessible' => fake()->optional()->boolean,
        ];
    }
}
