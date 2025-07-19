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
  <div class="d-flex justify-content-between align-items-center">
    <h2 class="mb-0">Touche pas au klaxon</h2>
    <?php if (isset($_SESSION['user'])): ?>
      <a href="/trajet/create" class="btn btn-dark">Créer un trajet</a>
        Bonjour <?= htmlspecialchars($_SESSION['user']['prenom']) . ' ' . htmlspecialchars($_SESSION['user']['nom']) ?>
        <a href="/logout" class="btn btn-dark">Déconnexion</a>
    <?php else: ?>
        <a href="/login" class="btn btn-dark">Connexion</a>
    <?php endif; ?>
  </div>
</div>
<hr>
  </main>
</body>
