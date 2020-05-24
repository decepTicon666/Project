<?php

/* Wird nur einmal geladen mit require */
require __DIR__ . '/../init.php';

//Session wird gleich am anfang gestartet
session_start();

/* Route wird über REQUEST_URI geladen. Jeder Seite/Route wird der dazugehörige Controller und Funktion zugeordnet */
$path = str_replace('/index.php', '', $_SERVER['REQUEST_URI']);

$routes = [
    '/' => [
        'controller' => 'homeController',
        'method' => 'home'
    ],
    '/admin' => [
        'controller' => 'adminController',
        'method' => 'admin'
    ],
    '/login' => [
        'controller' => 'loginController',
        'method' => 'login'
    ],
    '/logout' => [
        'controller' => 'loginController',
        'method' => 'logout'
    ],
    '/dashboard' => [
        'controller' => 'loginController',
        'method' => 'dashboard'
    ],
    '/register' => [
        'controller' => 'registerController',
        'method' => 'show'
    ],
    '/passwordReset' => [
        'controller' => 'resetController',
        'method' => 'showReset'
    ],
    // todo: implement some logic for url parameters
    '/passwordChange' => [
        'controller' => 'resetController',
        'method' => 'showChange'
    ]
];

/* Abfrage des Arrays $routes und Auswahl der richtigen Route und des dementsprechenden Controllers */
if (isset($routes[$path])) {
    $route      = $routes[$path];
    $controller = $container->make($route['controller']);
    $method     = $route['method'];

    $controller->$method();
}
