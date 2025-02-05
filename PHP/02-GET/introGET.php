<?php

/* 

Le protocole GET fait partie du protocole HTTP, utilisé pour récupérer des informations depuis un serveur. C'est une méthode courante pour intéragir avec une appli web, principalement pour retourner des ressources sans modification serveur.

Lorsqu'on s'intéresse au protocole GET via le web et le PHP, c'est surtout de la manipulation d'URL, quels sont les valeurs inscrites dans l'URL, la page elle même + des params sous forme de paire clé-valeur 

Structure d'une URL  
www.mapage.com/inscription.php?param1=value1&param2=value2  

Ici, on demande au serveur la page inscription.php  
Le "?" représente la fin de l'url de la page 
Ce qui suit, sont des informations que l'on peut récupérer en PHP ! à savoir  un array avec un clé param1 et sa valeur value1 et une clé param2 et sa valeur value2 

    - Caractéristiques de la méthode GET 

        Sécuritaire : Une requête GET ne modifie pas les données du serveur
        Visible dans l'URL : Les paramètres sont visibles dans l'url, ce qui est pratique pour le référencement et la comprehension de l'utilisateur sur sa position sur le site mais est moins sécurisé pour les informations sensibles 
        Limitation de taille : Les données envoyées sont limités à 2048 carac maximum 

    - Cas courant d'utilisation de GET 

        Affichage sur la page variant en fonction des param de GET, (exemple : categorie, fiche produit, filtre de recherche)
        Action simple : (Modification, Suppression, Visualisation par exemple sur une page de gestion utilisateur)

    - Get est préférable pour : 
        Les actions qui n'affectent pas l'état du serveur (recherche, filtre, accès à des pages publique)
        Quand les données ne sont pas sensible
        Quand on souhaite que l'URL soit partageable 

    - On considère souvent que GET représente les actions de type "clic" 
        Lorsqu'un utilisateur clique sur un filtre de produit dans une liste
        Pour un tri de produit dans une liste 
        Icones d'interface (suppression, modification etc)

    - Pour manipuler GET en PHP on utilise la superglobale $_GET
    - Les superglobales sont toutes des tableaux array !!! 
    - Attention $_GET existe TOUJOURS même si pas d'info dans l'url, ce sera alors un array vide
    - Sinon, je vais recevoir en clé, le nom du param envoyé dans le lien (cat) et en valeur de cette clé, la valeur associé (info, elec, jrdn)

*/

var_dump($_GET);
// echo $_GET["cat"]; Attention erreur si cat n'est pas défini dans GET ! On utilisera toujours un premier isset sur tous les éléments qu'on attend pour se protéger d'éventuelles erreurs 
$categorie = null;

if (isset($_GET["cat"])){ // Je m'assure de rentrer ici uniquement lorsque l'indice "cat" existe bel et bien dans $_GET
    $cat = $_GET["cat"];

    // Je définie la valeur de $categorie ici (surtout pas d'echo à ce niveau du code), et je l'echo plus bas dans mon html pour définir le titre de la page 
    if ($cat == "info") $categorie = "Informatique";
    elseif($cat == "elec") $categorie = "Electro Ménager";
    elseif($cat == "jrdn") $categorie = "Jardin";
    else $categorie = "Categorie non reconnue"; // Cas où la catégorie n'est pas reconnue si manipulation de l'url... (fausse categorie transmise)
}

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Pricing</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Catégories
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="introGET.php?cat=info">Informatique</a></li>
                            <li><a class="dropdown-item" href="?cat=elec">Electro-Menager</a></li>
                            <li><a class="dropdown-item" href="?cat=jrdn">Jardin</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <h1>
            <?php 
            if ($categorie == null) echo "Bienvenue sur notre site";
            else echo "Voici les produits de la catégorie :  $categorie" ;
            ?>
        </h1>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>