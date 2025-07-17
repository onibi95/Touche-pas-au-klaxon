<?php include __DIR__.'/../partials/header.php'; ?>
<main class="flex-fill">
<div class="container">
    <h1>Connexion</h1>
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form method="post" action="/login">
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control">
        </div>
        <div class="mb-3">
            <label>Mot de passe</label>
            <input type="password" name="password" class="form-control">
        </div>
        <button class="btn btn-primary">Se connecter</button>
    </form>
</div>
</main>
<?php include __DIR__.'/../partials/footer.php'; ?>
