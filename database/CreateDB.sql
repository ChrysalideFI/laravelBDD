-- Created by Vertabelo (http://vertabelo.com)
-- Last modification date: 2024-04-14 17:08:52.077

-- tables
-- Table: ASSIGNATIONS_COURS
CREATE TABLE ASSIGNATIONS_COURS (
    UTILISATEURS_num_utilisateur int  NOT NULL COMMENT 'L''''identifiant de chaque utilisateur.',
    COURS_num_cours int  NOT NULL,
    CONSTRAINT ASSIGNATIONS_COURS_pk PRIMARY KEY (UTILISATEURS_num_utilisateur,COURS_num_cours)
) COMMENT 'Il s''''agit de l''''assignation d''''un ou plusieurs formateurs à un cours.
Pour le schéma logique intitule_cours, num_utilisateur, seront introduites en clés étrangères (FK) et clés primaires (PK) pour cette table.';

-- Table: ASSIGNATIONS_SESSIONS
CREATE TABLE ASSIGNATIONS_SESSIONS (
    COURS_num_cours int  NOT NULL,
    UTILISATEURS_num_utilisateur int  NOT NULL COMMENT 'L''''identifiant de chaque utilisateur. ',
    SESSIONS_num_session int  NOT NULL COMMENT 'L''''identifiant des sessions.',
    CONSTRAINT ASSIGNATIONS_SESSIONS_pk PRIMARY KEY (SESSIONS_num_session,UTILISATEURS_num_utilisateur,COURS_num_cours)
) COMMENT 'Il s''''agit de l''''assignation d''''un ou plusieurs formateurs à une session.
Pour le schéma logique les attributs intitule_cours, num_utilisateur, num_session, seront introduites en clés étrangères (FK) et clés primaires (PK) pour cette table.';

-- Table: AVIS_COURS
CREATE TABLE AVIS_COURS (
    UTILISATEURS_num_utilisateur int  NOT NULL COMMENT 'L''''identifiant de chaque utilisateur.',
    COURS_num_cours int  NOT NULL,
    note_cours int  NOT NULL COMMENT 'Note, de 1 à 5, donnée par les étudiants sur le cours. ' CHECK (note_cours >= 1 AND note_cours <= 5),
    commentaire_cours longtext  NULL COMMENT 'De 0 à 5',
    CONSTRAINT AVIS_COURS_pk PRIMARY KEY (UTILISATEURS_num_utilisateur,COURS_num_cours)
) COMMENT 'Cela correspond à l''''avis donné par un étudiant sur un cours pour lequel il est inscrit. Les avis sont optionnels
L''''attribut note prends pour valeur un type "Integer" entre 1 et 5.
L''''attribut commentaire_cours lui reste optionnel laissant ainsi le choix à l''''étudiant d''''ajouter (ou pas) un commentaire en plus de la note attribuée au cours.
Pour le schéma logique intitule_cours, num_utilisateur, seront introduites en clés étrangères (FK) et clés primaires (PK) pour cette table pour reconnaître de manière unique la note et l''''éventuel commentaire qu''''un étudiant E attribut à un cours C.';

-- Table: CHAPITRES
CREATE TABLE CHAPITRES (
    COURS_num_cours int  NOT NULL,
    num_chapitre int  NOT NULL COMMENT 'Exemple : 1 pour chapitre 1. Permet d''''ordonner les chapitres (ordre croissant)',
    titre_chapitre varchar(255)  NOT NULL COMMENT 'Ajout de notre part, nous ne voyons pas un chapitre sans titre.',
    CONSTRAINT CHAPITRES_pk PRIMARY KEY (num_chapitre,COURS_num_cours)
) COMMENT 'Les cours contiennent des chapitres qui eux mêmes contiennent  des parties.
Un chapitre représente une subdivision d''''un cours et sert à regrouper les parties d''''un cours.
Pour le schéma logique intitule_cours sera introduit en clé étrangère (FK) pour cette table dans le schéma logique. Aussi, la clé primaire (PK)  sera composé de cette dernière et de num_chapitre pour cette table afin d''''identifier de manière unique, un chapitre d''''un cours.';

