<?php
/**
 * Script de surveillance et compilation automatique SCSS
 */

require_once __DIR__ . '/compile-scss.php';

class ScssWatcher
{
    private $scssDir;
    private $lastModified = [];

    public function __construct()
    {
        $this->scssDir = __DIR__ . '/../public/scss/';
    }

    public function watch()
    {
        echo "👀 Surveillance des fichiers SCSS démarrée...\n";
        echo "📁 Répertoire surveillé : {$this->scssDir}\n";
        echo "🔄 Appuyez sur Ctrl+C pour arrêter\n\n";

        // Compilation initiale
        $this->compileScss();

        // Boucle de surveillance
        while (true) {
            if ($this->checkForChanges()) {
                echo "\n🔄 Changement détecté, recompilation...\n";
                $this->compileScss();
            }
            
            // Attendre 1 seconde avant de vérifier à nouveau
            sleep(1);
        }
    }

    private function checkForChanges(): bool
    {
        $changed = false;
        $files = $this->getScssFiles();

        foreach ($files as $file) {
            $modTime = filemtime($file);
            
            if (!isset($this->lastModified[$file]) || $this->lastModified[$file] !== $modTime) {
                $this->lastModified[$file] = $modTime;
                $changed = true;
                echo "📝 Fichier modifié : " . basename($file) . "\n";
            }
        }

        return $changed;
    }

    private function getScssFiles(): array
    {
        $files = [];
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($this->scssDir, RecursiveDirectoryIterator::SKIP_DOTS)
        );

        foreach ($iterator as $file) {
            if ($file->getExtension() === 'scss') {
                $files[] = $file->getPathname();
            }
        }

        return $files;
    }

    private function compileScss()
    {
        try {
            $compiler = new ScssCompiler();
            $compiler->compile();
            echo "⏰ " . date('H:i:s') . " - Prêt pour les changements\n";
        } catch (Exception $e) {
            echo "❌ Erreur : " . $e->getMessage() . "\n";
        }
    }
}

// Gestion des signaux pour un arrêt propre
if (function_exists('pcntl_signal')) {
    pcntl_signal(SIGINT, function() {
        echo "\n👋 Arrêt de la surveillance SCSS\n";
        exit(0);
    });
}

// Démarrage de la surveillance
$watcher = new ScssWatcher();
$watcher->watch(); 