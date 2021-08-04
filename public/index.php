<?php

// ici le front controller

// on récupère les dépendances composer en allant chercher le fichier vendor/autoload
// Ce fichier sera toujours le même quel que soit le projet, quelles que soient les dépendances que vous installez
// ici, on commence par remonter dans le dossier parent car vendor se situe à côté de public, où on se trouve actuellement
require __DIR__.'/../vendor/autoload.php';

// maintenant que j'utilise des contrôleurs, je vais les inclure ici au fur et à mesure de leur création
require __DIR__.'/../app/Controllers/MainController.php';

$router = new AltoRouter();

// étape importante à c/c dans chaque projet utilisant AltoRouter
// déterminer quelle partie de l'url ne doit pas être prise en charge par le routeur (cas où votre projet est dans un sous-dossier)
$router->setBasePath(dirname($_SERVER['SCRIPT_NAME']));

// on écrit quelques routes en faisant correspondre chaque url à une action
// pour les actions, ce sont pour l'instant de simples strings, on choisit juste son séparateur préféré et on s'y tient (::, @ et # sont 3 bons candidats)

/********************
Routeur : 
un rond point quoi tu as une vois qui t'amene sur plusieurs sortie
 */
// En prenant la méthaphore du rond-point, 
// je créer ici les "sorties" avec les "panneaux"
// 1. GET/POST
// 2. URL donné par l'utilisateur après analyse du routeur ex : '/'
// 3. la destination de l'utilisateur :    
    /*
    [
        "method" => "home",
        "controller" => "MainController"
    ] 
    */
$router->map('GET', '/', ["method" => "home", "controller" => "MainController"]);
$router->map('GET', '/apropos', ["method" => "about", "controller" => "MainController"]);
$router->map('GET', '/tagada', ["method" => "tagada", "controller" => "MainController"]);


$router->map('GET', '/apropos/auteur', 
[
    'controller' => 'MainController',
    'method' => 'author',
]);

$router->map('GET', '/Prof/JB', 
[
    'controller' => 'MainController',
    'method' => 'prof',
]);

// on demande au routeur si l'url par laquelle on est arrivé correspond à une route
// le routeur compare par rapport au 2eme paramètre
$match = $router->match();

// var_dump($match);
/* exemple de $match :
array (size=3)
  'target' => 
    array (size=2)
      'method' => string 'home' (length=4)
      'controller' => string 'MainController' (length=14)
*/

// petit test très simple pour savoir si ça a marché
if ($match) {
    // echo un message, c'est bien...
    // dispatcher l'action, c'est mieux !

    // l'info se trouve dans la case target du tableau $match
    $action = $match['target'];

    // on récupère dans le tableau $match['target'] les infos
    $routeurInformations = $match['target'];

    $nomDuControleur = $routeurInformations['controller'];
    $nomDeLaMethode = $routeurInformations['method'];

    // et c'est parti, on crée le contrôleur et on lance la méthode
    $controller = new $nomDuControleur(); // PHP remplace dynamiquement la variable par sa valeur et instancie donc toujours le bon contrôleur
    // ==> $controller = new MainController();
    $controller->$nomDeLaMethode(); // même principe, on appelle la méthode dynamiquement, en fonction de ce que contient la variable
    // ==> $controller->home();

} else {
    // pas besoin de dynamisme ici, c'est toujours le même contrôleur qu'on instancie, et toujours la même méthode qu'on lance ;-)
    $controller = new MainController();
    $controller->err404();
}