-- Table: COURS
CREATE TABLE COURS (
    num_cours int  NOT NULL,
    intitule_cours varchar(255)  NOT NULL COMMENT 'Identifiant d''''un cours, nous considérons que deux cours ne se nomment jamais de la même manière.',
    description varchar(255)  NOT NULL COMMENT 'Description du cours.',
    pre_requis longtext  NOT NULL COMMENT 'Pré-requis du cours.',
    prix_cours decimal(6,2)  NOT NULL COMMENT 'Correspond au prix du cours, vaut 0 si le cours est gratuit.' CHECK (prix_cours >=0),
    date_debut date  NULL COMMENT 'Date du début du cours (optionnel).',
    date_fin date  NULL COMMENT 'Date de fin du cours (optionnel).',
    visible varchar(3)  NULL COMMENT 'Le cours peut être visible ou non sur la plateforme.',
    `accessible` varchar(3)  NULL COMMENT 'L''''accessibilité dépend des dates de début et de fin d''''un cours. Si nous ne sommes pas entre la date de début et de fin de cours, le cours n''''est pas accessible et cet attribut vaudra "False".',
    CHECK (date_debut <= date_fin),
    CONSTRAINT COURS_pk PRIMARY KEY (num_cours)
) COMMENT 'Il s''''agit des cours sur la plateforme qui sont suivies par les étudiants, associés à des formateurs. Ils peuvent être commentés et notés. Ils sont réparties en chapitres. Ils peuvent parfois avoir des sessions associés. Pour suivre un cours il faut s''''y inscrire. Les cours peuvent être créer, éditer ou supprimer par certains types d''''utilisateurs (rôles d''''utilisateur).
Nous considérons que l''''intitulé de chaque cours est unique.';

-- Table: EXAMENS
CREATE TABLE EXAMENS (
    num_examen int  NOT NULL,
    COURS_num_cours int  NOT NULL,
    CHAPITRES_num_chapitre int  NOT NULL,
    PARTIES_num_partie int  NOT NULL COMMENT 'Permet d''''ordonner par partie si besoin',
    titre_exam varchar(255)  NOT NULL,
    contenu_exam longtext  NOT NULL,
    score_minimum int  NOT NULL CHECK (score_minimum>= 40 AND score_minimum<= 100),
    UNIQUE INDEX EXAMENS_ak_1 (COURS_num_cours,CHAPITRES_num_chapitre,PARTIES_num_partie),
    CONSTRAINT EXAMENS_pk PRIMARY KEY (num_examen)
) COMMENT 'Cette entité liste tous les examens qui ont été créés. Un examen porte sur une partie. L''''examen est optionnel : il y a des parties sans examens.
L''''attribut score_minimum est de type "Integer" avec une valeur entre 40 et 100.

