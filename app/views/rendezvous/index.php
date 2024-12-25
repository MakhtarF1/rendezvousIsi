<!-- views/rendezvous/index.php -->
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Liste des Rendez-vous</h2>
        <a href="index.php?action=rendezvous&subaction=create" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nouveau Rendez-vous
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Heure</th>
                            <th>Client</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $rendezVous->fetch(PDO::FETCH_ASSOC)): ?>
                            <tr>
                                <td><?= htmlspecialchars(date('d/m/Y', strtotime($row['date']))) ?></td>
                                <td><?= htmlspecialchars($row['heure']) ?></td>
                                <td><?= htmlspecialchars($row['prenom'] . ' ' . $row['nom']) ?></td>
                                <td><?= htmlspecialchars($row['description']) ?></td>
                                <td>
                                    <a href="index.php?action=rendezvous&subaction=edit&id=<?= $row['id'] ?>" 
                                       class="btn btn-sm btn-info me-2">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="index.php?action=rendezvous&subaction=delete&id=<?= $row['id'] ?>" 
                                       class="btn btn-sm btn-danger"
                                       onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce rendez-vous ?')">
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
