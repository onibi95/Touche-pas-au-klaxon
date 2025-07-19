<?php
namespace App\Models;

use App\Core\Database;

class Agence
{
    public static function getAll()
    {
        $db = Database::getInstance();
        $stmt = $db->query('SELECT id, nom FROM agences');
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
