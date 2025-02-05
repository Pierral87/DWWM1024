<?php
session_start();
/*

    EXERCICE POST :
            Formulaire inscription utilisateur : 

                Etapes : 
                    - 1 Initialiser la session en lançant l'instruction session_start()
                    - 2 Créer un formulaire POST pour une inscription utilisateur (pseudo, email, password, confirm password)
                    - 3 Controler ces informations reçues dans POST (taille pseudo, format email, longueur password et correspondance avec le confirm, vérifier si le pseudo n'est pas déjà pris)
                    - 4 Si tout est ok, crypter le mot de passe avec password_hash et l'insérer dans  $_SESSION['users'] puis afficher un message de confirmation d'inscription
                    - 5 Si pas ok, afficher des messages d'erreur en rapport avec les problèmes de saisies

*/

if (!isset($_SESSION['users'])) {
    $_SESSION['users'] = [];
}

$msgSuccess = "";

$erreurs = array("entete" => "", "pseudo" => "", "password" => "", "email" => "");
// $erreur = [];

$pseudo = "";
$email = "";


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["pseudo"], $_POST["email"], $_POST["password"], $_POST["password_confirm"])) {

    // var_dump($_POST);

    $pseudo = trim($_POST["pseudo"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $passwordConfirm = trim($_POST["password_confirm"]);

    $insert = "ok";

    // Controles de validation 

    // Controle que tous les champs soient bien saisis
    if (empty($pseudo) || empty($email) || empty($password) || empty($passwordConfirm)) {
        // Je rentre ici si un champ n'est pas saisi ! 
        // Cas d'erreur ! 
        $erreurs["entete"] .= "Tous les champs doivent être remplis";
        $insert = "pasok";
    }

    // Controle de longueur du pseudo
    if (iconv_strlen($pseudo) < 3 || iconv_strlen($pseudo) > 20) {
        $erreurs["pseudo"] .= "<div class=\"alert alert-danger\" role=\"alert\">Attention le pseudo doit faire entre 3 et 20 caractères</div>";
        $insert = "pasok";
    }

    // Vérification si le pseudo n'est pas déjà pris ! 
    foreach ($_SESSION["users"] as $user) {
        if ($user["pseudo"] == $pseudo) {
            $erreurs["pseudo"] .= "Attention le pseudo est déjà pris ";
            $insert = "pasok";
        }
    }

    // Controle de longueur du password 
    if (iconv_strlen($password) < 6) {
        $erreurs["password"] .= "Attention le password doit faire au moins 6 caractères";
        $insert = "pasok";
    } // On pourrait aussi faire un controle avec une regex pour forcer un pattern particulier pour le password 

    // Vérification du format d'email 
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erreurs["email"] .= "Attention le format d'email n'est pas valide";
        $insert = "pasok";
    }

    // Vérification de la correspondance du password et du passwordConfirm 
    if ($password !== $passwordConfirm) {
        $erreurs["password"] .= "Attention les deux password doivent se correspondre";
        $insert = "pasok";
    }

    var_dump($erreurs);

    if ($insert == "ok") {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $_SESSION["users"][] = ["pseudo" => $pseudo, "email" => $email, "password" => $password];
        $msgSuccess = "Inscription réussie ! Vous pouvez vous connecter ! ";
    }

    
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <h1>Inscription</h1>


                <?php if (!empty($erreurs)): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php foreach ($erreurs as $erreur): ?>
                                <li><?= $erreur ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <?= $msgSuccess ?>




                <form action="" method="post">
                    <div class="mb-3">

                        <label for="pseudo" class="form-label">Pseudo</label>
                        <!-- <?php echo (!empty($erreurs["pseudo"])) ? $erreurs["pseudo"]  : ""  ?> -->
                        <input type="text" class="form-control" id="pseudo" name="pseudo" value ="<?= $pseudo ?>" required>
                    </div>
                    <div class="mb-3">

                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value ="<?= $email ?>"required>
                    </div>
                    <div class="mb-3">

                        <label for="password" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3">

                        <label for="password_confirm" class="form-label">Confirmer le mot de passe</label>
                        <input type="password" class="form-control" id="password_confirm" name="password_confirm" required>
                    </div>
                    <button type="submit" class="btn btn-primary">S'inscrire</button>
                </form>
            </div>
        </div>
        <?php
        echo "<pre>";
        print_r($_SESSION);
        echo "</pre>";
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>