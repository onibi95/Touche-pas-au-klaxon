<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';

use Buki\Router\Router;
use Symfony\Component\HttpFoundation\Response;

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
$router->post('/trajet/update/{:any}', 'TrajetController@update');
$router->get('/trajet/delete/(:any)', 'TrajetController@delete');


// Admin
$router->get('/admin', 'AdminController@dashboard');
$router->get('/admin/users', 'AdminController@listUsers');
$router->get('/admin/agences', 'AdminController@listAgences');
$router->post('/admin/agence/create', 'AdminController@createAgence');

// Lancer le routeur
$router->run();