Pour le schéma logique, intitule_cours, num_chapitre, num_partie seront introduites en clés étrangères (FK) et identifiants secondaires (alternative unique keys) pour cette table afin d''''identifier de manière unique, sur quelle partie porte un examen précis.';

-- Table: INSCRIPTIONS_COURS
CREATE TABLE INSCRIPTIONS_COURS (
    num_inscription int  NOT NULL,
    UTILISATEURS_num_utilisateur int  NOT NULL COMMENT 'L''''identifiant de chaque utilisateur.',
    COURS_num_cours int  NOT NULL,
    montant_paye decimal(6,2)  NOT NULL COMMENT 'Correspond au prix du cours. Peut valoir 0 si le cours est gratuit. Ne peut pas avoir un nombre négatif.',
    paye varchar(3)  NOT NULL COMMENT 'Vaut "True" si létudiant a payé le montant du cours payant ou si le cours est gratuit (montant_paye = 0). Vaut "False" si l''''étudiant n''''a pas encore payé le montant d''''un cours payant.',
    date_paiement date  NOT NULL COMMENT 'Il s''''agit de la date du paiement par l''''étudiant.',
    inscription_valide varchar(3)  NOT NULL COMMENT 'Si prix_cours vaut 0 ou si payé vaut "True" alors l''''inscription est validée et vaut "True". Vaut "False" sinon.',
    date_insc_cours date  NOT NULL COMMENT 'Représente la date de l''''inscription d''''un étudiant à un cours.',
    UNIQUE INDEX INSCRIPTIONS_COURS_ak_1 (UTILISATEURS_num_utilisateur,COURS_num_cours),
    CONSTRAINT INSCRIPTIONS_COURS_pk PRIMARY KEY (num_inscription)
) COMMENT 'Cela correspond à l''''inscription des étudiants à des cours. Si un cours est payant, l''''étudiant devra payé avant que son inscription ne soit effective.
Nous considérons qu''''un étudiant ne s''''inscrit pas deux fois à un même cours ce qui garantit l''''unicité.
Pour le schéma logique, num_utilisateur, intitule_cours seront introduites en clés étrangères (FK) et identifiants secondaires (alternative unique keys) pour cette table.';

-- Table: INSCRIPTIONS_SESSIONS
CREATE TABLE INSCRIPTIONS_SESSIONS (
    SESSIONS_num_session int  NOT NULL COMMENT 'L''''identifiant des sessions.',
    INSCRIPTIONS_COURS_num_inscription int  NULL,
    COURS_num_cours int  NOT NULL,
    date_insc_session date  NOT NULL COMMENT 'Correspond à la date effective de l''''inscription d''''un étudiant à une session.',
    CONSTRAINT INSCRIPTIONS_SESSIONS_pk PRIMARY KEY (SESSIONS_num_session,INSCRIPTIONS_COURS_num_inscription,COURS_num_cours)
) COMMENT 'Un étudiant inscrit à un cours peut potentiellement s''''inscrire à une session.
Pour le schéma logique, num_inscription, num_session et intitule_cours, seront introduites en clés étrangères (FK) et clés primaires (PK) pour cette table.';

-- Table: PARTIES
CREATE TABLE PARTIES (
    COURS_num_cours int  NOT NULL,
    CHAPITRES_num_chapitre int  NOT NULL COMMENT 'Exemple : 1 pour chapitre 1. Permet d''''ordonner les chapitres (ordre croissant)',
    num_partie int  NOT NULL COMMENT 'Permet d''''ordonner par partie si besoin',
    titre_partie varchar(255)  NOT NULL,
    contenu_partie longtext  NOT NULL,
    CONSTRAINT PARTIES_pk PRIMARY KEY (num_partie,CHAPITRES_num_chapitre,COURS_num_cours)
) COMMENT 'Les chapitres contiennent des parties. Il représentent des éléments du cours avec un contenu textuel.
Pour le schéma logique intitule_cours, num_chapitre, seront introduites en clés étrangères (FK) pour cette table dans le schéma logique. Aussi, la clé primaire (PK)  sera composé de ces dernières et de num_partie pour cette table afin d''''identifier de manière unique une partie P d''''un cours C ainsi que le chapitre dans lequel il se trouve.';

-- Table: PROGRESSIONS
CREATE TABLE PROGRESSIONS (
    UTILISATEURS_num_utilisateur int  NOT NULL COMMENT 'L''''identifiant de chaque utilisateur.',
    COURS_num_cours int  NOT NULL,
    CHAPITRES_num_chapitre int  NOT NULL,
    PARTIES_num_partie int  NOT NULL COMMENT 'Permet d''''ordonner par partie si besoin',
    partie_termine varchar(3)  NOT NULL,
    CONSTRAINT PROGRESSIONS_pk PRIMARY KEY (PARTIES_num_partie,UTILISATEURS_num_utilisateur,COURS_num_cours,CHAPITRES_num_chapitre)
) COMMENT 'La progression permet à l''''étudiant de marquer une partie d''''un cours comme terminé ou non.
Pour le schéma logique num_utilisateur, intitule_cours, num_chapitre, num_partie seront introduites comme clés étrangères (FK) et clés primaires (PK) pour cette table afin d''''identifier de manière unique quelle partie de quel cours, un étudiant à terminé (ou non).';

