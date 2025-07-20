<?php
namespace App\Controllers;

use Symfony\Component\HttpFoundation\Response;

class AdminController
{
    public function dashboard()
    {
        ob_start();
        include __DIR__ . '/../Views/admin/dashboard.php';
        $content = ob_get_clean();
        return new Response($content);
    }

    public function listUsers()
    {
        ob_start();
        include __DIR__ . '/../Views/admin/users.php';
        $content = ob_get_clean();
        return new Response($content);
    }

    public function listAgences()
    {
        ob_start();
        include __DIR__ . '/../Views/admin/agences.php';
        $content = ob_get_clean();
        return new Response($content);
    }

    public function createAgence()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = $_POST['nom'] ?? '';
            if (empty($nom)) {
                $_SESSION['error'] = "Le nom de l'agence est requis.";
                header('Location: /admin/agence/create');
                exit;
            }
            $db = \App\Core\Database::getInstance();
            $stmt = $db->prepare('INSERT INTO agences (nom) VALUES (?)');
            $ok = $stmt->execute([$nom]);
            if ($ok) {
                header('Location: /admin/agences');
                exit;
            } else {
                $_SESSION['error'] = "Erreur lors de la création de l'agence.";
                header('Location: /admin/agence/create');
                exit;
            }
        } else {
            ob_start();
            include __DIR__ . '/../Views/admin/agence_create.php';
            $content = ob_get_clean();
            return new Response($content);
        }
    }

    public function editAgence($id)
    {
        $db = \App\Core\Database::getInstance();
        $stmt = $db->prepare('SELECT * FROM agences WHERE id = ?');
        $stmt->execute([$id]);
        $agence = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (!$agence) {
            $_SESSION['error'] = "Agence introuvable.";
            header('Location: /admin/agences');
            exit;
        }
        ob_start();
        include __DIR__ . '/../Views/admin/agence_edit.php';
        $content = ob_get_clean();
        return new Response($content);
    }

    public function updateAgence($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = $_POST['nom'] ?? '';
            if (empty($nom)) {
                $_SESSION['error'] = "Le nom de l'agence est requis.";
                header('Location: /admin/agence/edit/' . $id);
                exit;
            }
            $db = \App\Core\Database::getInstance();
            $stmt = $db->prepare('UPDATE agences SET nom = ? WHERE id = ?');
            $ok = $stmt->execute([$nom, $id]);
            if ($ok) {
                header('Location: /admin/agences');
                exit;
            } else {
                $_SESSION['error'] = "Erreur lors de la modification de l'agence.";
                header('Location: /admin/agence/edit/' . $id);
                exit;
            }
        } else {
            header('Location: /admin/agences');
            exit;
        }
    }

    public function deleteAgence($id)
    {
        $db = \App\Core\Database::getInstance();
        $stmt = $db->prepare('DELETE FROM agences WHERE id = ?');
        $stmt->execute([$id]);
        header('Location: /admin/agences');
        exit;
    }

    public function listTrajets()
    {
        ob_start();
        include __DIR__ . '/../Views/admin/trajets.php';
        $content = ob_get_clean();
        return new Response($content);
    }

    public function deleteTrajet($id)
    {
        $db = \App\Core\Database::getInstance();
        $stmt = $db->prepare('DELETE FROM trajets WHERE id = ?');
        $stmt->execute([$id]);
        header('Location: /admin/trajets');
        exit;
    }
}
