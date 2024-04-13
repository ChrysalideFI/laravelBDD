<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignations_cours', function (Blueprint $table) {
            $table->comment('Il s\'\'agit de l\'\'assignation d\'\'un ou plusieurs formateurs ├á un cours.
Pour le sch├®ma logique intitule_cours, num_utilisateur, seront introduites en cl├®s ├®trang├¿res (FK) et cl├®s primaires (PK) pour cette table.');
            $table->integer('UTILISATEURS_num_utilisateur')->comment('L\'\'identifiant de chaque utilisateur.');
            $table->integer('COURS_num_cours')->index('assignations_cours_cours');

            $table->primary(['UTILISATEURS_num_utilisateur', 'COURS_num_cours']);
        });

        Schema::create('assignations_sessions', function (Blueprint $table) {
            $table->comment('Il s\'\'agit de l\'\'assignation d\'\'un ou plusieurs formateurs ├á une session.
Pour le sch├®ma logique les attributs intitule_cours, num_utilisateur, num_session, seront introduites en cl├®s ├®trang├¿res (FK) et cl├®s primaires (PK) pour cette table.');
            $table->integer('COURS_num_cours');
            $table->integer('UTILISATEURS_num_utilisateur')->index('utilsateurs_assignations_session')->comment('L\'\'identifiant de chaque utilisateur. ');
            $table->integer('SESSIONS_num_session')->comment('L\'\'identifiant des sessions.');

            $table->primary(['SESSIONS_num_session', 'UTILISATEURS_num_utilisateur', 'COURS_num_cours']);
            $table->index(['SESSIONS_num_session', 'COURS_num_cours'], 'session_assignation_session');
        });

        Schema::create('avis_cours', function (Blueprint $table) {
            $table->comment('Cela correspond ├á l\'\'avis donn├® par un ├®tudiant sur un cours pour lequel il est inscrit. Les avis sont optionnels
L\'\'attribut note prends pour valeur un type "Integer" entre 1 et 5.
L\'\'attribut commentaire_cours lui reste optionnel laissant ainsi le choix ├á l\'\'├®tudiant d\'\'ajouter (ou pas) un commentaire en plus de la note attribu├®e au cours.
Pour le sch├®ma logique intitule_cours, num_utilisateur, seront introduites en cl├®s ├®trang├¿res (FK) et cl├®s primaires (PK) pour cette table pour reconna├«tre de mani├¿re unique la note et l\'\'├®ventuel commentaire qu\'\'un ├®tudiant E attribut ├á un cours C.');
            $table->integer('UTILISATEURS_num_utilisateur')->comment('L\'\'identifiant de chaque utilisateur.');
            $table->integer('COURS_num_cours')->index('avis_cours_cours');
            $table->integer('note_cours')->comment('Note, de 0 ├á 5, donn├®e par les ├®tudiants sur le cours. ');
            $table->text('commentaire_cours')->nullable()->comment('De 0 ├á 5');

            $table->primary(['UTILISATEURS_num_utilisateur', 'COURS_num_cours']);
        });

        Schema::create('chapitres', function (Blueprint $table) {
            $table->comment('Les cours contiennent des chapitres qui eux m├¬mes contiennent  des parties.
Un chapitre repr├®sente une subdivision d\'\'un cours et sert ├á regrouper les parties d\'\'un cours.
Pour le sch├®ma logique intitule_cours sera introduit en cl├® ├®trang├¿re (FK) pour cette table dans le sch├®ma logique. Aussi, la cl├® primaire (PK)  sera compos├® de cette derni├¿re et de num_chapitre pour cette table afin d\'\'identifier de mani├¿re unique, un chapitre d\'\'un cours.');
            $table->integer('COURS_num_cours')->index('chapitres_cours');
            $table->integer('num_chapitre', true)->comment('Exemple : 1 pour chapitre 1. Permet d\'\'ordonner les chapitres (ordre croissant)');
            $table->text('titre_chapitre')->comment('Ajout de notre part, nous ne voyons pas un chapitre sans titre.');

            $table->primary(['num_chapitre', 'COURS_num_cours']);
        });

        Schema::create('cours', function (Blueprint $table) {
            $table->comment('Il s\'\'agit des cours sur la plateforme qui sont suivies par les ├®tudiants, associ├®s ├á des formateurs. Ils peuvent ├¬tre comment├®s et not├®s. Ils sont r├®parties en chapitres. Ils peuvent parfois avoir des sessions associ├®s. Pour suivre un cours il faut s\'\'y inscrire. Les cours peuvent ├¬tre cr├®er, ├®diter ou supprimer par certains types d\'\'utilisateurs (r├┤les d\'\'utilisateur).
Nous consid├®rons que l\'\'intitul├® de chaque cours est unique.');
            $table->integer('num_cours', true);
            $table->text('intitule_cours')->comment('Identifiant d\'\'un cours, nous consid├®rons que deux cours ne se nomment jamais de la m├¬me mani├¿re.');
            $table->text('description')->comment('Description du cours.');
            $table->text('pre_requis')->comment('Pr├®-requis du cours.');
            $table->decimal('prix_cours', 6)->comment('Correspond au prix du cours, vaut 0 si le cours est gratuit.');
            $table->date('date_debut')->nullable()->comment('Date du d├®but du cours (optionnel).');
            $table->date('date_fin')->nullable()->comment('Date de fin du cours (optionnel).');
            $table->boolean('visible')->nullable()->comment('Le cours peut ├¬tre visible ou non sur la plateforme.');
            $table->boolean('accessible')->nullable()->comment('L\'\'accessibilit├® d├®pend des dates de d├®but et de fin d\'\'un cours. Si nous ne sommes pas entre la date de d├®but et de fin de cours, le cours n\'\'est pas accessible et cet attribut vaudra "False".');
        });

        Schema::create('examens', function (Blueprint $table) {
            $table->comment('Cette entit├® liste tous les examens qui ont ├®t├® cr├®├®s. Un examen porte sur une partie. L\'\'examen est optionnel : il y a des parties sans examens.
L\'\'attribut score_minimum est de type "Integer" avec une valeur entre 40 et 100.

Pour le sch├®ma logique, intitule_cours, num_chapitre, num_partie seront introduites en cl├®s ├®trang├¿res (FK) et identifiants secondaires (alternative unique keys) pour cette table afin d\'\'identifier de mani├¿re unique, sur quelle partie porte un examen pr├®cis.');
            $table->integer('num_examen', true);
            $table->integer('COURS_num_cours');
            $table->integer('CHAPITRES_num_chapitre');
            $table->integer('PARTIES_num_partie')->comment('Permet d\'\'ordonner par partie si besoin');
            $table->text('titre_exam');
            $table->text('contenu_exam');
            $table->integer('score_minimum');

            $table->unique(['COURS_num_cours', 'CHAPITRES_num_chapitre', 'PARTIES_num_partie'], 'examens_ak_1');
            $table->index(['PARTIES_num_partie', 'CHAPITRES_num_chapitre', 'COURS_num_cours'], 'examens_parties');
        });

        Schema::create('inscriptions_cours', function (Blueprint $table) {
            $table->comment('Cela correspond ├á l\'\'inscription des ├®tudiants ├á des cours. Si un cours est payant, l\'\'├®tudiant devra pay├® avant que son inscription ne soit effective.
Nous consid├®rons qu\'\'un ├®tudiant ne s\'\'inscrit pas deux fois ├á un m├¬me cours ce qui garantit l\'\'unicit├®.
Pour le sch├®ma logique, num_utilisateur, intitule_cours seront introduites en cl├®s ├®trang├¿res (FK) et identifiants secondaires (alternative unique keys) pour cette table.');
            $table->integer('num_inscription', true);
            $table->integer('UTILISATEURS_num_utilisateur')->comment('L\'\'identifiant de chaque utilisateur.');
            $table->integer('COURS_num_cours')->index('inscriptions_cours_cours');
            $table->decimal('montant_paye', 6)->comment('Correspond au prix du cours. Peut valoir 0 si le cours est gratuit. Ne peut pas avoir un nombre n├®gatif.');
            $table->boolean('paye')->comment('Vaut "True" si l├®tudiant a pay├® le montant du cours payant ou si le cours est gratuit (montant_paye = 0). Vaut "False" si l\'\'├®tudiant n\'\'a pas encore pay├® le montant d\'\'un cours payant.');
            $table->date('date_paiement')->comment('Il s\'\'agit de la date du paiement par l\'\'├®tudiant.');
            $table->boolean('inscription_valide')->comment('Si prix_cours vaut 0 ou si pay├® vaut "True" alors l\'\'inscription est valid├®e et vaut "True". Vaut "False" sinon.');
            $table->date('date_insc_cours')->comment('Repr├®sente la date de l\'\'inscription d\'\'un ├®tudiant ├á un cours.');

            $table->unique(['UTILISATEURS_num_utilisateur', 'COURS_num_cours'], 'inscriptions_cours_ak_1');
        });

        Schema::create('inscriptions_sessions', function (Blueprint $table) {
            $table->comment('Un ├®tudiant inscrit ├á un cours peut potentiellement s\'\'inscrire ├á une session.
Pour le sch├®ma logique, num_inscription, num_session et intitule_cours, seront introduites en cl├®s ├®trang├¿res (FK) et cl├®s primaires (PK) pour cette table.');
            $table->integer('SESSIONS_num_session')->comment('L\'\'identifiant des sessions.');
            $table->integer('INSCRIPTIONS_COURS_num_inscription')->index('inscriptions_cours_inscriptions_sessions');
            $table->integer('COURS_num_cours');
            $table->date('date_insc_session')->comment('Correspond ├á la date effective de l\'\'inscription d\'\'un ├®tudiant ├á une session.');

            $table->index(['SESSIONS_num_session', 'COURS_num_cours'], 'inscription_session');
            $table->primary(['SESSIONS_num_session', 'INSCRIPTIONS_COURS_num_inscription', 'COURS_num_cours']);
        });

        Schema::create('parties', function (Blueprint $table) {
            $table->comment('Les chapitres contiennent des parties. Il repr├®sentent des ├®l├®ments du cours avec un contenu textuel.
Pour le sch├®ma logique intitule_cours, num_chapitre, seront introduites en cl├®s ├®trang├¿res (FK) pour cette table dans le sch├®ma logique. Aussi, la cl├® primaire (PK)  sera compos├® de ces derni├¿res et de num_partie pour cette table afin d\'\'identifier de mani├¿re unique une partie P d\'\'un cours C ainsi que le chapitre dans lequel il se trouve.');
            $table->integer('COURS_num_cours');
            $table->integer('CHAPITRES_num_chapitre')->comment('Exemple : 1 pour chapitre 1. Permet d\'\'ordonner les chapitres (ordre croissant)');
            $table->integer('num_partie', true)->comment('Permet d\'\'ordonner par partie si besoin');
            $table->text('titre_partie');
            $table->text('contenu_partie');

            $table->index(['CHAPITRES_num_chapitre', 'COURS_num_cours'], 'parties_chapitres');
            $table->primary(['num_partie', 'CHAPITRES_num_chapitre', 'COURS_num_cours']);
        });

        Schema::create('progressions', function (Blueprint $table) {
            $table->comment('La progression permet ├á l\'\'├®tudiant de marquer une partie d\'\'un cours comme termin├® ou non.
Pour le sch├®ma logique num_utilisateur, intitule_cours, num_chapitre, num_partie seront introduites comme cl├®s ├®trang├¿res (FK) et cl├®s primaires (PK) pour cette table afin d\'\'identifier de mani├¿re unique quelle partie de quel cours, un ├®tudiant ├á termin├® (ou non).');
            $table->integer('UTILISATEURS_num_utilisateur')->index('utilsateurs_progressions')->comment('L\'\'identifiant de chaque utilisateur.');
            $table->integer('COURS_num_cours');
            $table->integer('CHAPITRES_num_chapitre');
            $table->integer('PARTIES_num_partie')->comment('Permet d\'\'ordonner par partie si besoin');
            $table->boolean('partie_termine');

            $table->index(['PARTIES_num_partie', 'CHAPITRES_num_chapitre', 'COURS_num_cours'], 'partie_progression');
            $table->primary(['PARTIES_num_partie', 'UTILISATEURS_num_utilisateur', 'COURS_num_cours', 'CHAPITRES_num_chapitre']);
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->comment('Il s\'\'agit des diff├®rents r├┤les que peuvent avoir les utilisateurs : cr├®ateurs de contenu, personnels administratifs, administrateurs, formateurs et ├®tudiants. ');
            $table->integer('num_role', true)->comment('L\'\'identifiant des diff├®rents r├┤les.
1 = administrateur
2 = cr├®ateurs de cours
3= personnels adnministratifs
4 = ├®tudiants
5 = formateurs');
            $table->text('role')->comment('Correspond aux diff├®rents r├┤les que les utilisateurs peuvent avoir : administrateur, cr├®ateurs de cours, personnels adnministratifs, ├®tudiants, formateurs');
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->comment('Les cours ont parfois des sessions en direct (en pr├®sentiel ou distanciel) avec un ou plusieurs formateurs.
Pour le sch├®ma logique, intitule_cours, sera introduit en cl├® ├®trang├¿re (FK) pour cette table dans le sch├®ma logique. Aussi, la cl├® primaire (PK)  sera compos├® de cette derni├¿re et de num_session pour cette table .');
            $table->integer('num_session', true)->comment('L\'\'identifiant des sessions.');
            $table->integer('COURS_num_cours')->index('sessions_cours');
            $table->text('format_session')->comment('Les sessions peuvent ├¬tre en "pr├®sentiel" ou "distanciel".');
            $table->dateTime('date_heure_debut')->comment('Se rapporte ├á la date et heure du d├®but de la session.');
            $table->dateTime('date_heure_fin')->comment('Se rapporte ├á la date et heure de fin de la session.');
            $table->integer('places_max')->nullable()->comment('Repr├®sente les places maximum qu\'\'une session peut avoir, lorsqu\'\'atteint les ├®tudiants ne peuvent plus s\'\'inscrire ├á la session. Une session n\'\'a pas toujours de places maximum, dans ce cas l├á places_max vaudra NULL.');

            $table->primary(['num_session', 'COURS_num_cours']);
        });

        Schema::create('tentatives_examens', function (Blueprint $table) {
            $table->comment('Cette entit├® retrace l\'\'historique de toutes les tentatives de tous les ├®tudiants effectu├®es pour tous les examens disponibles dans l\'\'entit├® examens.
L\'\'attribut score_obtenu est de type "Integer" avec une valeur entre 0 et 100.
On suppose qu\'\'un ├®tudiant a droit ├á une tentative par jour.
L\'\'attribut num_tentative retrace le nombre total de tentatives effectu├®es sur tous les cours par tous les ├®tudiants.
Pour le sch├®ma logique, num_utilisateur, num_examen, seront introduites en cl├®s ├®trang├¿res (FK) pour cette table dans le sch├®ma logique. Aussi, la cl├® primaire (PK)  sera compos├® de ces derni├¿res et de num_tentative pour cette table. Ceci permettra d\'\'identifier de mani├¿re unique une tentative d\'\'un examen effectu├®e par un ├®tudiant.');
            $table->integer('UTILISATEURS_num_utilisateur')->index('tentatives_examens_utilsateurs')->comment('L\'\'identifiant de chaque utilisateur.');
            $table->integer('EXAMENS_num_examen')->index('tentative_examen');
            $table->integer('num_tentative', true);
            $table->date('date_tentative');
            $table->integer('score_obtenu');
            $table->boolean('valide');

            $table->primary(['num_tentative', 'EXAMENS_num_examen', 'UTILISATEURS_num_utilisateur']);
        });

        Schema::create('utilisateurs', function (Blueprint $table) {
            $table->comment('Il s\'\'agit de tous les utilisateurs de la plateforme et de leurs informations personnelles associ├®es.');
            $table->integer('num_utilisateur', true)->comment('L\'\'identifiant de chaque utilisateur.');
            $table->text('nom')->comment('Le nom de chaque utilisateur. ');
            $table->text('prenom')->comment('Le pr├®nom d\'\'un utilisateur. S\'\'il a plusieurs pr├®noms, seul le premier pr├®nom est pris en compte.');
        });

        Schema::create('utilisateurs_cours', function (Blueprint $table) {
            $table->integer('UTILISATEURS_num_utilisateur')->comment('L\'\'identifiant de chaque utilisateur.');
            $table->integer('COURS_num_cours')->index('utilisateurs_cours_cours');

            $table->primary(['UTILISATEURS_num_utilisateur', 'COURS_num_cours']);
        });

        Schema::create('utilisateurs_roles', function (Blueprint $table) {
            $table->integer('UTILISATEURS_num_utilisateur')->comment('L\'\'identifiant de chaque utilisateur.');
            $table->integer('ROLES_num_role')->index('utilisateurs_roles_roles')->comment('L\'\'identifiant des diff├®rents r├┤les.
1 = administrateur
2 = cr├®ateurs de cours
3= personnels adnministratifs
4 = ├®tudiants
5 = formateurs');

            $table->primary(['UTILISATEURS_num_utilisateur', 'ROLES_num_role']);
        });

        Schema::table('assignations_cours', function (Blueprint $table) {
            $table->foreign(['COURS_num_cours'], 'ASSIGNATIONS_COURS_COURS')->references(['num_cours'])->on('cours')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['UTILISATEURS_num_utilisateur'], 'UTILSATEURS_ASSIGNATIONS_COURS')->references(['num_utilisateur'])->on('utilisateurs')->onUpdate('restrict')->onDelete('restrict');
        });

        Schema::table('assignations_sessions', function (Blueprint $table) {
            $table->foreign(['SESSIONS_num_session', 'COURS_num_cours'], 'SESSION_Assignation_Session')->references(['num_session', 'COURS_num_cours'])->on('sessions')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['UTILISATEURS_num_utilisateur'], 'UTILSATEURS_ASSIGNATIONS_SESSION')->references(['num_utilisateur'])->on('utilisateurs')->onUpdate('restrict')->onDelete('restrict');
        });

        Schema::table('avis_cours', function (Blueprint $table) {
            $table->foreign(['COURS_num_cours'], 'AVIS_COURS_COURS')->references(['num_cours'])->on('cours')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['UTILISATEURS_num_utilisateur'], 'UTILISATEURS_AVIS_COURS')->references(['num_utilisateur'])->on('utilisateurs')->onUpdate('restrict')->onDelete('restrict');
        });

        Schema::table('chapitres', function (Blueprint $table) {
            $table->foreign(['COURS_num_cours'], 'CHAPITRES_COURS')->references(['num_cours'])->on('cours')->onUpdate('restrict')->onDelete('restrict');
        });

        Schema::table('examens', function (Blueprint $table) {
            $table->foreign(['PARTIES_num_partie', 'CHAPITRES_num_chapitre', 'COURS_num_cours'], 'EXAMENS_PARTIES')->references(['num_partie', 'CHAPITRES_num_chapitre', 'COURS_num_cours'])->on('parties')->onUpdate('restrict')->onDelete('restrict');
        });

        Schema::table('inscriptions_cours', function (Blueprint $table) {
            $table->foreign(['COURS_num_cours'], 'INSCRIPTIONS_COURS_COURS')->references(['num_cours'])->on('cours')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['UTILISATEURS_num_utilisateur'], 'INSCRIPTIONS_COURS_UTILSATEURS')->references(['num_utilisateur'])->on('utilisateurs')->onUpdate('restrict')->onDelete('restrict');
        });

        Schema::table('inscriptions_sessions', function (Blueprint $table) {
            $table->foreign(['INSCRIPTIONS_COURS_num_inscription'], 'INSCRIPTIONS_COURS_INSCRIPTIONS_SESSIONS')->references(['num_inscription'])->on('inscriptions_cours')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['SESSIONS_num_session', 'COURS_num_cours'], 'INSCRIPTION_SESSION')->references(['num_session', 'COURS_num_cours'])->on('sessions')->onUpdate('restrict')->onDelete('restrict');
        });

        Schema::table('parties', function (Blueprint $table) {
            $table->foreign(['CHAPITRES_num_chapitre', 'COURS_num_cours'], 'PARTIES_CHAPITRES')->references(['num_chapitre', 'COURS_num_cours'])->on('chapitres')->onUpdate('restrict')->onDelete('restrict');
        });

        Schema::table('progressions', function (Blueprint $table) {
            $table->foreign(['PARTIES_num_partie', 'CHAPITRES_num_chapitre', 'COURS_num_cours'], 'PARTIE_PROGRESSION')->references(['num_partie', 'CHAPITRES_num_chapitre', 'COURS_num_cours'])->on('parties')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['UTILISATEURS_num_utilisateur'], 'UTILSATEURS_PROGRESSIONS')->references(['num_utilisateur'])->on('utilisateurs')->onUpdate('restrict')->onDelete('restrict');
        });

        Schema::table('sessions', function (Blueprint $table) {
            $table->foreign(['COURS_num_cours'], 'SESSIONS_COURS')->references(['num_cours'])->on('cours')->onUpdate('restrict')->onDelete('restrict');
        });

        Schema::table('tentatives_examens', function (Blueprint $table) {
            $table->foreign(['UTILISATEURS_num_utilisateur'], 'TENTATIVES_EXAMENS_UTILSATEURS')->references(['num_utilisateur'])->on('utilisateurs')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['EXAMENS_num_examen'], 'TENTATIVE_EXAMEN')->references(['num_examen'])->on('examens')->onUpdate('restrict')->onDelete('restrict');
        });

        Schema::table('utilisateurs_cours', function (Blueprint $table) {
            $table->foreign(['COURS_num_cours'], 'UTILISATEURS_COURS_COURS')->references(['num_cours'])->on('cours')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['UTILISATEURS_num_utilisateur'], 'UTILISATEURS_UTILISATEURS_COURS')->references(['num_utilisateur'])->on('utilisateurs')->onUpdate('restrict')->onDelete('restrict');
        });

        Schema::table('utilisateurs_roles', function (Blueprint $table) {
            $table->foreign(['ROLES_num_role'], 'UTILISATEURS_ROLES_ROLES')->references(['num_role'])->on('roles')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['UTILISATEURS_num_utilisateur'], 'UTILISATEURS_ROLES_UTILISATEURS')->references(['num_utilisateur'])->on('utilisateurs')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('utilisateurs_roles', function (Blueprint $table) {
            $table->dropForeign('UTILISATEURS_ROLES_ROLES');
            $table->dropForeign('UTILISATEURS_ROLES_UTILISATEURS');
        });

        Schema::table('utilisateurs_cours', function (Blueprint $table) {
            $table->dropForeign('UTILISATEURS_COURS_COURS');
            $table->dropForeign('UTILISATEURS_UTILISATEURS_COURS');
        });

        Schema::table('tentatives_examens', function (Blueprint $table) {
            $table->dropForeign('TENTATIVES_EXAMENS_UTILSATEURS');
            $table->dropForeign('TENTATIVE_EXAMEN');
        });

        Schema::table('sessions', function (Blueprint $table) {
            $table->dropForeign('SESSIONS_COURS');
        });

        Schema::table('progressions', function (Blueprint $table) {
            $table->dropForeign('PARTIE_PROGRESSION');
            $table->dropForeign('UTILSATEURS_PROGRESSIONS');
        });

        Schema::table('parties', function (Blueprint $table) {
            $table->dropForeign('PARTIES_CHAPITRES');
        });

        Schema::table('inscriptions_sessions', function (Blueprint $table) {
            $table->dropForeign('INSCRIPTIONS_COURS_INSCRIPTIONS_SESSIONS');
            $table->dropForeign('INSCRIPTION_SESSION');
        });

        Schema::table('inscriptions_cours', function (Blueprint $table) {
            $table->dropForeign('INSCRIPTIONS_COURS_COURS');
            $table->dropForeign('INSCRIPTIONS_COURS_UTILSATEURS');
        });

        Schema::table('examens', function (Blueprint $table) {
            $table->dropForeign('EXAMENS_PARTIES');
        });

        Schema::table('chapitres', function (Blueprint $table) {
            $table->dropForeign('CHAPITRES_COURS');
        });

        Schema::table('avis_cours', function (Blueprint $table) {
            $table->dropForeign('AVIS_COURS_COURS');
            $table->dropForeign('UTILISATEURS_AVIS_COURS');
        });

        Schema::table('assignations_sessions', function (Blueprint $table) {
            $table->dropForeign('SESSION_Assignation_Session');
            $table->dropForeign('UTILSATEURS_ASSIGNATIONS_SESSION');
        });

        Schema::table('assignations_cours', function (Blueprint $table) {
            $table->dropForeign('ASSIGNATIONS_COURS_COURS');
            $table->dropForeign('UTILSATEURS_ASSIGNATIONS_COURS');
        });

        Schema::dropIfExists('utilisateurs_roles');

        Schema::dropIfExists('utilisateurs_cours');

        Schema::dropIfExists('utilisateurs');

        Schema::dropIfExists('tentatives_examens');

        Schema::dropIfExists('sessions');

        Schema::dropIfExists('roles');

        Schema::dropIfExists('progressions');

        Schema::dropIfExists('parties');

        Schema::dropIfExists('inscriptions_sessions');

        Schema::dropIfExists('inscriptions_cours');

        Schema::dropIfExists('examens');

        Schema::dropIfExists('cours');

        Schema::dropIfExists('chapitres');

        Schema::dropIfExists('avis_cours');

        Schema::dropIfExists('assignations_sessions');

        Schema::dropIfExists('assignations_cours');
    }
};
