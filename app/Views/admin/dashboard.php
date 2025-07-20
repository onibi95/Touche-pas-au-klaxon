<?php include __DIR__.'/../partials/header.php'; ?>
<main class="flex-fill">
<div class="container mt-5">
  <div class="card p-4 shadow-sm">
    <h2 class="mb-4">Tableau de bord administrateur</h2>
    <div class="d-flex flex-wrap gap-3 mb-4">
      <a href="/admin/users" class="btn btn-secondary btn-lg">Utilisateurs</a>
      <a href="/admin/agences" class="btn btn-secondary btn-lg">Agences</a>
      <a href="/admin/trajets" class="btn btn-secondary btn-lg">Trajets</a>
      <a href="/admin/agence/create" class="btn btn-primary btn-lg">Créer une agence</a>
    </div>
    <div class="mt-4">
      <h5>Fonctionnalités disponibles :</h5>
      <ul>
        <li>Lister les utilisateurs</li>
        <li>Lister les agences</li>
        <li>Créer, modifier et supprimer une agence</li>
        <li>Lister les trajets</li>
        <li>Supprimer un trajet</li>
      </ul>
    </div>
  </div>
</div>
</main>
<?php include __DIR__.'/../partials/footer.php'; ?>
