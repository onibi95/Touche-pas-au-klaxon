<?php
namespace App\Controllers;

use App\Models\Trajet;
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
        ob_start();
        include __DIR__ . '/../Views/trajets/create.php';
        $content = ob_get_clean();
        return new Response($content);
    }

    public function store()
    {
        // Exemple de sauvegarde
        
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
        // Exemple de suppression
    }
}
