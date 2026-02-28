<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $titulo ?? 'TestDev' ?></title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
    <script src="<?= BASE_URL ?>/assets/js/script.js" defer></script>
    <script src="<?= BASE_URL ?>/assets/js/mascaras.js" defer></script>
</head>
<body>
<header>
    <h2><?= $titulo ?? 'Sistema' ?></h2>
    <?php if (isset($_SESSION['logado']) && $_SESSION['logado'] === true): ?>
        <div>
            Bem-vindo, <?= htmlspecialchars($_SESSION['usuario'] ?? '') ?>! 
            <a href="<?= BASE_URL ?>/logout.php" style="background-color: white; color: #333; padding: 8px 16px; border-radius: 4px; text-decoration: none; font-weight: bold; border: 1px solid #ccc; margin-left: 15px;">Sair</a>
        </div>
    <?php endif; ?>
</header>
<main class="container">