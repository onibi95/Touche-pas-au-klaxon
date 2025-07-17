<?php
namespace App\Models;

use PDO;
use App\Core\Database;

class Trajet
{
    public static function getAvailable()
    {
        $db = Database::getInstance();
        $stmt = $db->query("
            SELECT 
                ad.nom AS agence_depart,
                a.nom AS agence_arrivee,
                t.date_depart,
                t.heure_depart,
                t.date_arrivee,
                t.heure_arrivee,
                t.places_disponibles
            FROM trajets t
            JOIN agences ad ON t.agence_depart_id = ad.id
            JOIN agences a ON t.agence_arrivee_id = a.id
        ");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
