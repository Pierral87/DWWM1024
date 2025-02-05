<?php
session_start();

// Si rien dans le GET, nous ne sommes pas censés tomber sur cette page là, donc on redirige via l'intruction header
// exit permet de stopper totalement l'exécution de la suite de la page 
if (empty($_GET)) {
    header("location:2-exoGestionUsers.php");
    exit;
}



// Récupération de l'utilisateur en fonction de l'id reçu par le GET
$user = null;
if (isset($_GET["id"])) {
    foreach ($_SESSION["users"] as $utilisateur) {
        if ($utilisateur["id"] == $_GET["id"]) {
            $user = $utilisateur;
            var_dump($user);
            break;
        }
    }
}

// Récupération de l'action (voir modifier supprimer)
// $action = (isset($_GET["action"])) ? $_GET["action"] : "voir";
$action =  $_GET["action"] ?? "voir";

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Utilisateurs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container my-5">

        <?php if ($action == "voir") : ?>
            <!-- Action voir utilisateur -->
            <h2>Informations de l'utilisateur</h2>
            <ul class="list-group">
                <li class="list-group-item">ID : <?= $user["id"] ?></li>
                <li class="list-group-item">Nom : <?= $user["nom"] ?></li>
                <li class="list-group-item">Email : <?= $user["email"] ?></li>
            </ul>
        <?php elseif ($action == "modifier") : ?>
            <!-- Action modifier utilisateur -->
            <h2>Modifier l'utilisateur</h2>
            <form>
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="nom" name="nom" value="<?= $user["nom"] ?>">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" id="email" name="email" value="<?= $user["email"] ?>">
                </div>
                <button type="submit" class="btn btn-primary">Modifier</button>
            </form>
        <?php elseif ($action == "supprimer") : ?>
            <!-- Action supprimer utilisateur -->
            <h2>Supprimer l'utilisateur</h2>
            <p>Êtes vous sûr de vouloir supprimer l'utilisateur <strong><?= $user["nom"] ?></strong> (ID : <?= $user["id"] ?> ) ?</p>
            <a href="" class="btn btn-danger">Confirmer la suppression</a>
            <a href="2-exoGestionUser.php" class="btn btn-warning">Annuler</a>
        <?php endif; ?>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>