-- Table: ROLES
CREATE TABLE ROLES (
    num_role int  NOT NULL COMMENT 'L''''identifiant des différents rôles.
1 = administrateur
2 = créateurs de cours
3= personnels adnministratifs
4 = étudiants
5 = formateurs',
    role text  NOT NULL COMMENT 'Correspond aux différents rôles que les utilisateurs peuvent avoir : administrateur, créateurs de cours, personnels adnministratifs, étudiants, formateurs' CHECK (role IN ('Administrateur', 'Personnel administratif', 'Créateur de cours', 'Formateur', 'Étudiant')),
    CONSTRAINT ROLES_pk PRIMARY KEY (num_role)
) COMMENT 'Il s''''agit des différents rôles que peuvent avoir les utilisateurs : créateurs de contenu, personnels administratifs, administrateurs, formateurs et étudiants. ';

-- Table: SESSIONS
CREATE TABLE SESSIONS (
    num_session int  NOT NULL COMMENT 'L''''identifiant des sessions.',
    COURS_num_cours int  NOT NULL,
    format_session varchar(255)  NOT NULL COMMENT 'Les sessions peuvent être en "présentiel" ou "distanciel".',
    date_heure_debut datetime  NOT NULL COMMENT 'Se rapporte à la date et heure du début de la session.',
    date_heure_fin datetime  NOT NULL COMMENT 'Se rapporte à la date et heure de fin de la session.',
    places_max int  NULL COMMENT 'Représente les places maximum qu''''une session peut avoir, lorsqu''''atteint les étudiants ne peuvent plus s''''inscrire à la session. Une session n''''a pas toujours de places maximum, dans ce cas là places_max vaudra NULL.' CHECK (places_max>=0),
    CHECK (date_heure_debut <= date_heure_fin),
    CONSTRAINT SESSIONS_pk PRIMARY KEY (num_session,COURS_num_cours)
) COMMENT 'Les cours ont parfois des sessions en direct (en présentiel ou distanciel) avec un ou plusieurs formateurs.
Pour le schéma logique, intitule_cours, sera introduit en clé étrangère (FK) pour cette table dans le schéma logique. Aussi, la clé primaire (PK)  sera composé de cette dernière et de num_session pour cette table .';

-- Table: TENTATIVES_EXAMENS
CREATE TABLE TENTATIVES_EXAMENS (
    UTILISATEURS_num_utilisateur int  NOT NULL COMMENT 'L''''identifiant de chaque utilisateur.',
    EXAMENS_num_examen int  NOT NULL,
    num_tentative int  NOT NULL,
    date_tentative date  NOT NULL,
    score_obtenu int  NOT NULL CHECK (score_obtenu>= 0 AND score_obtenu<= 100),
    valide varchar(3)  NOT NULL,
    CONSTRAINT TENTATIVES_EXAMENS_pk PRIMARY KEY (num_tentative,EXAMENS_num_examen,UTILISATEURS_num_utilisateur)
) COMMENT 'Cette entité retrace l''''historique de toutes les tentatives de tous les étudiants effectuées pour tous les examens disponibles dans l''''entité examens.
L''''attribut score_obtenu est de type "Integer" avec une valeur entre 0 et 100.
On suppose qu''''un étudiant a droit à une tentative par jour.
L''''attribut num_tentative retrace le nombre total de tentatives effectuées sur tous les cours par tous les étudiants.
Pour le schéma logique, num_utilisateur, num_examen, seront introduites en clés étrangères (FK) pour cette table dans le schéma logique. Aussi, la clé primaire (PK)  sera composé de ces dernières et de num_tentative pour cette table. Ceci permettra d''''identifier de manière unique une tentative d''''un examen effectuée par un étudiant.';

-- Table: UTILISATEURS
CREATE TABLE UTILISATEURS (
    num_utilisateur int  NOT NULL COMMENT 'L''''identifiant de chaque utilisateur.',
    nom varchar(255)  NOT NULL COMMENT 'Le nom de chaque utilisateur. ',
    prenom varchar(255)  NOT NULL COMMENT 'Le prénom d''''un utilisateur. S''''il a plusieurs prénoms, seul le premier prénom est pris en compte.',
    CONSTRAINT UTILISATEURS_pk PRIMARY KEY (num_utilisateur)
) COMMENT 'Il s''''agit de tous les utilisateurs de la plateforme et de leurs informations personnelles associées.';

-- Table: UTILISATEURS_COURS
CREATE TABLE UTILISATEURS_COURS (
    UTILISATEURS_num_utilisateur int  NOT NULL COMMENT 'L''''identifiant de chaque utilisateur.',
    COURS_num_cours int  NOT NULL,
    CONSTRAINT UTILISATEURS_COURS_pk PRIMARY KEY (UTILISATEURS_num_utilisateur,COURS_num_cours)
);

