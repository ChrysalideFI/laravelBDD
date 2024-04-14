<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\UtilisateursRoles;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\UtilisateursRoles>
 */
final class UtilisateursRolesFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = UtilisateursRoles::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            // 'UTILISATEURS_num_utilisateur' => \App\Models\Utilisateurs::factory(),
            // 'ROLES_num_role' => \App\Models\Roles::factory(), //
        ];
    }
}
