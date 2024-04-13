<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Sessions;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Sessions>
 */
final class SessionsFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = Sessions::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'num_session' => fake()->randomNumber(),
            'COURS_num_cours' => \App\Models\Cours::factory(),
            'format_session' => fake()->text,
            'date_heure_debut' => fake()->dateTime(),
            'date_heure_fin' => fake()->dateTime(),
            'places_max' => fake()->optional()->randomNumber(),
        ];
    }
}
