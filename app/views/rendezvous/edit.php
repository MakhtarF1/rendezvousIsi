<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h2>Modifier le Rendez-vous</h2>
        </div>
        <div class="card-body">
            <form action="index.php?action=rendezvous&subaction=edit&id=<?= (int)$rdv['id'] ?>" method="POST">
                <div class="mb-3">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" class="form-control" id="date" name="date" 
                           value="<?= htmlspecialchars($rdv['date']) ?>" required>
                </div>

                <div class="mb-3">
                    <label for="heure" class="form-label">Heure</label>
                    <input type="time" class="form-control" id="heure" name="heure" 
                           value="<?= htmlspecialchars($rdv['heure']) ?>" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description"><?= htmlspecialchars($rdv['description']) ?></textarea>
                </div>

                <div class="mb-3">
                    <label for="client_id" class="form-label">Client</label>
                    <select class="form-control" id="client_id" name="client_id" required>
                        <?php foreach ($clients as $client): ?>
                            <option value="<?= $client['id'] ?>" <?= $client['id'] == $rdv['client_id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($client['nom']) ?> <?= htmlspecialchars($client['prenom']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="index.php?action=rendezvous" class="btn btn-secondary me-md-2">Annuler</a>
                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                </div>
            </form>
        </div>
    </div>
</div>
