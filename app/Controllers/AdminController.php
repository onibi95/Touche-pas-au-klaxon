<?php
namespace App\Controllers;

class AdminController
{
    public function dashboard()
    {
        include __DIR__ . '/../Views/admin/dashboard.php';
    }

    public function listUsers()
    {
        include __DIR__ . '/../Views/admin/users.php';
    }

    public function listAgences()
    {
        include __DIR__ . '/../Views/admin/agences.php';
    }

    public function createAgence()
    {
        // Ajout d'une agence
    }
}
