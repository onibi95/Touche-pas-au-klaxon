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
                t.id,
                t.utilisateur_id,
                ad.nom AS agence_depart,
                a.nom AS agence_arrivee,
                t.date_depart,
                t.heure_depart,
                t.date_arrivee,
                t.heure_arrivee,
                t.places_disponibles,
                t.places_total,
                u.prenom AS user_prenom,
                u.nom AS user_nom,
                u.telephone AS user_telephone,
                u.email AS user_email
            FROM trajets t
            JOIN agences ad ON t.agence_depart_id = ad.id
            JOIN agences a ON t.agence_arrivee_id = a.id
            JOIN utilisateurs u ON t.utilisateur_id = u.id
        ");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function getById($id)
    {
        $db = Database::getInstance();
        $stmt = $db->prepare("
            SELECT 
                t.id,
                t.utilisateur_id,
                t.agence_depart_id,
                t.agence_arrivee_id,
                t.date_depart,
                t.heure_depart,
                t.date_arrivee,
                t.heure_arrivee,
                t.places_total,
                t.places_disponibles,
                u.prenom AS user_prenom,
                u.nom AS user_nom,
                u.email AS user_email,
                u.telephone AS user_telephone
            FROM trajets t
            JOIN utilisateurs u ON t.utilisateur_id = u.id
            WHERE t.id = ?
        ");
        $stmt->execute([$id]);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result;
    }

    public static function deleteById($id)
    {
        $db = Database::getInstance();
        $stmt = $db->prepare('DELETE FROM trajets WHERE id = ?');
        return $stmt->execute([$id]);
    }
}