<?php
require 'includes/auth.php';
require 'includes/config.php';
$titulo = 'Menu Principal';
include 'includes/header.php';
?>

<h3>Cadastros</h3>
    <p><a href="<?= BASE_URL ?>/modules/produtos/listar.php">📦 Produtos</a></p>
    <p><a href="<?= BASE_URL ?>/modules/clientes/listar.php">👤 Clientes</a></p>

<?php include 'includes/footer.php'; ?>