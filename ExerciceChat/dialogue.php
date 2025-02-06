<?php


/*
EXERCICES :
-----------
Version 1 - En PHP Procédural 
- Création d'un espace de dialogue

- 01 - Création de la BDD : dialogue     :  Création de la BDD via PhpMyAdmin
     -  Table : commentaire
     - Champs de la table commentaire :
        - id_commentaire        INT PK AI
        - pseudo                VARCHAR 255
        - message               TEXT
        - date_enregistrement   DATETIME
        
- 02 - Créer une connexion à cette base avec PDO     :   l'instanciation de l'objet PDO avec les bonnes informations (new $pdo)
- 03 - Création d'un formulaire permettant de poster un message     : form html (on oublie pas le method à bien régler, on oublie pas les names sur les input etc)
     - Champs du formulaire : 
        - pseudo (input type="text")
        - message (textarea)
        - bouton de validation
- 04 - Récupération des saisies du form avec controle        :   Le traitement via $_POST 
- 05 - Déclenchement d'une requete d'enregistrement pour enregistrer les saisies dans la BDD    :   Il faut lancer un INSERT INTO via PDO
- 06 - Requete de récupération des messages afin de les afficher dans cette page        :  Il faut lancer un SELECT via PDO
- 07 - Affichage des commentaire avec un peu mise en forme                              : Gestion de la réponse du SELECT avec fetch etc 
-----------------
- 08 - Affichage en haut des messages du nombre de message présent dans la bdd
- 09 - Affichage de la date en français
- 10 - Amélioration du css
-----------------
Version 2 
- Rajouter des notions d'orienté objet pour découper vos fonctionnalités afin d'alléger la page principale
- ------------(Architecture MVC) => To much
- Formulaire d'inscription utilisateur
- Formulaire de connexion utilisateur
- Limiter l'accès au formulaire aux utilisateurs connectés
*/

// - 02 - Créer une connexion à cette base avec PDO 
$host = "mysql:host=localhost;dbname=dialogue2"; // service mysql, host localhost, nom de la db
$login = "root"; // login de connexion
$password = ""; // password de connexion 
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_SILENT, // Gestion des erreurs 
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // Mode par défaut du fetch 
);

try {
    $pdo = new PDO($host, $login, $password, $options);
} catch (PDOException $e) {
    // var_dump($pdo);
    echo "Site indisponible, repassez plus tard";
    die;
}

// error ici me sert de repère, si elle reste sur false, c'est à dire que je n'ai pas d'erreur et que je pourrais valider l'insertion
$error = false;
$msg = "";
$req = "";

// var_dump($_SERVER); 

// - 04 - Récupération des saisies du form avec controle 
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["pseudo"], $_POST["message"])) {

    $pseudo = trim($_POST["pseudo"]);
    $message = trim($_POST["message"]);


    if (empty($pseudo) || empty($message)) {
        // Ici error passe sur true pour indiqué qu'il y a une erreur
        $error = true;
        $msg .= '<div class="alert alert-danger" role="alert">Veuillez saisir tous les champs s\'il vous plaît</div>';
    }

    if (iconv_strlen($pseudo) < 3 || iconv_strlen($pseudo) > 20) {
        // Ici error passe sur true pour indiqué qu'il y a une erreur
        $error = true;
        $msg .= '<div class="alert alert-danger" role="alert">Attention votre pseudo doit contenir au moins 3 lettres et maximum 20</div>';
    }

    // - 05 - Déclenchement d'une requete d'enregistrement pour enregistrer les saisies dans la BDD 
    // si error est == à false, c'est à dire qu'il n'y a pas d'erreur, alors je peux insérer, sinon je n'insère pas !
    if ($error == false) {
        $req = "INSERT INTO commentaire (pseudo, message, date_enregistrement) VALUES ('$pseudo', '$message', NOW())";
        // $stmt = $pdo->query($req);

        $stmt = $pdo->prepare("INSERT INTO commentaire (pseudo, message, date_enregistrement) VALUES (:pseudo, :message, NOW())");
        $stmt->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
        $stmt->bindParam(':message', $message, PDO::PARAM_STR);
        $stmt->execute();

        $msg .= '<div class="alert alert-success" role="alert">Message enregistré !</div>';
    }
}

// - 06 - Requete de récupération des messages afin de les afficher dans cette page
// - 09 - Affichage de la date en français
$liste_commentaires = $pdo->query("SELECT pseudo, message, date_format(date_enregistrement, '%d/%m/%Y à %H:%i:%s') AS date_fr FROM commentaire ORDER BY date_enregistrement DESC")->fetchAll();


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
                    <?= $msg ?>
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
                <p class="w-75 mx-auto mb-3">Il y a <?= count($liste_commentaires) //->rowCount() ?> messages dans la table</p>
                <?php
                // - 07 - Affichage des commentaire avec un peu mise en forme
                // while ($commentaire = $liste_commentaires->fetch(PDO::FETCH_ASSOC)) {
                foreach($liste_commentaires AS $commentaire) {
                    // var_dump($commentaire);
                    echo '<div class="card w-75 mx-auto mb-3">
                                    <div class="card-header bg-dark text-white">
                                        Par : ' . htmlspecialchars($commentaire['pseudo']) . ', le : ' . $commentaire['date_fr'] . '
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text">' .htmlspecialchars($commentaire['message']) . '</p>
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