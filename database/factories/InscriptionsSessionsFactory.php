<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\InscriptionsSessions;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\InscriptionsSessions>
 */
final class InscriptionsSessionsFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = InscriptionsSessions::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'SESSIONS_num_session' => \App\Models\Sessions::factory(),
            'INSCRIPTIONS_COURS_num_inscription' => \App\Models\InscriptionsCours::factory(),
            'COURS_num_cours' => fake()->randomNumber(),
            'date_insc_session' => fake()->date(),
        ];
    }
}
