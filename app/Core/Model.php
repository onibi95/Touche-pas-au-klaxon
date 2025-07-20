<?php
namespace App\Core;

/**
 * Classe de base pour les modèles.
 * Permet d'accéder à la base de données et de factoriser des méthodes génériques.
 */
abstract class Model
{
    /**
     * Retourne l'instance PDO de la base de données.
     * @return \PDO
     */
    protected static function db()
    {
        return Database::getInstance();
    }
    // Ici, on pourrait ajouter des méthodes CRUD génériques (find, all, save, delete, etc.)
}