-- Table: UTILISATEURS_ROLES
CREATE TABLE UTILISATEURS_ROLES (
    UTILISATEURS_num_utilisateur int  NOT NULL COMMENT 'L''''identifiant de chaque utilisateur.',
    ROLES_num_role int  NOT NULL COMMENT 'L''''identifiant des différents rôles.
1 = administrateur
2 = créateurs de cours
3= personnels adnministratifs
4 = étudiants
5 = formateurs',
    CONSTRAINT UTILISATEURS_ROLES_pk PRIMARY KEY (UTILISATEURS_num_utilisateur,ROLES_num_role)
);

-- foreign keys
-- Reference: ASSIGNATIONS_COURS_COURS (table: ASSIGNATIONS_COURS)
ALTER TABLE ASSIGNATIONS_COURS ADD CONSTRAINT ASSIGNATIONS_COURS_COURS FOREIGN KEY ASSIGNATIONS_COURS_COURS (COURS_num_cours)
    REFERENCES COURS (num_cours)
    ON DELETE CASCADE
    ON UPDATE CASCADE;

-- Reference: AVIS_COURS_COURS (table: AVIS_COURS)
ALTER TABLE AVIS_COURS ADD CONSTRAINT AVIS_COURS_COURS FOREIGN KEY AVIS_COURS_COURS (COURS_num_cours)
    REFERENCES COURS (num_cours)
    ON DELETE CASCADE
    ON UPDATE CASCADE;

-- Reference: CHAPITRES_COURS (table: CHAPITRES)
ALTER TABLE CHAPITRES ADD CONSTRAINT CHAPITRES_COURS FOREIGN KEY CHAPITRES_COURS (COURS_num_cours)
    REFERENCES COURS (num_cours)
    ON DELETE CASCADE
    ON UPDATE CASCADE;

-- Reference: EXAMENS_PARTIES (table: EXAMENS)
ALTER TABLE EXAMENS ADD CONSTRAINT EXAMENS_PARTIES FOREIGN KEY EXAMENS_PARTIES (PARTIES_num_partie,CHAPITRES_num_chapitre,COURS_num_cours)
    REFERENCES PARTIES (num_partie,CHAPITRES_num_chapitre,COURS_num_cours)
    ON DELETE CASCADE
    ON UPDATE CASCADE;

-- Reference: INSCRIPTIONS_COURS_COURS (table: INSCRIPTIONS_COURS)
ALTER TABLE INSCRIPTIONS_COURS ADD CONSTRAINT INSCRIPTIONS_COURS_COURS FOREIGN KEY INSCRIPTIONS_COURS_COURS (COURS_num_cours)
    REFERENCES COURS (num_cours)
    ON DELETE CASCADE
    ON UPDATE CASCADE;

