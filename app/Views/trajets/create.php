<?php include __DIR__.'/../partials/header.php'; ?>
<main class="flex-fill">
<div class="container mt-4">
  <h3>Créer un nouveau trajet</h3>
  <?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
      <ul>
        <?php foreach ($errors as $err): ?>
          <li><?= htmlspecialchars($err) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  <?php endif; ?>
  <form method="post" action="/trajet/store" id="form-trajet">
    <div class="row mb-3">
      <div class="col-md-3">
        <label>Prénom</label>
        <input type="text" class="form-control" value="<?= htmlspecialchars($_SESSION['user']['prenom']) ?>" disabled>
      </div>
      <div class="col-md-3">
        <label>Nom</label>
        <input type="text" class="form-control" value="<?= htmlspecialchars($_SESSION['user']['nom']) ?>" disabled>
      </div>
      <div class="col-md-3">
        <label>Email</label>
        <input type="email" class="form-control" value="<?= htmlspecialchars($_SESSION['user']['email'] ?? '') ?>" disabled>
      </div>
      <div class="col-md-3">
        <label>Téléphone</label>
        <input type="text" class="form-control" value="<?= htmlspecialchars($_SESSION['user']['telephone'] ?? '') ?>" disabled>
      </div>
    </div>
    <div class="row mb-3">
      <div class="col-md-6">
        <label>Agence de départ</label>
        <select name="agence_depart" class="form-control" required>
          <option value="">Sélectionner</option>
          <?php foreach($agences as $agence): ?>
            <option value="<?= $agence['id'] ?>"><?= htmlspecialchars($agence['nom']) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="col-md-6">
        <label>Agence d'arrivée</label>
        <select name="agence_arrivee" class="form-control" required>
          <option value="">Sélectionner</option>
          <?php foreach($agences as $agence): ?>
            <option value="<?= $agence['id'] ?>"><?= htmlspecialchars($agence['nom']) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>
    <div class="row mb-3">
      <div class="col-md-3">
        <label>Date de départ</label>
        <input type="date" name="date_depart" class="form-control" required>
      </div>
      <div class="col-md-3">
        <label>Heure de départ</label>
        <input type="time" name="heure_depart" class="form-control" required>
      </div>
      <div class="col-md-3">
        <label>Date d'arrivée</label>
        <input type="date" name="date_arrivee" class="form-control" required>
      </div>
      <div class="col-md-3">
        <label>Heure d'arrivée</label>
        <input type="time" name="heure_arrivee" class="form-control" required>
      </div>
    </div>
    <div class="row mb-3">
      <div class="col-md-3">
        <label>Nombre total de places</label>
        <input type="number" name="places_total" class="form-control" min="1" required>
      </div>
    </div>
    <button type="submit" class="btn btn-primary">Créer le trajet</button>
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
