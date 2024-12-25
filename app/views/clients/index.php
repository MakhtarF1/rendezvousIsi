<!-- views/clients/index.php -->
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Liste des Clients</h2>
        <a href="index.php?action=clients&subaction=create" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nouveau Client
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Email</th>
                            <th>Téléphone</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($client = $clients->fetch(PDO::FETCH_ASSOC)): ?>
                            <tr>
                                <td><?= htmlspecialchars($client['nom']) ?></td>
                                <td><?= htmlspecialchars($client['prenom']) ?></td>
                                <td><?= htmlspecialchars($client['email']) ?></td>
                                <td><?= htmlspecialchars($client['telephone']) ?></td>
                                <td>
                                    <a href="index.php?action=clients&subaction=edit&id=<?= $client['id'] ?>" 
                                       class="btn btn-sm btn-info me-2">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="index.php?action=clients&subaction=delete&id=<?= $client['id'] ?>" 
                                       class="btn btn-sm btn-danger"
                                       onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce client ?')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>