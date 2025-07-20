<?php
namespace App\Core;

/**
 * Classe utilitaire pour le rendu des vues.
 */
class View
{
    /**
     * Affiche une vue avec des variables extraites.
     * @param string $file Chemin de la vue
     * @param array $vars Variables à passer à la vue
     */
    public static function render($file, $vars = [])
    {
        extract($vars);
        ob_start();
        include $file;
        return ob_get_clean();
    }
}
