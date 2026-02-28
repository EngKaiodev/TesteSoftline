<?php
require 'includes/auth.php';
require 'includes/config.php';
$titulo = 'Menu Principal';
include 'includes/header.php';
?>

<h3>Cadastros</h3>
<p>
    <button type="button" class="btn-menu" onclick="window.location.href='<?= BASE_URL ?>/modules/produtos/listar.php'">
        📦 Produtos
    </button>
</p>
<p>
    <button type="button" class="btn-menu" onclick="window.location.href='<?= BASE_URL ?>/modules/clientes/listar.php'">
        👤 Clientes
    </button>
</p>

<?php include 'includes/footer.php'; ?>