<?php
// Vérification que $client existe et est un tableau
if (!isset($client) || !is_array($client)) {
    header('Location: index.php?action=clients');
    exit();
}
?>
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h2>Modifier le Client</h2>
        </div>
        <div class="card-body">
            <form action="index.php?action=clients&subaction=edit&id=<?= (int)$client['id'] ?>" method="POST">
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="nom" name="nom" 
                           value="<?= htmlspecialchars($client['nom']) ?>" required>
                </div>

                <div class="mb-3">
                    <label for="prenom" class="form-label">Prénom</label>
                    <input type="text" class="form-control" id="prenom" name="prenom" 
                           value="<?= htmlspecialchars($client['prenom']) ?>" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" 
                           value="<?= htmlspecialchars($client['email']) ?>" required>
                </div>

                <div class="mb-3">
                    <label for="telephone" class="form-label">Téléphone</label>
                    <input type="tel" class="form-control" id="telephone" name="telephone" 
                           value="<?= htmlspecialchars($client['telephone']) ?>" required>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="index.php?action=clients" class="btn btn-secondary me-md-2">Annuler</a>
                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                </div>
            </form>
        </div>
    </div>
</div>