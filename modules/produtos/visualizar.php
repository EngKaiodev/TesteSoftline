<?php

session_start();

require_once __DIR__ . '/../../includes/config.php';
require_once __DIR__ . '/../../includes/auth.php';


$titulo = 'Visualizar Produto';
include __DIR__ . '/../../includes/header.php';


$codigo = isset($_GET['codigo']) ? (int)$_GET['codigo'] : 0;
if ($codigo <= 0) {
    header('Location: ' . BASE_URL . '/modules/produtos/listar.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM Produtos WHERE Codigo = ?");
$stmt->execute([$codigo]);
$prod = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$prod) {
    header('Location: ' . BASE_URL . '/modules/produtos/listar.php');
    exit;
}
?>

<h2>Detalhes do Produto</h2>

<p><strong>Código:</strong> <?= htmlspecialchars($prod['Codigo']) ?></p>
<p><strong>Descrição:</strong> <?= htmlspecialchars($prod['Descricao']) ?></p>
<p><strong>Código de Barras:</strong> <?= htmlspecialchars($prod['CodigoBarras']) ?></p>
<p><strong>Valor de Venda:</strong> R$ <?= number_format($prod['ValorVenda'], 2, ',', '.') ?></p>
<p><strong>Peso Bruto:</strong> <?= number_format($prod['PesoBruto'], 3, ',', '.') ?> kg</p>
<p><strong>Peso Líquido:</strong> <?= number_format($prod['PesoLiquido'], 3, ',', '.') ?> kg</p>

<p><a href="<?= BASE_URL ?>/modules/produtos/listar.php">⬅ Voltar</a></p>

<?php
include __DIR__ . '/../../includes/footer.php';
?>