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
- Interface moderne et responsive avec thème personnalisé (SCSS)

## Installation

### Option 1: Installation avec Docker (Recommandée)

1. **Cloner le dépôt**
   ```bash
   git clone <repo-url>
   cd Touche-pas-au-klaxon
   ```

2. **Configurer l'environnement**
   ```bash
   cp .env.example .env
   # Modifier .env si nécessaire
   ```

3. **Lancer avec Docker Compose**
   ```bash
   docker-compose up -d
   ```

4. **Accéder à l'application**
   - Application web : [http://localhost:8080](http://localhost:8080)
   - phpMyAdmin : [http://localhost:8081](http://localhost:8081)

La base de données sera automatiquement initialisée avec le schéma et les données de test.

### Option 2: Installation manuelle

1. **Cloner le dépôt**
   ```bash
   git clone <repo-url>
   cd Touche-pas-au-klaxon
   ```
2. **Installer les dépendances PHP**
   ```bash
   composer install
   ```

3. **Compiler les styles SCSS**
   ```bash
   composer build-css
   ```

4. **Configurer la base de données**
   - Modifier `config/config.php` selon vos identifiants MySQL
   - Importer le schéma et les données :
     ```bash
     mysql -u <user> -p < database/migrations/create_tables.sql
     mysql -u <user> -p < database/seeds/seed_data.sql
     ```

5. **Lancer le serveur PHP**
   ```bash
   php -S localhost:8000 -t public
   ```
   Accéder à [http://localhost:8000](http://localhost:8000)

## Configuration Docker

L'application utilise Docker Compose avec les services suivants :

- **web** : Application PHP 8.2 avec Apache (port 8080)
- **db** : MySQL 8.0 (port 3306)
- **phpmyadmin** : Interface d'administration MySQL (port 8081)

### Variables d'environnement

Copiez `.env.example` vers `.env` et ajustez les valeurs :

```bash
DB_HOST=db
DB_NAME=covoiturage
DB_USER=covoiturage_user
DB_PASS=covoiturage_password
MYSQL_ROOT_PASSWORD=root_password
```

### Commandes Docker utiles

```bash
# Démarrer les services
docker-compose up -d

# Voir les logs
docker-compose logs -f

# Arrêter les services
docker-compose down

# Reconstruire l'image
docker-compose build --no-cache

# Accéder au conteneur web
docker-compose exec web bash

# Accéder au conteneur de base de données
docker-compose exec db mysql -u covoiturage_user -p covoiturage

# Compiler les styles SCSS dans le conteneur
docker-compose exec web composer build-css

# Surveiller les styles SCSS dans le conteneur
docker-compose exec web composer dev
```

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
├── docker/            # Configuration Docker
├── public/            # Fichiers accessibles publiquement (index.php, assets)
├── tests/             # Tests unitaires PHPUnit
├── vendor/            # Dépendances Composer
├── Dockerfile         # Configuration du conteneur PHP
├── docker-compose.yml # Configuration des services Docker
└── README.md
```

## Gestion des styles (SCSS)

L'application utilise SCSS pour la gestion des styles, compilé via Composer avec `scssphp`.

### Structure des styles
```
public/
├── scss/              # Fichiers source SCSS
│   ├── _variables.scss    # Variables (couleurs, tailles)
│   ├── _mixins.scss       # Mixins réutilisables
│   └── styles.scss        # Fichier principal
└── css/               # Fichiers CSS générés
    ├── styles.css         # CSS compilé et compressé
    └── styles.css.map     # Source map pour debugging
```

### Commandes disponibles

```bash
# Compilation unique (production)
composer build-css

# Surveillance automatique (développement)
composer dev
# ou
composer watch-css
```

### Développement
1. Lancez la surveillance automatique : `composer dev`
2. Modifiez les fichiers `.scss` dans `public/scss/`
3. Le CSS est automatiquement recompilé dans `public/css/`

> 📚 **Guide détaillé** : Consultez `README_SCSS.md` pour la documentation complète des variables, mixins et exemples d'utilisation.

## Dossier Core

Le dossier `app/Core` contient les briques fondamentales de l'application :

- `Database.php` : Singleton pour la connexion PDO à la base de données.
- `Model.php` : Classe abstraite de base pour tous les modèles, centralise l'accès à la base et prépare des méthodes génériques.
- `Controller.php` : Classe abstraite de base pour tous les contrôleurs, propose des helpers pour la redirection et les messages flash.
- `Session.php` : Classe utilitaire pour la gestion de la session et des messages flash.
- `View.php` : Classe utilitaire pour le rendu des vues avec passage de variables.
- `Router.php` : Squelette pour une éventuelle surcouche du routeur externe.

**Astuce :** Pour profiter de la factorisation, il suffit de faire hériter vos modèles de `App\Core\Model` et vos contrôleurs de `App\Core\Controller`.

## Tests unitaires

- Les tests PHPUnit couvrent les opérations d'écriture (insertion, modification, suppression) sur les trajets et agences.
- Pour lancer les tests :
  ```bash
  vendor/bin/phpunit --testdox tests/
  ```

## Auteurs
- Projet réalisé par Philippe M-D dans le cadre de la formation CENEF.
