<?php
/*******************************************************************************
Le sujet est assez basique :

- Page de connexion
- Lors d'une connexion réussie, la date de dernière connexion est mise à jour et
on est redirigé sur la page principale si le mot de passe dans la base
correspond au mot de passe entré et si l'utilisateur fait partie du groupe 2.
Si l'authentification échoue, on retourne sur la page de connexion et un message
d'erreur s'affiche.
- Une fois connecté, une phrase mal orthographiée est affichée. Cliquer dessus la
corrige.
- On peut ensuite se déconnecter, on est alors redirigé vers la page de connexion.

Tu es libre de faire le test à ta manière le but étant de nous montrer ce que tu sais faire
*******************************************************************************/

require dirname(__DIR__).'/vendor/autoload.php';
use App\Controller\HomeController;
use App\Controller\SecurityController;
use App\Router;
use App\Container;
use App\App;

ini_set('display_errors', 1);
session_save_path('/var/www/html/sessions');
$container = new Container();
$router    = new Router($container);

$router->registerRoutes(
    [
        HomeController::class,
        SecurityController::class
    ]
);


(new App(
    $container,
    $router,
    ['uri' => $_SERVER['REQUEST_URI'], 'method' => $_SERVER['REQUEST_METHOD']],
))->run();
