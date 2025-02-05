<?php

/* 

    2 - exit et die : Arrête l'exécution d'un script 

    Les fonctions exit() et die() en PHP sont utilisées pour arrêter immédiatement l'exécution d'un script. 
    Elles sont identiques sur leur fonctionnement

*/

// Arrêt du script avec exit 




echo "<h1>Avant le exit</h1>";
// Ici le if me permet de vérifier si un fichier existe (avant de lancer un traitement)
// Il n'existe pas donc je tombe dans le if et l'instruction exit (ou die) s'exécute et coupe totalement la suite de l'exécution du code 
// if(!file_exists("fichier.txt")) {
//     exit("Erreur, le fichier n'existe pas");
// }
echo "<h1>Après le exit</h1>";


echo "<h1>Avant le die</h1>";
if (!file_exists("fichier.txt")) {
    // header("location: index.php");
    die;
}
echo "<h1>Après le die</h1>";

// On utilisera très régulièrement die et exit lors des contrôles d'accès à nos pages
// Lors de l'accès à une page admin, je ferai toujours une vérification du rôle de l'utilisateur qui accède à cette page, s'il n'est pas admin, je le redirige et j'exit ou die le code immédiatement

// if (!$user->isAdmin()) {
//     // S'il n'est pas admin, mais arrive sur une page admin, je redirige et je die le code
//     header("location :index.php");
//     die;
// }

// if (!$user->isConnected()) {
//     // S'il n'est pas connecté et arrive sur une page nécessitant d'être connecté, par exemple page profil, je redirige et je die le code
//     header("location :index.php");
//     die;
// }

// Malgré la redirection, il serait possible pour l'utilisateur de récupérer un historique des pages sur lesquels il est passé et potentiellement récupérer des informations de la page même s'il ne l'a pas réellement vu à la navigation
// Avec un exit ou die, on s'assure qu'aucune information sensible ne lui sera affichée/envoyée

