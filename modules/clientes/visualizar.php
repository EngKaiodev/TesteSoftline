<?php
session_start();

require_once __DIR__ . '/../../includes/config.php';
require_once __DIR__ . '/../../includes/auth.php';
require_once __DIR__ . '/../../includes/funcoes.php';

$titulo = 'Visualizar Cliente';

include __DIR__ . '/../../includes/header.php';

$codigo = isset($_GET['codigo']) ? (int)$_GET['codigo'] : 0;

if($codigo <=0){
    header('Location:' .BASE_URL . '/modules/clientes/listar.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM Clientes WHERE codigo = ?");
$stmt->execute([$codigo]);
$cliente = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$cliente){
    header('Location:' .BASE_URL . '/modules/clientes/listar.php');
    exit;
}
?>

<h2>Detalhes do Cliente</h2>


<p><strong>Código:</strong> <?= htmlspecialchars($cliente['Codigo']) ?></p>
<p><strong>Nome:</strong> <?= htmlspecialchars($cliente['Nome']) ?></p>
<p><strong>Fantasia:</strong> <?= htmlspecialchars($cliente['Fantasia']) ?></p>
<p><strong>Documento:</strong> <?= htmlspecialchars(formatarDocumento($cliente['Documento'])) ?></p>
<p><strong>Endereço:</strong> <?= htmlspecialchars($cliente['Endereco']) ?></p>


<p><a href="<?= BASE_URL ?>/modules/clientes/listar.php">⬅ Voltar para a Lista</a></p>

<?php

include __DIR__ . '/../../includes/footer.php';
?>