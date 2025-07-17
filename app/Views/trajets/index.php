<?php include __DIR__.'/../partials/header.php'; ?>
<main class="flex-fill">
<div class="container mt-4">
  <h3>Pour obtenir plus d'informations sur un trajet, veuillez vous connecter</h3>
</div>

<div class="container mt-4">
  <table class="table table-striped table-bordered text-center align-middle rounded">
    <thead class="table-dark">
      <tr>
        <th>Départ</th>
        <th>Date</th>
        <th>Heure</th>
        <th>Destination</th>
        <th>Date</th>
        <th>Heure</th>
        <th>Places</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($trajets as $trajet): ?>
        <tr>
          <td><?= htmlspecialchars($trajet['agence_depart'] ?? '') ?></td>
          <td><?= htmlspecialchars($trajet['date_depart'] ?? '') ?></td>
          <td><?= htmlspecialchars($trajet['heure_depart'] ?? '') ?></td>
          <td><?= htmlspecialchars($trajet['agence_arrivee'] ?? '') ?></td>
          <td><?= htmlspecialchars($trajet['date_arrivee'] ?? '') ?></td>
          <td><?= htmlspecialchars($trajet['heure_arrivee'] ?? '') ?></td>
          <td><?= htmlspecialchars($trajet['places_disponibles'] ?? '') ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
</main>
<?php include __DIR__.'/../partials/footer.php'; ?>
