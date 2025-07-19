<?php
namespace App\Controllers;

use App\Models\Trajet;
use App\Models\Agence;
use Symfony\Component\HttpFoundation\Response;

class TrajetController
{
    public function index()
    {
        $trajets = Trajet::getAvailable();
        ob_start();
        include __DIR__ . '/../Views/trajets/index.php';
        $content = ob_get_clean();
        return new Response($content);
    }

    public function create()
    {
        $agences = Agence::getAll();
        ob_start();
        include __DIR__ . '/../Views/trajets/create.php';
        $content = ob_get_clean();
        return new Response($content);
    }

    public function store()
    {
        {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $agence_depart = $_POST['agence_depart'] ?? '';
                $agence_arrivee = $_POST['agence_arrivee'] ?? '';
                $date_depart = $_POST['date_depart'] ?? '';
                $heure_depart = $_POST['heure_depart'] ?? '';
                $date_arrivee = $_POST['date_arrivee'] ?? '';
                $heure_arrivee = $_POST['heure_arrivee'] ?? '';
                $places_total = $_POST['places_total'] ?? '';
                $user_id = $_SESSION['user']['id'] ?? null;
    
                $errors = [];
                // Contrôles de cohérence
                if ($agence_depart === $agence_arrivee) {
                    $errors[] = "L'agence de départ et d'arrivée doivent être différentes.";
                }
                $dt_dep = strtotime($date_depart . ' ' . $heure_depart);
                $dt_arr = strtotime($date_arrivee . ' ' . $heure_arrivee);
                if ($dt_arr <= $dt_dep) {
                    $errors[] = "La date/heure d'arrivée doit être après la date/heure de départ.";
                }
                if ($places_total < 1) {
                    $errors[] = "Le nombre de places doit être supérieur à 0.";
                }
                if (!$user_id) {
                    $errors[] = "Utilisateur non authentifié.";
                }
                if (count($errors) === 0) {
                    // Insertion en base
                    $db = \App\Core\Database::getInstance();
                    $stmt = $db->prepare("INSERT INTO trajets (agence_depart_id, agence_arrivee_id, date_depart, heure_depart, date_arrivee, heure_arrivee, places_total, places_disponibles, utilisateur_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                    $ok = $stmt->execute([
                        $agence_depart,
                        $agence_arrivee,
                        $date_depart,
                        $heure_depart,
                        $date_arrivee,
                        $heure_arrivee,
                        $places_total,
                        $places_total, // places_disponibles = total au départ
                        $user_id
                    ]);
                    if ($ok) {
                        // Redirection vers la liste des trajets
                        return new Response('', 302, ['Location' => '/trajets']);
                    } else {
                        $errors[] = "Erreur lors de l'enregistrement du trajet.";
                    }
                }
                // S'il y a des erreurs, on réaffiche le formulaire avec les messages
                $agences = \App\Models\Agence::getAll();
                ob_start();
                include __DIR__ . '/../Views/trajets/create.php';
                $content = ob_get_clean();
                return new Response($content);
            } else {
                // Redirection si accès direct
                return new Response('', 302, ['Location' => '/trajet/create']);
            }
        }
        
    }

    public function edit($id)
    {
        ob_start();
        include __DIR__ . '/../Views/trajets/edit.php';
        $content = ob_get_clean();
        return new Response($content);
    }

    public function update($id)
    {
        // Exemple de mise à jour
    }

    public function delete($id)
    {
        \App\Models\Trajet::deleteById($id);
        return new \Symfony\Component\HttpFoundation\Response('', 302, ['Location' => '/trajets']);
    }
}
