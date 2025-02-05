<?php
session_start();

// Suppression du panier
if (isset($_GET['action']) && $_GET['action'] == 'vider') {
    unset($_SESSION['cart']);
    $_SESSION['message'] = "Le panier a été vidé.";
    header('Location: Panier.php');
    exit;
}

// Suppression d'un produit
if (isset($_GET['action']) && $_GET['action'] == 'remove' && isset($_GET['id'])) {
    $idProduit = $_GET['id'];
    if (isset($_SESSION['cart'][$idProduit])) {
        unset($_SESSION['cart'][$idProduit]);
        $_SESSION['message'] = "Le produit a été supprimé du panier.";
    }
    header('Location: Panier.php');
    exit;
}

// Modification des quantités
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_cart'])) {
    foreach ($_POST['quantities'] as $idProduit => $quantite) {
        if (isset($_SESSION['cart'][$idProduit])) {
            $_SESSION['cart'][$idProduit]['quantite'] = max(1, intval($quantite));
        }
    }
    $_SESSION['message'] = "Le panier a été mis à jour.";
    header('Location: Panier.php');
    exit;
}

var_dump($_SESSION);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Votre Panier</h1>

        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-success">
                <?= $_SESSION['message']; unset($_SESSION['message']); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
            <form action="" method="post">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Produit</th>
                            <th>Prix Unitaire</th>
                            <th>Quantité</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $totalGlobal = 0;
                        foreach ($_SESSION['cart'] as $idProduit => $product): 
                            $totalParProduit = $product['price'] * $product['quantite'];
                            $totalGlobal += $totalParProduit;
                        ?>
                            <tr>
                                <td><?= $product['name'] ?></td>
                                <td><?= $product['price'] ?>€</td>
                                <td>
                                    <input type="number" name="quantities[<?= $idProduit ?>]" value="<?= $product['quantite'] ?>" min="1" class="form-control" style="width: 80px;">
                                </td>
                                <td><?= number_format($totalParProduit, 2) ?>€</td>
                                <td>
                                    <a href="Panier.php?action=remove&id=<?= $idProduit ?>" class="btn btn-danger btn-sm">Supprimer</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3"><strong>Total</strong></td>
                            <td><strong><?= number_format($totalGlobal, 2) ?>€</strong></td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>

                <button type="submit" name="update_cart" class="btn btn-warning">Mettre à jour le panier</button>
            </form>

            <a href="Panier.php?action=vider" class="btn btn-danger mt-3">Vider le panier</a>
        <?php else: ?>
            <p>Votre panier est vide.</p>
        <?php endif; ?>

        <a href="exoPanier.php" class="btn btn-primary mt-3">Continuer vos achats</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
