<?php
/**
 * Script de compilation SCSS vers CSS avec scssphp
 */

require_once __DIR__ . '/../vendor/autoload.php';

use ScssPhp\ScssPhp\Compiler;
use ScssPhp\ScssPhp\OutputStyle;

class ScssCompiler
{
    private $compiler;
    private $inputDir;
    private $outputDir;

    public function __construct()
    {
        $this->compiler = new Compiler();
        $this->inputDir = __DIR__ . '/../public/scss/';
        $this->outputDir = __DIR__ . '/../public/css/';
        
        // Configuration du compilateur
        $this->compiler->setImportPaths($this->inputDir);
        $this->compiler->setOutputStyle(OutputStyle::COMPRESSED);
        
        // Activer les source maps
        $this->compiler->setSourceMap(Compiler::SOURCE_MAP_FILE);
        $this->compiler->setSourceMapOptions([
            'sourceMapWriteTo' => $this->outputDir . 'styles.css.map',
            'sourceMapURL' => 'styles.css.map',
            'sourceMapFilename' => 'styles.css',
            'sourceMapBasepath' => dirname($this->outputDir),
            'sourceRoot' => '../scss/'
        ]);
    }

    public function compile()
    {
        try {
            $inputFile = $this->inputDir . 'styles.scss';
            $outputFile = $this->outputDir . 'styles.css';

            if (!file_exists($inputFile)) {
                throw new Exception("Fichier SCSS introuvable : $inputFile");
            }

            // Créer le répertoire de sortie s'il n'existe pas
            if (!is_dir($this->outputDir)) {
                mkdir($this->outputDir, 0755, true);
            }

            // Lire le fichier SCSS
            $scss = file_get_contents($inputFile);

            // Compiler
            echo "🔨 Compilation de styles.scss...\n";
            $css = $this->compiler->compileString($scss);
            
            // Écrire le fichier CSS
            file_put_contents($outputFile, $css->getCss());
            
            // Écrire la source map
            if ($css->getSourceMap()) {
                file_put_contents($this->outputDir . 'styles.css.map', $css->getSourceMap());
            }

            $size = filesize($outputFile);
            echo "✅ Compilation réussie ! CSS généré : " . number_format($size) . " octets\n";
            echo "📁 Fichier : $outputFile\n";

        } catch (Exception $e) {
            echo "❌ Erreur de compilation : " . $e->getMessage() . "\n";
            exit(1);
        }
    }
}

// Exécution
$compiler = new ScssCompiler();
$compiler->compile(); 