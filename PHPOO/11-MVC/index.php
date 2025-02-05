<?php

use ProjetMVC\Controller\UserController;

// Ici index.php c'est le point d'entrée de mon architecture
// L'utilisateur ne bouge pas de page en page, mais c'est le contenu des pages qui vient à lui sur index.php 

// On appelle l'autoload de composer 
require("vendor/autoload.php");
require("inc/config.php");

// On défini ici les controllers qui existent dans notre app pour gérer le routage
$controllers = ["user", "product"];

// Cette condition me permet de gérer le routage, à savoir, quel Controller est à utiliser et donc qu'est ce que je vais amener comme données à l'utilisateur par rappport à son scénario d'accès à mon site 
if (isset($_GET["ctrl"]) && in_array($_GET["ctrl"], $controllers))
 {
    if ($_GET["ctrl"] == "product") $controller = new ProductController;
    elseif ($_GET["ctrl"] == "user") $controller = new UserController;
 } else {
    $controller = new UserController;
 }

// require("template.php");

// Après initialisation je lance la méthode handleRequest() de mon Controller qui me permet de comprendre le scénario d'utilisation de mon utilisateur 
$controller->handleRequest();