-- Reference: INSCRIPTIONS_COURS_INSCRIPTIONS_SESSIONS (table: INSCRIPTIONS_SESSIONS)
ALTER TABLE INSCRIPTIONS_SESSIONS ADD CONSTRAINT INSCRIPTIONS_COURS_INSCRIPTIONS_SESSIONS FOREIGN KEY INSCRIPTIONS_COURS_INSCRIPTIONS_SESSIONS (INSCRIPTIONS_COURS_num_inscription)
    REFERENCES INSCRIPTIONS_COURS (num_inscription)
    ON DELETE CASCADE
    ON UPDATE CASCADE;

-- Reference: INSCRIPTIONS_COURS_UTILSATEURS (table: INSCRIPTIONS_COURS)
ALTER TABLE INSCRIPTIONS_COURS ADD CONSTRAINT INSCRIPTIONS_COURS_UTILSATEURS FOREIGN KEY INSCRIPTIONS_COURS_UTILSATEURS (UTILISATEURS_num_utilisateur)
    REFERENCES UTILISATEURS (num_utilisateur)
    ON DELETE CASCADE
    ON UPDATE CASCADE;

-- Reference: INSCRIPTION_SESSION (table: INSCRIPTIONS_SESSIONS)
ALTER TABLE INSCRIPTIONS_SESSIONS ADD CONSTRAINT INSCRIPTION_SESSION FOREIGN KEY INSCRIPTION_SESSION (SESSIONS_num_session,COURS_num_cours)
    REFERENCES SESSIONS (num_session,COURS_num_cours)
    ON DELETE CASCADE
    ON UPDATE CASCADE;

-- Reference: PARTIES_CHAPITRES (table: PARTIES)
ALTER TABLE PARTIES ADD CONSTRAINT PARTIES_CHAPITRES FOREIGN KEY PARTIES_CHAPITRES (CHAPITRES_num_chapitre,COURS_num_cours)
    REFERENCES CHAPITRES (num_chapitre,COURS_num_cours)
    ON DELETE CASCADE
    ON UPDATE CASCADE;

-- Reference: PARTIE_PROGRESSION (table: PROGRESSIONS)
ALTER TABLE PROGRESSIONS ADD CONSTRAINT PARTIE_PROGRESSION FOREIGN KEY PARTIE_PROGRESSION (PARTIES_num_partie,CHAPITRES_num_chapitre,COURS_num_cours)
    REFERENCES PARTIES (num_partie,CHAPITRES_num_chapitre,COURS_num_cours)
    ON DELETE CASCADE
    ON UPDATE CASCADE;

-- Reference: SESSIONS_COURS (table: SESSIONS)
ALTER TABLE SESSIONS ADD CONSTRAINT SESSIONS_COURS FOREIGN KEY SESSIONS_COURS (COURS_num_cours)
    REFERENCES COURS (num_cours)
    ON DELETE CASCADE
    ON UPDATE CASCADE;

-- Reference: SESSION_Assignation_Session (table: ASSIGNATIONS_SESSIONS)
ALTER TABLE ASSIGNATIONS_SESSIONS ADD CONSTRAINT SESSION_Assignation_Session FOREIGN KEY SESSION_Assignation_Session (SESSIONS_num_session,COURS_num_cours)
    REFERENCES SESSIONS (num_session,COURS_num_cours)
    ON DELETE CASCADE
    ON UPDATE CASCADE;

-- Reference: TENTATIVES_EXAMENS_UTILSATEURS (table: TENTATIVES_EXAMENS)
ALTER TABLE TENTATIVES_EXAMENS ADD CONSTRAINT TENTATIVES_EXAMENS_UTILSATEURS FOREIGN KEY TENTATIVES_EXAMENS_UTILSATEURS (UTILISATEURS_num_utilisateur)
    REFERENCES UTILISATEURS (num_utilisateur)
    ON DELETE CASCADE
    ON UPDATE CASCADE;

-- Reference: TENTATIVE_EXAMEN (table: TENTATIVES_EXAMENS)
ALTER TABLE TENTATIVES_EXAMENS ADD CONSTRAINT TENTATIVE_EXAMEN FOREIGN KEY TENTATIVE_EXAMEN (EXAMENS_num_examen)
    REFERENCES EXAMENS (num_examen)
    ON DELETE CASCADE
    ON UPDATE CASCADE;

