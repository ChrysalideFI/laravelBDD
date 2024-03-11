<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\UsersUsers;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\UsersUsers>
 */
final class UsersUsersFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = UsersUsers::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'USERS_id1' => \App\Models\Users::factory(),
            'USERS_id2' => \App\Models\Users::factory(),
        ];
    }
}
