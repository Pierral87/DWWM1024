<?php

/*

On peut aussi simplement stocker les informations dans un fichier s'il n'y a rien de sensible grâce aux fonctions "f"   fopen fwrite fclose pour manipuler des fichiers 
Structure du code avec fichier

Les données seront enregistrées dans un fichier texte (par exemple commentaires.txt) sous forme de lignes, chaque ligne représentant un enregistrement avec le format :
    pseudo|message|date

*/

$req = '';
// - 04 - Récupération des saisies du form avec controle 
if (isset($_POST['pseudo']) && isset($_POST['message'])) {
    $pseudo = trim($_POST['pseudo']);
    $message = trim($_POST['message']);
    $date = date('d/m/Y à H:i:s');

    // Préparation de la ligne à écrire
    $ligne = "$pseudo|$message|$date" . PHP_EOL;

    // Ouverture du fichier en mode ajout
    $fichier = fopen('commentaires.txt', 'a');
    if ($fichier) {
        fwrite($fichier, $ligne);
        fclose($fichier);
    }
}

// - 06 - Requete de récupération des messages afin de les afficher dans cette page
$commentaires = [];
if (file_exists('commentaires.txt')) {
    // Lecture des lignes du fichier
    $lignes = file('commentaires.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lignes as $ligne) {
        // Chaque ligne est séparée par des "|"
        list($pseudo, $message, $date) = explode('|', $ligne);
        $commentaires[] = [
            'pseudo' => htmlspecialchars($pseudo),
            'message' => htmlspecialchars($message),
            'date' => htmlspecialchars($date),
        ];
    }
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <!-- Google font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <!-- Playfair display -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500&display=swap" rel="stylesheet">
    <!-- Roboto -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        * {
            font-family: 'Roboto', sans-serif;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Playfair Display', serif;
        }
    </style>

    <title>Dialogue</title>
</head>

<body class="bg-secondary">
    <div class="container bg-light g-0">
        <div class='row '>
            <div class="col-12">
                <h2 class="text-center text-dark fs-1 bg-light p-5 border-bottom"><i class="far fa-comments"></i> Espace de dialogue <i class="far fa-comments"></i></h2>
                <form method="post" class="mt-5 mx-auto w-50 border p-3 bg-white">

                    <?php echo $req; // on affiche la requete pour voir les injections SQL 
                    ?>

                    <hr>
                    <div class="mb-3">
                        <label for="pseudo" class="form-label">Pseudo <i class="fas fa-user-alt"></i></label>
                        <input type="text" class="form-control" id="pseudo" name="pseudo">
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message <i class="fas fa-feather-alt"></i></label>
                        <textarea class="form-control" id="message" name="message"></textarea>
                    </div>
                    <div class="mb-3">
                        <hr>
                        <button type="submit" class="btn btn-secondary w-100" id="enregistrer" name="enregistrer"><i class="fas fa-keyboard"></i> Enregistrer <i class="fas fa-keyboard"></i></button>
                    </div>
                </form>
            </div>
        </div>
        <div class='row mt-5'>
            <div class="col-12">
                <!-- Affichage des commentaire -->
                <p class="w-75 mx-auto mb-3"><?php
                                                // - 08 - Affichage en haut des messages du nombre de message présent dans la bdd
                                                echo 'il y a : <b>' . sizeof($commentaires) . '</b> messages';
                                                ?></p>
                <?php
                // var_dump($commentaires);
                // - 07 - Affichage des commentaire avec un peu mise en forme
                foreach ($commentaires as $commentaire) {
                    echo '<div class="card w-75 mx-auto mb-3">
                                    <div class="card-header bg-dark text-white">
                                        Par : ' . htmlspecialchars($commentaire['pseudo']) . ', le : ' . $commentaire['date'] . '
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text">' . htmlspecialchars($commentaire['message']) . '</p>
                                    </div>
                                </div>';
                }


                ?>

            </div>
        </div>
    </div>


    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>

<?php 

/*
1. Les différents formats de stockage

Les formats de stockage servent à organiser et structurer les données pour les lire, écrire ou échanger facilement. Voici les principaux formats que tu peux rencontrer :
a) Bases de données relationnelles (SQL)

    Description : Données organisées en tables avec colonnes et lignes. Le langage SQL est utilisé pour interagir.
    Exemples : MySQL, SQLite, PostgreSQL, SQL Server.
    Avantages :
        Très structuré.
        Supporte des relations complexes entre les données.
        Puissant pour les gros volumes de données.
    Inconvénients :
        Moins flexible pour les structures de données très dynamiques.

        b) Bases de données NoSQL

    Description : Données stockées sous forme non relationnelle (clé-valeur, documents, colonnes, graphes).
    Exemples : MongoDB (JSON-like documents), Redis (clé-valeur), Neo4j (graphes).
    Avantages :
        Plus flexible pour les données dynamiques.
        Performant pour des données massives et non structurées.
    Inconvénients :
        Moins adapté pour des relations complexes.

        c) Fichiers plats

    Description : Données stockées dans des fichiers texte simples. Les formats peuvent être bruts ou organisés.
    Exemples de formats :
        CSV (Comma-Separated Values) : Données tabulaires (colonnes et lignes séparées par des virgules).
        JSON (JavaScript Object Notation) : Structure hiérarchique lisible pour échanger des données entre systèmes.
        XML (Extensible Markup Language) : Données organisées en balises, souvent utilisé pour les échanges avec des services.
        YAML : Similaire à JSON mais plus lisible pour les humains.
    Avantages :
        Simplicité d’utilisation.
        Idéal pour des petits volumes de données ou des échanges entre systèmes.
    Inconvénients :
        Moins performant pour des gros volumes.
        Nécessite souvent un traitement pour être exploité.

        d) Mémoire et cache

    Description : Données stockées temporairement en mémoire (RAM) pour accélérer les accès.
    Exemples : Sessions PHP ($_SESSION), cache système (Redis, Memcached).
    Avantages :
        Très rapide.
        Idéal pour des données temporaires.
    Inconvénients :
        Perte de données en cas de redémarrage du serveur.

        e) Fichiers binaires

    Description : Données encodées de manière non lisible par un humain.
    Exemples : Images, fichiers .dat spécifiques à des logiciels.
    Avantages :
        Efficace pour stocker des données complexes ou massives.
    Inconvénients :
        Nécessite un logiciel spécifique pour les lire.
*/