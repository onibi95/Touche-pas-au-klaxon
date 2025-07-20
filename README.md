# Touche pas au klaxon

Application de covoiturage d'entreprise (MVC PHP)

## Description

Cette application permet aux utilisateurs de proposer, rechercher et gérer des trajets de covoiturage en entreprise. Un espace administrateur permet de gérer les utilisateurs, agences (villes) et trajets.

## Fonctionnalités principales
- Authentification (utilisateur/admin)
- Création, modification, suppression de trajets (par l'auteur)
- Liste des trajets disponibles
- Tableau de bord administrateur :
  - Gestion des utilisateurs
  - Gestion des agences (création, modification, suppression)
  - Gestion des trajets (suppression)
- Interface moderne et responsive

## Installation

1. **Cloner le dépôt**
   ```bash
   git clone <repo-url>
   cd Touche-pas-au-klaxon
   ```
2. **Installer les dépendances PHP**
   ```bash
   composer install
   ```
3. **Configurer la base de données**
   - Modifier `config/config.php` selon vos identifiants MySQL
   - Importer le schéma et les données :
     ```bash
     mysql -u <user> -p < database/migrations/create_tables.sql
     mysql -u <user> -p < database/seeds/seed_data.sql
     ```
4. **Lancer le serveur PHP**
   ```bash
   php -S localhost:8000 -t public
   ```
   Accéder à [http://localhost:8000](http://localhost:8000)

## Structure du projet

```
Touche-pas-au-klaxon/
├── app/
│   ├── Controllers/   # Contrôleurs MVC
│   ├── Core/          # Classes de base (Database, Router, etc.)
│   ├── Models/        # Modèles (User, Trajet, Agence)
│   └── Views/         # Vues (pages, partials)
├── config/            # Configuration (base de données)
├── database/          # Migrations et seeds SQL
├── public/            # Fichiers accessibles publiquement (index.php, assets)
├── tests/             # Tests unitaires PHPUnit
├── vendor/            # Dépendances Composer
└── README.md
```

## Dossier Core

Le dossier `app/Core` contient les briques fondamentales de l’application :

- `Database.php` : Singleton pour la connexion PDO à la base de données.
- `Model.php` : Classe abstraite de base pour tous les modèles, centralise l’accès à la base et prépare des méthodes génériques.
- `Controller.php` : Classe abstraite de base pour tous les contrôleurs, propose des helpers pour la redirection et les messages flash.
- `Session.php` : Classe utilitaire pour la gestion de la session et des messages flash.
- `View.php` : Classe utilitaire pour le rendu des vues avec passage de variables.
- `Router.php` : Squelette pour une éventuelle surcouche du routeur externe.

**Astuce :** Pour profiter de la factorisation, il suffit de faire hériter vos modèles de `App\Core\Model` et vos contrôleurs de `App\Core\Controller`.

## Tests unitaires

- Les tests PHPUnit couvrent les opérations d'écriture (insertion, modification, suppression) sur les trajets et agences.
- Pour lancer les tests :
  ```bash
  vendor/bin/phpunit --testdox tests/
  ```


## Auteurs
- Projet réalisé par Philippe M-D dans le cadre de la formation CENEF.
