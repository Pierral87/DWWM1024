<?php

/*

    EXERCICE SESSION :
            Page de produits et ajout panier + page panier : 

                Etapes : 
                    - 1 Initialiser la session en lançant l'instruction session_start()
                    - 2 Créer un array $products qui contient des produits fictifs (id, name, price)
                    - 3 Afficher ces produits sur la page avec un bouton Ajout panier géré avec GET 
                    - 4 Traiter le GET pour récupérer les informations produits et l'ajouter à $_SESSION['cart'] ainsi qu'un indice "quantity"
                    - 5 Traiter le fait que ce produit est peut être déjà présent en ajoutant simplement 1 à la quantité déjà présente
                    - 6 Vérifier le contenu de la session
                    - 7 Créer une page panier.php dans laquelle seront affichés les produits présents dans le panier avec un calcul du prix en rapport à leur quantité, prix par produit, prix total 
                    - 8 Permettre de modifier la quantité produit dans le panier 
                    - 9 Permettre de supprimer un produit du panier
                    - 10 Permettre de vider le panier entier 

*/ 


session_start();

// Produits disponibles
$products = [
    ['id' => 1, 'name' => 'Produit 1', 'price' => 19.99],
    ['id' => 2, 'name' => 'Produit 2', 'price' => 24.99],
    ['id' => 3, 'name' => 'Produit 3', 'price' => 15.99],
    ['id' => 4, 'name' => 'Produit 4', 'price' => 29.99],
];


// Ajout au panier
if (isset($_GET['add'])) {
    $idProduit = $_GET['add'];
    $produit = null; // Variable pour le produit trouvé
    // var_dump($_GET);
    // var_dump($products);
    // Recherche du produit dans la liste
    foreach ($products as $product) {
        if ($product['id'] == $idProduit) {
            $produit = $product; // Si trouvé
            break;
        }
    }

    if ($produit) {
        // On rentre ici si le produit a été trouvé

        // Si le panier n'existe pas encore dans la session on le défini à l'indice cart, étant un array vide pour l'instant
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        // Si le produit est déjà présent dans le panier on incrémente la quantité
        if (isset($_SESSION['cart'][$idProduit])) {
            $_SESSION['cart'][$idProduit]['quantite']++;
        } else { // Sinon on le rajoute entièrement au panier en utilisant son id pour clé du array
            $_SESSION['cart'][$idProduit] = [
                'name' => $produit['name'],
                'price' => $produit['price'],
                'quantite' => 1
            ];
        }
        $_SESSION['message'] = "Le produit a été ajouté au panier.";
    }
    // header('Location: exoPanier.php');
    // exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Produits</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Liste des Produits</h1>

        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-success">
                <?= $_SESSION['message']; unset($_SESSION['message']); ?>
            </div>
        <?php endif; ?>

        <div class="row">
            <?php foreach ($products as $product): ?>
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?= $product['name'] ?></h5>
                            <p class="card-text">Prix : <?= $product['price'] ?>€</p>
                            <a href="exoPanier.php?add=<?= $product['id'] ?>" class="btn btn-primary">Ajouter au panier</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <a href="Panier.php" class="btn btn-info mt-3">Voir le panier</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
