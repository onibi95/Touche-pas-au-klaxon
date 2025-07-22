<?php include __DIR__.'/../partials/header.php'; ?>
<main class="flex-fill">
<div class="container mt-5">
  <div class="card p-4 shadow-sm">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2 class="mb-0">Liste des agences</h2>
      <a href="/admin/agence/create" class="btn btn-primary">Créer une agence</a>
    </div>
    <table class="table table-bordered table-striped">
      <thead class="table-dark">
        <tr>
          <th>ID</th>
          <th>Nom</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $db = \App\Core\Database::getInstance();
        $stmt = $db->query('SELECT id, nom FROM agences');
        $agences = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($agences as $agence): ?>
          <tr>
            <td><?= htmlspecialchars($agence['id']) ?></td>
            <td><?= htmlspecialchars($agence['nom']) ?></td>
            <td>
              <a href="/admin/agence/edit/<?= htmlspecialchars($agence['id']) ?>" class="btn btn-link p-0" title="Modifier">
                <i class="bi bi-pencil-square"></i>
              </a>
              <a href="/admin/agence/delete/<?= htmlspecialchars($agence['id']) ?>" class="btn btn-link p-0 ms-2" title="Supprimer" onclick="return confirm('Supprimer cette agence ?');">
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