-- Reference: UTILISATEURS_AVIS_COURS (table: AVIS_COURS)
ALTER TABLE AVIS_COURS ADD CONSTRAINT UTILISATEURS_AVIS_COURS FOREIGN KEY UTILISATEURS_AVIS_COURS (UTILISATEURS_num_utilisateur)
    REFERENCES UTILISATEURS (num_utilisateur)
    ON DELETE CASCADE
    ON UPDATE CASCADE;

-- Reference: UTILISATEURS_COURS_COURS (table: UTILISATEURS_COURS)
ALTER TABLE UTILISATEURS_COURS ADD CONSTRAINT UTILISATEURS_COURS_COURS FOREIGN KEY UTILISATEURS_COURS_COURS (COURS_num_cours)
    REFERENCES COURS (num_cours)
    ON DELETE CASCADE
    ON UPDATE CASCADE;

-- Reference: UTILISATEURS_ROLES_ROLES (table: UTILISATEURS_ROLES)
ALTER TABLE UTILISATEURS_ROLES ADD CONSTRAINT UTILISATEURS_ROLES_ROLES FOREIGN KEY UTILISATEURS_ROLES_ROLES (ROLES_num_role)
    REFERENCES ROLES (num_role)
    ON DELETE CASCADE
    ON UPDATE CASCADE;

-- Reference: UTILISATEURS_ROLES_UTILISATEURS (table: UTILISATEURS_ROLES)
ALTER TABLE UTILISATEURS_ROLES ADD CONSTRAINT UTILISATEURS_ROLES_UTILISATEURS FOREIGN KEY UTILISATEURS_ROLES_UTILISATEURS (UTILISATEURS_num_utilisateur)
    REFERENCES UTILISATEURS (num_utilisateur)
    ON DELETE CASCADE
    ON UPDATE CASCADE;

-- Reference: UTILISATEURS_UTILISATEURS_COURS (table: UTILISATEURS_COURS)
ALTER TABLE UTILISATEURS_COURS ADD CONSTRAINT UTILISATEURS_UTILISATEURS_COURS FOREIGN KEY UTILISATEURS_UTILISATEURS_COURS (UTILISATEURS_num_utilisateur)
    REFERENCES UTILISATEURS (num_utilisateur)
    ON DELETE CASCADE
    ON UPDATE CASCADE;

-- Reference: UTILSATEURS_ASSIGNATIONS_COURS (table: ASSIGNATIONS_COURS)
ALTER TABLE ASSIGNATIONS_COURS ADD CONSTRAINT UTILSATEURS_ASSIGNATIONS_COURS FOREIGN KEY UTILSATEURS_ASSIGNATIONS_COURS (UTILISATEURS_num_utilisateur)
    REFERENCES UTILISATEURS (num_utilisateur)
    ON DELETE CASCADE
    ON UPDATE CASCADE;

-- Reference: UTILSATEURS_ASSIGNATIONS_SESSION (table: ASSIGNATIONS_SESSIONS)
ALTER TABLE ASSIGNATIONS_SESSIONS ADD CONSTRAINT UTILSATEURS_ASSIGNATIONS_SESSION FOREIGN KEY UTILSATEURS_ASSIGNATIONS_SESSION (UTILISATEURS_num_utilisateur)
    REFERENCES UTILISATEURS (num_utilisateur)
    ON DELETE CASCADE
    ON UPDATE CASCADE;

-- Reference: UTILSATEURS_PROGRESSIONS (table: PROGRESSIONS)
ALTER TABLE PROGRESSIONS ADD CONSTRAINT UTILSATEURS_PROGRESSIONS FOREIGN KEY UTILSATEURS_PROGRESSIONS (UTILISATEURS_num_utilisateur)
    REFERENCES UTILISATEURS (num_utilisateur)
    ON DELETE CASCADE
    ON UPDATE CASCADE;

-- End of file.

