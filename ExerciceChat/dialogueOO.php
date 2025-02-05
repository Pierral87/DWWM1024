<?php


/*
Version 2 en partie en orienté objet
*/


// J'inclus dans ma page le fichier Commentaire.class.php pour accéder à ses fonctionnalités
require_once("Classes/Commentaire.class.php");

// - 02 - Créer une connexion à cette base avec PDO 
$host = "mysql:host=localhost;dbname=dialogue2"; // service mysql, host localhost, nom de la db
$login = "root"; // login de connexion
$password = ""; // password de connexion 
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // Gestion des erreurs 
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // Mode par défaut du fetch 
);


try {
    $pdo = new PDO($host, $login, $password, $options);
} catch (PDOException $e) {
    // var_dump($pdo);
    echo "Site indisponible, repassez plus tard";
    die;
}

// J'initialise mon objet à vide (parce que je l'utilise déjà en bas de page pour afficher les messages d'erreur, de validation etc, si undefined = erreur)
$commentaire = new Commentaire;
$msg = "";
$req = "";


// - 04 - Récupération des saisies du form avec controle 
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["pseudo"], $_POST["message"])) {

    $pseudo = trim($_POST["pseudo"]);
    $message = trim($_POST["message"]);

    // Explicatif V2 en Orienté Objet 
    
    // Instanciation de l'objet Commentaire, je donne à son constructeur les données reçues par le form
    $commentaire = new Commentaire($pseudo, $message);

    // checkForm() me permet de faire toutes la validation des valeurs saisies par l'utilisateur, pas de valeur vide, pas de pseudo trop court trop long
    // Grâce à checkForm, on insère dans les props de Commentaire, msg et error, les bonnes valeurs
    // la prop error contiendra false si pas d'erreur, true si erreur
    // la prop msg contiendra rien ou des messages d'erreur s'il y en a
    $commentaire->checkForm();

    // getError me retourne true ou false basé sur la prop error de mon objet Commentaire
    if ($commentaire->getError() == false) {
        $req = "INSERT INTO commentaire (pseudo, message, date_enregistrement) VALUES ('$pseudo', '$message', NOW())";
        // $stmt = $pdo->query($req);

        // La méthode insertCommentaire permet de lancer la requête d'insertion dans ma table
        $commentaire->insertCommentaire($pdo);
    }
}

// La méthode selectAllMessages me retourne le resultat d'un fetchAll sur la requête selectionnant tous les messages (ainsi que le formatage de la date en français)
$commentaires = $commentaire->selectAllMessages($pdo);

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
                <!-- - 03 - Création d'un formulaire permettant de poster un message  -->
                <form method="post" class="mt-5 mx-auto w-50 border p-3 bg-white">
                    <!-- getMsg() de l'objet Commentaire me retourne tous les messages d'erreurs rencontrés ainsi que les messages de succès -->
                    <?= $commentaire->getMsg() ?>
                    <!-- <?= $msg ?> -->
                    <?= $req ?>
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
                <p class="w-75 mx-auto mb-3">Il y a <?= count($commentaires) //->rowCount() ?> messages dans la table</p>
                <?php
                // - 07 - Affichage des commentaire avec un peu mise en forme
                foreach($commentaires AS $comment) {
                    // var_dump($comment);
                    echo '<div class="card w-75 mx-auto mb-3">
                                    <div class="card-header bg-dark text-white">
                                        Par : ' . $comment['pseudo'] . ', le : ' . $comment['date_fr'] . '
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text">' .$comment['message'] . '</p>
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