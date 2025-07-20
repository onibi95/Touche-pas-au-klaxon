<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Covoiturage Entreprise</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>
<body>
    <main class="flex-fill">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="/">Covoiturage</a>
    </div>
</nav>
<div class="container mt-3">
  <div class="d-flex justify-content-center align-items-center" style="padding: 0;">
    <div class="rounded border px-3 py-2 w-100 d-flex align-items-center" style="background: #fff; border-width: 2px; border-radius: 16px;">
      <span class="fw-bold me-4 flex-shrink-0" style="font-size: 1.5rem;">Touche pas au klaxon</span>
      <div class="d-flex align-items-center flex-grow-1 justify-content-end" style="gap: 0.5rem;">
        <?php if (isset($_SESSION['user'])): ?>
          <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
            <a href="/admin/users" class="btn btn-secondary px-3 py-1">Utilisateurs</a>
            <a href="/admin/agences" class="btn btn-secondary px-3 py-1">Agences</a>
            <a href="/admin/trajets" class="btn btn-secondary px-3 py-1">Trajets</a>
            <span class="ms-3 me-2">Bonjour <?= htmlspecialchars($_SESSION['user']['prenom']) . ' ' . htmlspecialchars($_SESSION['user']['nom']) ?></span>
            <a href="/logout" class="btn btn-dark px-3 py-1 ms-2">Déconnexion</a>
          <?php else: ?>
            <a href="/trajet/create" class="btn btn-dark px-3 py-1">Créer un trajet</a>
            <span class="ms-3 me-2">Bonjour <?= htmlspecialchars($_SESSION['user']['prenom']) . ' ' . htmlspecialchars($_SESSION['user']['nom']) ?></span>
            <a href="/logout" class="btn btn-dark px-3 py-1 ms-2">Déconnexion</a>
          <?php endif; ?>
        <?php else: ?>
            <a href="/login" class="btn btn-dark px-3 py-1">Connexion</a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
<hr>
  </main>
</body>
