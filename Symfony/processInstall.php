<?php 

// Pour vérifier notre version de PHP
// Pour utiliser la version de Symfony que l'on utilisera dans le cours (la 6.4), il faut absolument PHP en version AU MOINS 8.2

// phpinfo() nous écrit diverses informations sur notre version de php, notamment le numéro de version en haut de page
// Il faut ouvrir cette page via localhost
phpinfo();


// Installation de composer
// https://getcomposer.org/
// Windows :
// Download -> setup.exe -> installation
// Mac : 
// Par le terminal via brew (installer brew si vous ne l'avez pas déjà : https://brew.sh/)
// brew install composer

// Pour tester si l'installation a fonctionnée, tapez dans un terminal "composer" 
// Si ça répond quelque chose avec COMPOSER écrit en gros, c'est bon !


// Installation de Symfony CLI (Command Line Interface)
// https://symfony.com/download
// Windows : 
// Installez d'abord scoop (soft qui vous permez des installations via ligne de commande)
// https://scoop.sh/
// Puis lancez la commande : scoop install symfony-cli
// Mac : 
// Lancez la commande via brew : brew install symfony-cli/tap/symfony-cli

// Relancez entièrement votre VS Code


// Ouvrez un terminal dans VS Code
// Tapez symfony check:requirements 
// S'il vous répond un message 
//  [OK]
//  Your system is ready to run Symfony projects
// C'est bon ! Symfony est prêt à être installé !



// -------------------- Création d'un projet Symfony --------------------------

// Les lignes de commandes ci dessous vont nous permettre d'installer diverses installations de symfony 

//  --- Création d'un projet minimal
// symfony new MonProjet
// composer create-project symfony/skeleton MonProjet 

// ---- Création d'un projet symfony "full"  "webapp"  en gros, qui inclue déjà tous les composants/bundles de base que l'on peut souhaiter avoir dans une application web 
// symfony new --webapp MonProjet

// ------ Création projet version spécifique 
// symfony new --webapp MonProjetSF4 --version=5.4
// symfony new --webapp MonProjetLTS --version=lts     (c'est la 6.4 en ce moment)
// LTS = Long Term Support

// On va créer notre projet 
// symfony new --webapp BiblioSF6 --version=lts




// ----------------------- LES COMMANDES DE SYMFONY ----------------------------

// ATTENTION TOUJOURS SE POSITIONNER AVEC LE TERMINAL A LA RACINE DU PROJET SYMFONY !!!


// Pour lancer le serveur symfony 
// symfony serve

// Pour créer un controller
// symfony console make:controller 

// pour stopper le terminal bloqué par le lancement du serveur
// Ctrl + C 
// Pour être sûr d'avoir fermé le serveur 
// symfony server:stop

// Pour créer la base de données (une fois qu'on l'a définie dans le .env)
// symfony console doctrine:database:create

// Pour créer une entité
// symfony console make:entity

// Pour créer une migration
// symfony console make:migration

// Pour valider une migration
// symfony console doctrine:migrations:migrate

// Pour créer un form automatique de symfony
// symfony console make:form

// Pour créer une page Home 
// symfony console make:controller Home

// Pour créer un "user" c'est la classe qui définira notre système d'inscription/connexion
// symfony console make:user

// Création du système d'authentification rattaché au user (Abonne)
// symfony console make:auth

// Création du formulaire d'inscription 
// symfony console make:registration-form