<!-- views/rendezvous/create.php -->
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h2>Nouveau Rendez-vous</h2>
        </div>
        <div class="card-body">
            <form action="index.php?action=rendezvous&subaction=create" method="POST">
                <div class="mb-3">
                    <label for="client_id" class="form-label">Client</label>
                    <select name="client_id" id="client_id" class="form-select" required>
                        <option value="">Sélectionnez un client</option>
                        <?php while($client = $clients->fetch(PDO::FETCH_ASSOC)): ?>
                            <option value="<?= $client['id'] ?>">
                                <?= htmlspecialchars($client['prenom'] . ' ' . $client['nom']) ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" class="form-control" id="date" name="date" required>
                </div>

                <div class="mb-3">
                    <label for="heure" class="form-label">Heure</label>
                    <input type="time" class="form-control" id="heure" name="heure" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="index.php?action=rendezvous" class="btn btn-secondary me-md-2">Annuler</a>
                    <button type="submit" class="btn btn-primary">Créer</button>
                </div>
            </form>
        </div>
    </div>
</div>
