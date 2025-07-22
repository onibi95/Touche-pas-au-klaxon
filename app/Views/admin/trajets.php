<?php include __DIR__.'/../partials/header.php'; ?>
<main class="flex-fill">
<div class="container mt-5">
  <div class="card p-4 shadow-sm">
    <h2 class="mb-4">Liste des trajets</h2>
    <table class="table table-bordered table-striped">
      <thead class="table-dark">
        <tr>
          <th>ID</th>
          <th>Départ</th>
          <th>Arrivée</th>
          <th>Date départ</th>
          <th>Heure départ</th>
          <th>Conducteur</th>
          <th>Places</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $db = \App\Core\Database::getInstance();
        $stmt = $db->query('SELECT t.id, ad.nom AS agence_depart, a.nom AS agence_arrivee, t.date_depart, t.heure_depart, t.places_total, u.prenom, u.nom FROM trajets t JOIN agences ad ON t.agence_depart_id = ad.id JOIN agences a ON t.agence_arrivee_id = a.id JOIN utilisateurs u ON t.utilisateur_id = u.id');
        $trajets = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($trajets as $trajet): ?>
          <tr>
            <td><?= htmlspecialchars($trajet['id']) ?></td>
            <td><?= htmlspecialchars($trajet['agence_depart']) ?></td>
            <td><?= htmlspecialchars($trajet['agence_arrivee']) ?></td>
            <td><?= htmlspecialchars($trajet['date_depart']) ?></td>
            <td><?= htmlspecialchars($trajet['heure_depart']) ?></td>
            <td><?= htmlspecialchars($trajet['prenom']) . ' ' . htmlspecialchars($trajet['nom']) ?></td>
            <td><?= htmlspecialchars($trajet['places_total']) ?></td>
            <td>
              <a href="/admin/trajet/delete/<?= htmlspecialchars($trajet['id']) ?>" class="btn btn-link p-0" title="Supprimer" onclick="return confirm('Supprimer ce trajet ?');">
                <i class="bi bi-trash"></i>
              </a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
</main>
<?php include __DIR__.'/../partials/footer.php'; ?>
