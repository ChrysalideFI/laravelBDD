<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Cours;
use Illuminate\Database\Seeder;
use App\Models\Utilisateurs;
use App\Models\Roles;
use App\Models\UtilisateursRoles;
use App\Models\AvisCours;
use App\Models\Progressions;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 5 cours dont 2 payants, 20 parties, 5 examens, 20 étudiants, 2 créateurs de cours, 3 formateurs, 1 administrateur, 2 personnes administratives
        // Create 10 instances of Utilisateurs and Roles
        $utilisateurs = Utilisateurs::factory()->count(30)->create();
        $roles = Roles::factory()->count(5)->create();

        //UtilisateursRoles
        // For each Utilisateur, create a UtilisateursRoles with a random Role
        foreach ($utilisateurs as $utilisateur) {
            UtilisateursRoles::factory()->create([
                'UTILISATEURS_num_utilisateur' => $utilisateur->num_utilisateur,
                'ROLES_num_role' => $roles->random()->num_role,
            ]);
        }

        //cours et UtilisateursCours
        $cours = \App\Models\Cours::factory((5))->create();
        // For each Utilisateur, create a UtilisateursCours with a random Cours
        foreach ($utilisateurs as $utilisateur) {
        \App\Models\UtilisateursCours::factory()->create([
            'UTILISATEURS_num_utilisateur' => $utilisateur->num_utilisateur,
            'COURS_num_cours' => $cours->random()->num_cours,
        ]);
        }

        //AssignationsCours
        // Get all users with role 2
        $usersWithRole2 = \App\Models\UtilisateursRoles::where('ROLES_num_role', 2)->get();

        // For each user with role 2, create an AssignationsCours with a random Cours
        foreach ($usersWithRole2 as $user) {
            \App\Models\AssignationsCours::factory()->create([
                'UTILISATEURS_num_utilisateur' => $user->UTILISATEURS_num_utilisateur,
                'COURS_num_cours' => $cours->random()->num_cours,
            ]);
        }

        //sessions
        $cours = \App\Models\Cours::all();

        // Select a random subset of courses
        $coursAvecSession = $cours->random(min($cours->count(), 10));

        // For each selected course, create a Session
        foreach ($coursAvecSession as $course) {
            \App\Models\Sessions::factory()->create([
                'COURS_num_cours' => $course->num_cours,
            ]);
        }

         //assignations_sessions
        // Get all users with role 2
        $usersWithRole2 = \App\Models\UtilisateursRoles::where('ROLES_num_role', 2)->get();

        // Get all sessions
        $sessions = \App\Models\Sessions::all();

        foreach ($usersWithRole2 as $user) {
            $randomSession = $sessions->random();
            \App\Models\AssignationsSessions::factory()->create([
                'UTILISATEURS_num_utilisateur' => $user->UTILISATEURS_num_utilisateur,
                'SESSIONS_num_session' => $randomSession->num_session,
                'COURS_num_cours' => $randomSession->COURS_num_cours,
            ]);
        }

        AvisCours::factory()->count(3)->create();
    //    $usersWithRole3 = \App\Models\UtilisateursRoles::where('ROLES_num_role', 3)->get();
    //     for ($i = 0; $i < 10; $i++) {
    //         \App\Models\AvisCours::factory()->create([
    //             'UTILISATEURS_num_utilisateur' => $usersWithRole3->random()->num_utilisateur,
    //             'COURS_num_cours' => \App\Models\Cours::inRandomOrder()->first()->num_cours,
    //             // Add any other fields you need here
    //         ]);
    //     }

    //chapitres
    $cours = \App\Models\Cours::all();

    foreach ($cours as $unCours) {
        $numChapitres = rand(3, 6);

        for ($i = 0; $i < $numChapitres; $i++) {
            $chapitre = \App\Models\Chapitres::factory()->createOne([
                'COURS_num_cours' => $unCours->num_cours,
                'num_chapitre' => $i + 1,
                // Add any other fields you need here
            ]);

            $numParties = rand(2, 5);

            for ($j = 0; $j < $numParties; $j++) {
                \App\Models\Parties::factory()->create([
                    'COURS_num_cours' => $unCours->num_cours,
                    'CHAPITRES_num_chapitre' => $chapitre->num_chapitre,
                    'num_partie' => $j + 1,
                ]);
            }
        }

    }

        $progression = Progressions::factory()->count(20)->create();


        // Générer 3 inscriptions de cours
        for ($i = 0; $i < 3; $i++) {
            // Sélectionner un utilisateur aléatoire parmi les utilisateurs avec num_role=3
            $usersWithRole3 = \App\Models\UtilisateursRoles::where('ROLES_num_role', 3)->get();
            $utilisateur = $usersWithRole3->random();

            \App\Models\InscriptionsCours::factory()->create([
                'UTILISATEURS_num_utilisateur' => $utilisateur->num_utilisateur,
            ]);
        }

         // Générer 2 inscriptions de sessions
        for ($i = 0; $i < 2; $i++) {
        // Sélectionner un utilisateur aléatoire parmi les utilisateurs avec num_role=3
        $utilisateur = $usersWithRole3->random();

        \App\Models\InscriptionsSessions::factory()->create([
            'UTILISATEURS_num_utilisateur' => $utilisateur->num_utilisateur,
        ]);
    }

      // Récupérer toutes les parties
      $parties = \App\Models\Parties::all();

      // Pour chaque partie
      foreach ($parties as $partie) {
          // Créer un examen lié à cette partie
          \App\Models\Examens::factory()->create([
              'PARTIES_num_partie' => $partie->num_partie,
              'COURS_num_cours' => $partie->chapitre->cours->num_cours,
              'CHAPITRES_num_chapitre' => $partie->chapitre->num_chapitre,
          ]);
      }


       // Récupérer toutes les inscriptions_cours
       $inscriptionsCours = \App\Models\InscriptionsCours::all();

       // Pour chaque inscription_cours
       foreach ($inscriptionsCours as $inscriptionCours) {
           // Récupérer tous les examens
           $examens = \App\Models\Examens::all();

           // Pour chaque examen
           foreach ($examens as $examen) {
               // Créer plusieurs tentatives d'examens
               for ($i = 0; $i < 3; $i++) {
                   \App\Models\TentativesExamens::factory()->create([
                       'UTILISATEURS_num_utilisateur' => $inscriptionCours->UTILISATEURS_num_utilisateur,
                       'EXAMENS_num_examen' => $examen->num_examen,
                   ]);
               }
           }
       }


    }
}










