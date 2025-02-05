<?php 
session_start();
if (!isset($_SESSION["users"])) {
    $_SESSION["users"] = array(
        ['id' => 0, 'nom' => 'Dupont', 'email' => 'dupont@example.com'],
        ['id' => 1, 'nom' => 'Durand', 'email' => 'durand@example.com'],
        ['id' => 2, 'nom' => 'Martin', 'email' => 'martin@example.com']
    );
}
// Il faut changer cette const pour la faire correspondre à votre arborescence 
define("URL", "http://localhost/loki/PHPOO/10-MVC/");