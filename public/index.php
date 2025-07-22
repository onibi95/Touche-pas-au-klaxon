<?php
/**
 * Point d'entrée principal de l'application.
 * Configure et lance le routeur (Buki Router) pour toutes les routes publiques et admin.
 * Initialise l'autoloading et l'affichage des erreurs.
 */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';

use Buki\Router\Router;
use Symfony\Component\HttpFoundation\Response;
use App\Core\Session;

// Start session early to avoid headers already sent issues
Session::start();

// Initialisation
$router = new Router([
    'paths' => [
        'controllers' => __DIR__ . '/../app/Controllers',
    ],
    'namespaces' => [
        'controllers' => 'App\\Controllers',
    ],
]);

// Accueil
$router->get('/', 'TrajetController@index');

// Auth
$router->get('/login', 'AuthController@showLoginForm');
$router->post('/login', 'AuthController@login');
$router->get('/logout', 'AuthController@logout');

// Trajets
$router->get('/trajets', 'TrajetController@index');
$router->get('/trajet/create', 'TrajetController@create');
$router->post('/trajet/store', 'TrajetController@store');
$router->get('/trajet/edit/(:any)', 'TrajetController@edit');
$router->post('/trajet/update/(:any)', 'TrajetController@update');
$router->get('/trajet/delete/(:any)', 'TrajetController@delete');


// Admin
$router->get('/admin', 'AdminController@dashboard');
$router->get('/admin/users', 'AdminController@listUsers');
$router->get('/admin/agences', 'AdminController@listAgences');
$router->get('/admin/agence/create', 'AdminController@createAgence');
$router->post('/admin/agence/create', 'AdminController@createAgence');
$router->get('/admin/agence/edit/(:any)', 'AdminController@editAgence');
$router->post('/admin/agence/edit/(:any)', 'AdminController@updateAgence');
$router->get('/admin/agence/delete/(:any)', 'AdminController@deleteAgence');
$router->get('/admin/trajets', 'AdminController@listTrajets');
$router->get('/admin/trajet/delete/(:any)', 'AdminController@deleteTrajet');

// Lancer le routeur
$router->run();
