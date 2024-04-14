<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Roles;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Roles>
 */
final class RolesFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = Roles::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        static $num_role = 1;
        static $role_index = 0;
        $roles = ['Administrateur', 'Formateur', 'Etudiant', 'Personne administrative', 'Créateur de cours'];

        return [
            'num_role' => $num_role++,
            'role' => $roles[$role_index++ % count($roles)]
        ];
    }
}
