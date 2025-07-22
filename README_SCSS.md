# 🎨 Guide SCSS avec Composer

## Installation

### Prérequis
- PHP 8.1+
- Composer

### Installation des dépendances
```bash
composer install
```

## Utilisation

### Scripts Composer disponibles

```bash
# Compiler SCSS une seule fois (production)
composer build-css

# Surveiller et compiler automatiquement (développement) 
composer watch-css

# Ou simplement
composer dev
```

### Structure des fichiers SCSS

```
public/scss/
├── _variables.scss    # Variables (couleurs, tailles, breakpoints)
├── _mixins.scss       # Mixins réutilisables
└── styles.scss        # Fichier principal

scripts/
├── compile-scss.php   # Script de compilation
└── watch-scss.php     # Script de surveillance
```

## Fonctionnalités

### ✅ Compilation avec scssphp
- **Compilateur PHP pur** : Pas de dépendance Node.js
- **Compatibilité maximale** : Fonctionne avec toute installation PHP
- **Source maps** : Pour le debugging
- **CSS compressé** : Pour la production

### ✅ Variables SCSS
```scss
// Variables de couleurs
$color-primary: #0074c7;
$color-danger: #cd2c2e;
$color-success: #82b864;

// Variables d'espacement
$padding-base: 15px;
$border-radius: 8px;
```

### ✅ Mixins avancés
```scss
// Style de bouton personnalisé
.my-button {
  @include button-style($color-success);
}

// Responsive design
.my-element {
  font-size: 1.2rem;
  
  @include tablet {
    font-size: 1rem;
  }
  
  @include mobile {
    font-size: 0.9rem;
  }
}
```

### ✅ Surveillance automatique
Le script `watch-scss.php` surveille tous les fichiers `.scss` et recompile automatiquement lors des changements.

## Workflow de développement

### Mode développement
```bash
# Lancer la surveillance (dans un terminal)
composer dev
```

Le script affichera :
```
👀 Surveillance des fichiers SCSS démarrée...
📁 Répertoire surveillé : /path/to/public/scss/
🔄 Appuyez sur Ctrl+C pour arrêter

🔨 Compilation de styles.scss...
✅ Compilation réussie ! CSS généré : 1,605 octets
⏰ 20:59:32 - Prêt pour les changements
```

### Mode production
```bash
# Compilation unique optimisée
composer build-css
```

## Avantages de cette approche

### 🚀 **Intégration native PHP**
- Aucune dépendance Node.js
- S'intègre parfaitement dans l'écosystème PHP/Composer
- Compatible avec tous les environnements PHP

### 🔧 **Simplicité d'utilisation**
- Commandes Composer familières
- Scripts configurés dans `composer.json`
- Pas de configuration supplémentaire

### 📦 **Portabilité**
- Fonctionne sur tout serveur avec PHP
- Pas besoin d'installer des outils additionnels
- Installation simple avec `composer install`

### ⚡ **Performance**
- Compilation rapide avec scssphp
- CSS optimisé et compressé
- Source maps incluses

## Structure du projet

```
├── composer.json          # Dépendances et scripts
├── public/
│   ├── scss/              # Fichiers source SCSS
│   └── css/               # Fichiers CSS générés
└── scripts/
    ├── compile-scss.php   # Compilateur
    └── watch-scss.php     # Surveillance
```

## Personnalisation

### Ajouter de nouvelles variables
Modifiez `public/scss/_variables.scss` :
```scss
$my-custom-color: #ff6b6b;
$my-spacing: 20px;
```

### Créer de nouveaux mixins
Ajoutez dans `public/scss/_mixins.scss` :
```scss
@mixin my-custom-mixin($color) {
  background: $color;
  border: 1px solid darken($color, 10%);
}
```

### Utiliser dans le CSS
Dans `public/scss/styles.scss` :
```scss
.my-component {
  @include my-custom-mixin($my-custom-color);
  padding: $my-spacing;
}
```

## Commandes utiles

```bash
# Vérifier que SCSS est correctement installé
composer show scssphp/scssphp

# Voir la taille des fichiers générés
ls -lh public/css/

# Compiler en mode verbose (pour debugging)
php scripts/compile-scss.php
```

Cette approche vous offre toute la puissance de SCSS avec la simplicité et la robustesse de l'écosystème PHP ! 🎨 