<?php include __DIR__.'/../partials/header.php'; ?>
<main class="flex-fill">
<div class="container mt-5">
  <div class="card p-4 shadow-sm">
    <h2 class="mb-4">Liste des utilisateurs</h2>
    <table class="table table-bordered table-striped">
      <thead class="table-dark">
        <tr>
          <th>ID</th>
          <th>Prénom</th>
          <th>Nom</th>
          <th>Email</th>
          <th>Rôle</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // Connexion à la base et récupération des utilisateurs
        $db = \App\Core\Database::getInstance();
        $stmt = $db->query('SELECT id, prenom, nom, email, role FROM utilisateurs');
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($users as $user): ?>
          <tr>
            <td><?= htmlspecialchars($user['id']) ?></td>
            <td><?= htmlspecialchars($user['prenom']) ?></td>
            <td><?= htmlspecialchars($user['nom']) ?></td>
            <td><?= htmlspecialchars($user['email']) ?></td>
            <td><?= htmlspecialchars($user['role']) ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
</main>
<?php include __DIR__.'/../partials/footer.php'; ?>
