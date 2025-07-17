<?php
namespace App\Controllers;

use Symfony\Component\HttpFoundation\Response;

class AuthController
{
    public function showLoginForm()
    {
        ob_start();
        include __DIR__ . '/../Views/auth/login.php';
        $content = ob_get_clean();
        return new Response($content);
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $db = \App\Core\Database::getInstance();
            $stmt = $db->prepare("SELECT * FROM utilisateurs WHERE email = :email LIMIT 1");
            $stmt->execute(['email' => $email]);
            $user = $stmt->fetch(\PDO::FETCH_ASSOC);

            if ($user) {
                var_dump($user);
                if (password_verify($password, $user['mot_de_passe'])) {
                    session_start();
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_role'] = $user['role'];
                    $_SESSION['user_nom'] = $user['nom'];
                    // Redirection vers la page d'accueil ou admin
                    return new \Symfony\Component\HttpFoundation\Response('', 302, ['Location' => '/']);
                } else {
                    // Affiche le formulaire avec un message d'erreur
                    ob_start();
                    $error = "Identifiants invalides";
                    include __DIR__ . '/../Views/auth/login.php';
                    $content = ob_get_clean();
                    return new \Symfony\Component\HttpFoundation\Response($content);
                }
            } else {
                // Affiche le formulaire avec un message d'erreur
                ob_start();
                $error = "Identifiants invalides";
                include __DIR__ . '/../Views/auth/login.php';
                $content = ob_get_clean();
                return new \Symfony\Component\HttpFoundation\Response($content);
            }
        } else {
            // Si la méthode n'est pas POST, on affiche le formulaire
            return $this->showLoginForm();
        }
    }

    public function logout()
    {
        session_start();
        session_destroy();
        return new Response('', 302, ['Location' => '/']);
    }
}
