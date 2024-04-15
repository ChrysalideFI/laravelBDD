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
    { static $num_cours = 1;
        return [
            'num_cours' =>  $num_cours++,
            'intitule_cours' =>$this->faker->sentence,
            'description' => $this->faker->text,
            'pre_requis' => $this->faker->text,
            'prix_cours' => $this->faker->optional(0.5)->randomFloat(2, 0, 1000) ?? 0,
            'date_debut' => $this->faker->optional()->date(),
            'date_fin' => $this->faker->optional()->date(),
            'visible' => $this->faker->optional()->randomElement(['oui', 'non']),
            'accessible' => $this->faker->optional()->randomElement(['oui', 'non']),//
        ];
    }
}
