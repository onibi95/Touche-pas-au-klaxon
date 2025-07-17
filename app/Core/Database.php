<?php
namespace App\Core;

use PDO;

class Database
{
    private static $instance = null;

    public static function getInstance()
    {
        if (self::$instance === null) {
            $config = require __DIR__ . '/../../config/config.php';
            try {
                self::$instance = new PDO(
                    'mysql:host='.$config['db_host'].';dbname='.$config['db_name'].';charset=utf8',
                    $config['db_user'],
                    $config['db_pass']
                );
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                echo "Connexion à la base de données réussie.<br>";
            } catch (\PDOException $e) {
                echo "Erreur de connexion à la base de données : " . $e->getMessage() . "<br>";
                die();
            }
        }
        return self::$instance;
    }
}
