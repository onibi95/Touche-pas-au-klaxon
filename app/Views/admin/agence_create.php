<?php include __DIR__.'/../partials/header.php'; ?>
<main class="flex-fill">
<div class="container mt-5">
  <div class="card p-4 shadow-sm">
    <h2 class="mb-4">Créer une agence</h2>
    <?php if (!empty( $_SESSION['error'])): ?>
      <div class="alert alert-danger">
        <?= htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?>
      </div>
    <?php endif; ?>
    <form method="post" action="/admin/agence/create">
      <div class="mb-3">
        <label for="nom" class="form-label">Nom de l'agence</label>
        <input type="text" class="form-control" id="nom" name="nom" required>
      </div>
      <button type="submit" class="btn btn-primary">Créer</button>
      <a href="/admin/agences" class="btn btn-secondary ms-2">Retour</a>
    </form>
  </div>
</div>
</main>
<?php include __DIR__.'/../partials/footer.php'; ?> 