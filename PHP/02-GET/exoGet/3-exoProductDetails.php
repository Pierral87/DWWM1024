<?php
session_start();

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    foreach ($_SESSION["produits"] as $produit) {
        if ($produit["id"] == $id) {
            $produitSelectionne = $produit;
        }
    }
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détail du produit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container my-5">
        <div class="row">

            <?php if (isset($produitSelectionne)) : ?>
                <div class="card" style="width: 18rem;">
                    <img src="<?= $produitSelectionne["image"] ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?= $produitSelectionne["nom"] ?></h5>
                        <p class="card-text"><?= $produitSelectionne["description"] ?></p>
                        <a href="#" class="btn btn-primary">Ajouter au panier</a>
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>