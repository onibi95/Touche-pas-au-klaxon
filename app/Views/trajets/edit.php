<?php include __DIR__.'/../partials/header.php'; ?>
<main class="flex-fill">
<div class="container mt-4">
  <h3>Modifier le trajet</h3>
  <?php if (!empty( $_SESSION['error'])): ?>
    <div class="alert alert-danger">
      <?= htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?>
    </div>
  <?php endif; ?>
  <form method="post" action="/trajet/update/<?= htmlspecialchars($trajet['id']) ?>" id="form-trajet">
    <div class="row mb-3">
      <div class="col-md-3">
        <label>Prénom</label>
        <input type="text" class="form-control" value="<?= htmlspecialchars($trajet['user_prenom']) ?>" disabled>
      </div>
      <div class="col-md-3">
        <label>Nom</label>
        <input type="text" class="form-control" value="<?= htmlspecialchars($trajet['user_nom']) ?>" disabled>
      </div>
      <div class="col-md-3">
        <label>Email</label>
        <input type="email" class="form-control" value="<?= htmlspecialchars($trajet['user_email']) ?>" disabled>
      </div>
      <div class="col-md-3">
        <label>Téléphone</label>
        <input type="text" class="form-control" value="<?= htmlspecialchars($trajet['user_telephone']) ?>" disabled>
      </div>
    </div>
    <div class="row mb-3">
      <div class="col-md-6">
        <label>Agence de départ</label>
        <select name="agence_depart" class="form-control" required>
          <option value="">Sélectionner</option>
          <?php foreach($agences as $agence): ?>
            <option value="<?= $agence['id'] ?>" <?= $agence['id'] == $trajet['agence_depart_id'] ? 'selected' : '' ?>><?= htmlspecialchars($agence['nom']) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="col-md-6">
        <label>Agence d'arrivée</label>
        <select name="agence_arrivee" class="form-control" required>
          <option value="">Sélectionner</option>
          <?php foreach($agences as $agence): ?>
            <option value="<?= $agence['id'] ?>" <?= $agence['id'] == $trajet['agence_arrivee_id'] ? 'selected' : '' ?>><?= htmlspecialchars($agence['nom']) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>
    <div class="row mb-3">
      <div class="col-md-3">
        <label>Date de départ</label>
        <input type="date" name="date_depart" class="form-control" value="<?= htmlspecialchars($trajet['date_depart']) ?>" required>
      </div>
      <div class="col-md-3">
        <label>Heure de départ</label>
        <input type="time" name="heure_depart" class="form-control" value="<?= htmlspecialchars($trajet['heure_depart']) ?>" required>
      </div>
      <div class="col-md-3">
        <label>Date d'arrivée</label>
        <input type="date" name="date_arrivee" class="form-control" value="<?= htmlspecialchars($trajet['date_arrivee']) ?>" required>
      </div>
      <div class="col-md-3">
        <label>Heure d'arrivée</label>
        <input type="time" name="heure_arrivee" class="form-control" value="<?= htmlspecialchars($trajet['heure_arrivee']) ?>" required>
      </div>
    </div>
    <div class="row mb-3">
      <div class="col-md-3">
        <label>Nombre total de places</label>
        <input type="number" name="places_total" class="form-control" min="1" value="<?= htmlspecialchars($trajet['places_total']) ?>" required>
      </div>
    </div>
    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
  </form>
</div>
</main>
<script>
// Contrôle côté client : agences différentes, dates cohérentes
const form = document.getElementById('form-trajet');
form.addEventListener('submit', function(e) {
  const dep = form.agence_depart.value;
  const arr = form.agence_arrivee.value;
  if(dep === arr) {
    alert('L\'agence de départ et d\'arrivée doivent être différentes.');
    e.preventDefault();
    return;
  }
  const dateDep = form.date_depart.value + 'T' + form.heure_depart.value;
  const dateArr = form.date_arrivee.value + 'T' + form.heure_arrivee.value;
  if(new Date(dateArr) <= new Date(dateDep)) {
    alert('La date/heure d\'arrivée doit être après la date/heure de départ.');
    e.preventDefault();
    return;
  }
});
</script>
<?php include __DIR__.'/../partials/footer.php'; ?>
