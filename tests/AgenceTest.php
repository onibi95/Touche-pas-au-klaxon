<?php
use PHPUnit\Framework\TestCase;

final class AgenceTest extends TestCase
{
    public function testInsertUpdateDeleteAgence()
    {
        $db = \App\Core\Database::getInstance();
        // Insertion
        $stmt = $db->prepare("INSERT INTO agences (nom) VALUES (?)");
        $ok = $stmt->execute(['TestVille']);
        $this->assertTrue($ok);
        $id = $db->lastInsertId();
        // Vérification
        $stmt = $db->prepare('SELECT * FROM agences WHERE id = ?');
        $stmt->execute([$id]);
        $agence = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->assertNotEmpty($agence);
        $this->assertEquals('TestVille', $agence['nom']);
        // Modification
        $stmt = $db->prepare('UPDATE agences SET nom = ? WHERE id = ?');
        $ok = $stmt->execute(['VilleModifiee', $id]);
        $this->assertTrue($ok);
        $stmt = $db->prepare('SELECT * FROM agences WHERE id = ?');
        $stmt->execute([$id]);
        $agence = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->assertEquals('VilleModifiee', $agence['nom']);
        // Suppression
        $stmt = $db->prepare('DELETE FROM agences WHERE id = ?');
        $ok = $stmt->execute([$id]);
        $this->assertTrue($ok);
        $stmt = $db->prepare('SELECT * FROM agences WHERE id = ?');
        $stmt->execute([$id]);
        $agence = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->assertFalse($agence);
    }
}
