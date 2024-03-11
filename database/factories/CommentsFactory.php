<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Comments;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Comments>
 */
final class CommentsFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = Comments::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'content' => fake()->text,
            'ARTICLES_id' => \App\Models\Articles::factory(),
            'USERS_id' => \App\Models\Users::factory(),
        ];
    }
}
