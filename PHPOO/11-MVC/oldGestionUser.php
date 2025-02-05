<?php
session_start();


$_SESSION['users'] = [
    ['id' => 1, 'nom' => 'Dupont', 'email' => 'dupont@example.com'],
    ['id' => 2, 'nom' => 'Durand', 'email' => 'durand@example.com'],
    ['id' => 3, 'nom' => 'Martin', 'email' => 'martin@example.com'],
];

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des utilisateurs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container my-5">
        <h1 class="mb-4">Liste des utilisateurs</h1>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['users'] as $user) :  ?>
                    <tr>
                        <td><?= $user['id'] ?></td>
                        <td><?= $user['nom'] ?></td>
                        <td><?= $user['email'] ?></td>
                        <td>
                            <a href="2-exoUser.php?action=voir&id=<?= $user['id'] ?>" class="btn btn-info">Voir</a>
                            <a href="2-exoUser.php?action=modifier&id=<?= $user['id'] ?>" class="btn btn-warning">Modifier</a>
                            <a href="2-exoUser.php?action=supprimer&id=<?= $user['id'] ?>" class="btn btn-danger">Supprimer</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
