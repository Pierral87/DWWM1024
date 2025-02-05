<?php 

/* 

    Le système de session en PHP est un mécanisme qui permet de maintenir des informations entre le serveur et le client tout au long de sa navigation, peut importe qu'il change de page ou pas.
    En PHP on a à nouveau une superglobale associée à ce système de session, $_SESSION, encore une fois, c'est un array !!! 
    C'est un array qui est vide par défaut et dans lequel je peux stocker toutes les informations que je souhaite.
    Ces informations pourront m'aider à réinterpréter certains éléments sur mon site web, tout au long de la navigation de l'utilisateur 

    Une session est utilisée pour : 

        - Stocker des informations utilisateurs (des données de connexion, le contenu d'un panier d'achat)
        - Gérer des états utilisateurs (connecté ou pas, admin ou pas, maintient de connexion ou pas)
        - Protéger des données sensibles que l'on ne souhaiterait pas forcément visualiser dans un cookie ou des URL 

    Fonctionnement d'une session : 

        - Démarrage d'une session : avec l'instruction session_start(), c'est ce qui active la session (ou la reconnecte si elle existe déjà) et nous mets à disposition $_SESSION, sinon elle est inexistante. Le démarrage de session va créer un cookie sur le navigateur avec un identifiant ainsi qu'un fichier sur le serveur avec ce même identifiant 

        - $_SESSION se comporte comme un array associatif, on peut ajouter/modifier/supprimer des informations comme on le souhaite 

        - Persistance entre les pages : Tant que la session est active (jusqu'à ce qu'elle soit destroy), ces informations seront accessibles sur toutes les pages 

*/

// session_start() : Démarre une nouvelle session ou reconnecte une session existante.




// session_start() nous donne accès à $_SESSION, je peux manipuler ce array comme je veux 
// $_SESSION["username"] = "Pierra";
// echo $_SESSION["username"];
// unset($_SESSION["username"]);
var_dump($_SESSION);

// session_destroy() : Détruit toutes les données de la session sur le serveur. 
// session_destroy();

// session_regenerate_id() : Change l'ID de la session pour renforcer la sécurité et éviter les fixation de session (récupération par quelqu'un d'autres, de votre ID de session pour usurper votre compte)
// Attention à ne pas lancer cette instruction trop souvent, sinon on pourra avoir des pertes de synchro de nos informations
// On lancera plutôt cette instruction après des actions "lourdes", une connexion, une modification d'information, une commande passée, un message posté etc 
// session_regenerate_id(true);

// var_dump($_COOKIE);

// Etendre la durée de vie de la session pour maintenir la connexion  
// Attention il faut lancer ces instructions de durée de vie des cookie et fichier id serveur avant l'initialisation de la session
ini_set("session.cookie_lifetime", 30 * 24 * 60 * 60); // Augmente la durée de vie du cookie session 
ini_set("session.gc_maxlifetime", 30 * 24 * 60 * 60); // Augmente la durée de vie du fichier de session serveur 
session_start(); 

// PHP possède un système de "nettoyage automatique" des fichiers de session sur le serveur par le procédé du "GC" - "Garbage Collection"
// En gros, à chaque opération sur les sessions serveur, il y a une petite probabilité que l'opération de nettoyage se lance et supprimer tous les fichiers de sessions expirés du serveur 


?>