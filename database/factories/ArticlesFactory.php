<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Articles;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Articles>
 */
final class ArticlesFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = Articles::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'title' => fake()->title,
            'content' => fake()->text,
            'date_created' => fake()->dateTime(),
            'USERS_id' => \App\Models\Users::factory(),
        ];
    }
}
