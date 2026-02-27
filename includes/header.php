<?php
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title><?= $titulo ?? 'TestDev' ?></title>
    <link rel="stylesheet" href="<?= BASE_URL ?? '' ?>/assets/css/style.css">
    <script src="<?= BASE_URL ?>/assets/js/script.js" defer></script>
    <script src="<?= BASE_URL ?>/assets/js/mascaras.js" defer></script>
</head>
<body>
<header>
    <h2><?= $titulo ?? 'Sistema' ?></h2>
    <?php if (isset($_SESSION['logado']) && $_SESSION['logado'] === true): ?>
        <div style="text-align:right; margin-right:20px;">
            Bem-vindo, <?= htmlspecialchars($_SESSION['usuario'] ?? '') ?>! 
            <a href="<?= BASE_URL ?? '' ?>/logout.php">Sair</a>
        </div>
    <?php endif; ?>
    
</header>
<div class="container">