  <!-- Action "Voir" les informations de l'utilisateur -->
                <ul class="list-group mb-3">
                    <li class="list-group-item"><strong>ID : </strong> <?php echo $data['id']; ?></li>
                    <li class="list-group-item"><strong>Nom : </strong> <?php echo $data['nom']; ?></li>
                    <li class="list-group-item"><strong>Email : </strong> <?php echo $data['email']; ?></li>
                </ul>
                <a href="<?= URL ?>user/update/<?php echo $data['id']; ?>" class="btn btn-warning">Modifier</a>
                <a href="<?= URL ?>user/delete/<?php echo $data['id']; ?>" class="btn btn-danger">Supprimer</a>