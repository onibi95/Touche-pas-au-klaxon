<?php
use PHPUnit\Framework\TestCase;

/**
 * Classe de test unitaire pour les opérations sur les trajets.
 * Couvre l'insertion, la modification et la suppression en base.
 */
final class TrajetTest extends TestCase
{
    /**
     * Vérifie que la méthode getAvailable retourne bien un tableau.
     */
    public function testGetAvailableReturnsArray()
    {
        $result = \App\Models\Trajet::getAvailable();
        $this->assertIsArray($result);
    }

    /**
     * Teste l'insertion puis la suppression d'un trajet en base de données.
     * Vérifie la présence après insertion et l'absence après suppression.
     */
    public function testInsertAndDeleteTrajet()
    {
        $db = \App\Core\Database::getInstance();
        
        $stmt = $db->prepare("INSERT INTO trajets (agence_depart_id, agence_arrivee_id, date_depart, heure_depart, date_arrivee, heure_arrivee, places_total, places_disponibles, utilisateur_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $ok = $stmt->execute([
            1, 2, '2030-01-01', '10:00:00', '2030-01-01', '12:00:00', 5, 5, 2
        ]);
        $this->assertTrue($ok);
        $id = $db->lastInsertId();
        // Vérifie que le trajet existe
        $trajet = \App\Models\Trajet::getById($id);
        $this->assertNotEmpty($trajet);
        $this->assertEquals(1, $trajet['agence_depart_id']);
        $this->assertEquals(2, $trajet['agence_arrivee_id']);
        // Suppression
        $deleted = \App\Models\Trajet::deleteById($id);
        $this->assertTrue($deleted);
        $trajet = \App\Models\Trajet::getById($id);
        $this->assertFalse($trajet);
    }

    /**
     * Teste la modification (update) d'un trajet en base de données.
     * Vérifie que les champs modifiés sont bien mis à jour.
     */
    public function testUpdateTrajet()
    {
        $db = \App\Core\Database::getInstance();
        // Insertion d'un trajet de test
        $stmt = $db->prepare("INSERT INTO trajets (agence_depart_id, agence_arrivee_id, date_depart, heure_depart, date_arrivee, heure_arrivee, places_total, places_disponibles, utilisateur_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $ok = $stmt->execute([
            1, 2, '2030-02-01', '09:00:00', '2030-02-01', '11:00:00', 3, 3, 2
        ]);
        $this->assertTrue($ok);
        $id = $db->lastInsertId();
        // Modification du trajet
        $stmt = $db->prepare("UPDATE trajets SET places_total = ?, places_disponibles = ? WHERE id = ?");
        $ok = $stmt->execute([6, 6, $id]);
        $this->assertTrue($ok);
        $trajet = \App\Models\Trajet::getById($id);
        $this->assertEquals(6, $trajet['places_total']);
        $this->assertEquals(6, $trajet['places_disponibles']);
        // Nettoyage
        \App\Models\Trajet::deleteById($id);
    }
}
