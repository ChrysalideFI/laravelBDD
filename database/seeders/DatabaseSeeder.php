<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Cours;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 5 cours dont 2 payants, 20 parties, 5 examens, 20 étudiants, 2 créateurs de cours, 3 formateurs, 1 administrateur, 2 personnes administratives
        // \App\Models\Parties::factory(20)->create();
        // \App\Models\Chapitres::factory(5)->create();
        // \App\Models\Sessions::factory(5)->create();
        \App\Models\Utilisateurs::factory(5)->create();
        // \App\Models\TentativesExamens::factory(5)->create();
        // \App\Models\Examens::factory(5)->create();
        \App\Models\Roles::factory(5)->create();
        // \App\Models\InscriptionsCours::factory(5)->create();
        // \App\Models\AssignationsSessions::factory(5)->create();
        // \App\Models\AvisCours::factory(5)->create();
        // \App\Models\Progressions::factory(5)->create();
        // \App\Models\InscriptionsSessions::factory(5)->create();
        // \App\Models\AssignationsCours::factory(5)->create();
        \App\Models\UtilisateursRoles::factory(5)->create();
        // \App\Models\UtilisateursCours::factory(5)->create();
        \App\Models\Cours::factory(5)->create(); // Reste à ajouter dont 2 payant
    }
}
