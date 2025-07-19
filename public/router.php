<?php
// router.php
if (php_sapi_name() === 'cli-server') {
    $url  = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        // Sert les fichiers statiques (css, js, images, etc.)
        return false;
    }
}
// Toutes les autres requêtes passent par index.php
require_once __DIR__ . '/index.php'; 