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
        <?php foreach ($data as $user) :  ?>
            <tr>
                <td><?= $user['id'] ?></td>
                <td><?= $user['nom'] ?></td>
                <td><?= $user['email'] ?></td>
                <td>
                    <a href="<?= URL ?>user/select/<?php echo $user['id']; ?>" class="btn btn-info">Voir</a>
                    <a href="<?= URL ?>user/update/<?php echo $user['id']; ?>" class="btn btn-warning">Modifier</a>
                    <a href="<?= URL ?>user/delete/<?php echo $user['id']; ?>" class="btn btn-danger">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>