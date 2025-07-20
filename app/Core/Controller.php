<?php
namespace App\Core;

/**
 * Classe de base pour les contrôleurs.
 * Permet de factoriser des helpers communs (redirection, flash, etc.).
 */
abstract class Controller
{
    /**
     * Redirige vers une URL donnée.
     * @param string $url
     */
    protected function redirect($url)
    {
        header('Location: ' . $url);
        exit;
    }

    /**
     * Définit un message flash en session.
     * @param string $message
     */
    protected function setFlash($message)
    {
        $_SESSION['flash'] = $message;
    }
}
