<?php include __DIR__.'/../partials/header.php'; ?>
<main class="flex-fill">
<div class="container mt-4">
<?php if (!isset($_SESSION['user'])): ?>
    <h3>Pour obtenir plus d'informations sur un trajet, veuillez vous connecter</h3>
  <?php else: ?>
    <h3>Liste des trajets disponibles</h3>
    <p>Bienvenue, <?= htmlspecialchars($_SESSION['user']['prenom']) ?> !</p>
  <?php endif; ?>
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
        <?php if (isset($_SESSION['user'])): ?>
          <th>Action</th>
        <?php endif; ?>
      </tr>
    </thead>
    <tbody>
      <?php foreach($trajets as $i => $trajet): ?>
        <tr>
          <td><?= htmlspecialchars($trajet['agence_depart'] ?? '') ?></td>
          <td><?= htmlspecialchars($trajet['date_depart'] ?? '') ?></td>
          <td><?= htmlspecialchars($trajet['heure_depart'] ?? '') ?></td>
          <td><?= htmlspecialchars($trajet['agence_arrivee'] ?? '') ?></td>
          <td><?= htmlspecialchars($trajet['date_arrivee'] ?? '') ?></td>
          <td><?= htmlspecialchars($trajet['heure_arrivee'] ?? '') ?></td>
          <td><?= htmlspecialchars($trajet['places_disponibles'] ?? '') ?></td>
          <?php if (isset($_SESSION['user'])): ?>
            <td>
              <button class="btn btn-link p-0" data-bs-toggle="modal" data-bs-target="#trajetModal<?= $i ?>" title="Voir infos">
                <i class="bi bi-eye"></i>
              </button>
              <?php if (isset($_SESSION['user']['id']) && $_SESSION['user']['id'] == $trajet['utilisateur_id']): ?>
                <a href="/trajet/edit/<?= $trajet['id'] ?>" class="btn btn-link p-0 ms-2" title="Modifier">
                  <i class="bi bi-pencil-square"></i>
                </a>
                <a href="/trajet/delete/<?= $trajet['id'] ?>" class="btn btn-link p-0 ms-2" title="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce trajet ? Cette action est irréversible.');">
                  <i class="bi bi-trash"></i>
                </a>
              <?php endif; ?>
            </td>
          <?php endif; ?>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
<?php if (isset($_SESSION['user'])): ?>
  <?php foreach($trajets as $i => $trajet): ?>
    <div class="modal fade" id="trajetModal<?= $i ?>" tabindex="-1" aria-labelledby="trajetModalLabel<?= $i ?>" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="trajetModalLabel<?= $i ?>">Informations sur le trajet</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <ul class="list-group">
              <li class="list-group-item"><strong>Conducteur :</strong> <?= htmlspecialchars($trajet['user_prenom'] . ' ' . $trajet['user_nom']) ?></li>
              <li class="list-group-item"><strong>Téléphone :</strong> <?= htmlspecialchars($trajet['user_telephone']) ?></li>
              <li class="list-group-item"><strong>Email :</strong> <?= htmlspecialchars($trajet['user_email']) ?></li>
              <li class="list-group-item"><strong>Nombre total de places :</strong> <?= htmlspecialchars($trajet['places_total']) ?></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
<?php endif; ?>
</main>
<?php include __DIR__.'/../partials/footer.php'; ?>