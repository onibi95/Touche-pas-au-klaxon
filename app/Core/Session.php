<?php
namespace App\Core;

/**
 * Classe utilitaire pour la gestion de la session et des messages flash.
 */
class Session
{
    /**
     * Démarre la session si besoin.
     */
    public static function start()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Récupère l'utilisateur connecté (ou null).
     */
    public static function user()
    {
        self::start();
        return $_SESSION['user'] ?? null;
    }

    /**
     * Définit un message flash.
     */
    public static function flash($message)
    {
        self::start();
        $_SESSION['flash'] = $message;
    }

    /**
     * Récupère et supprime le message flash.
     */
    public static function getFlash()
    {
        self::start();
        if (!empty($_SESSION['flash'])) {
            $msg = $_SESSION['flash'];
            unset($_SESSION['flash']);
            return $msg;
        }
        return null;
    }
}
