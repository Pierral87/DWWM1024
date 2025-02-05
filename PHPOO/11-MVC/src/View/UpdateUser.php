<form action="?op=update" method="POST" class="card p-4 shadow-sm">
    <!-- Champ caché pour l'ID -->
    <input type="hidden" name="id" value="<?= htmlspecialchars($data['id']) ?>">

    <div class="mb-3">
        <label for="nom" class="form-label">Nom</label>
        <input type="text" id="nom" name="nom" class="form-control" value="<?= htmlspecialchars($data['nom']) ?>" required>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" id="email" name="email" class="form-control" value="<?= htmlspecialchars($data['email']) ?>" required>
    </div>

    <button type="submit" class="btn btn-primary">Modifier</button>
    <a href="index.php" class="btn btn-secondary">Retour à la liste</a>
</form>