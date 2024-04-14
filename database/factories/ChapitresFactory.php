<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Chapitres;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Chapitres>
 */
final class ChapitresFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = Chapitres::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    { static $num_chapitre = 1;
        return [
            'COURS_num_cours' => \App\Models\Cours::inRandomOrder()->first()->num_cours,
            'num_chapitre' => $num_chapitre++,
            'titre_chapitre' => $this->faker->sentence, //
        ];
    }
}
