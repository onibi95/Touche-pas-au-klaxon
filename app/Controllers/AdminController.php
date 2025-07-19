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
        // Ajout d'une agence
    }
}
