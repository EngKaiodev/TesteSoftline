<?php

session_start();


require_once __DIR__ . '/../../includes/config.php';
require_once __DIR__ . '/../../includes/auth.php';
require_once __DIR__ . '/../../includes/funcoes.php';


$titulo = 'Editar Cliente';
include __DIR__ . '/../../includes/header.php';

$erro = '';


$codigo = isset($_GET['codigo']) ? (int)$_GET['codigo'] : 0;


if ($codigo <= 0) {
    header('Location: ' . BASE_URL . '/modules/clientes/listar.php');
    exit;
}


$stmt = $pdo->prepare("SELECT * FROM Clientes WHERE Codigo = ?");
$stmt->execute([$codigo]);
$cliente = $stmt->fetch(PDO::FETCH_ASSOC);


if (!$cliente) {
    header('Location: ' . BASE_URL . '/modules/clientes/listar.php');
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $nome = trim($_POST['nome'] ?? '');
    $fantasia = trim($_POST['fantasia'] ?? '');
    $documento = trim($_POST['documento'] ?? '');
    $endereco = trim($_POST['endereco'] ?? '');

    
    $documento = preg_replace('/\D/', '', $documento);

    
    if (empty($nome)) {
        $erro = 'Nome é obrigatório.';
    } elseif (strlen($nome) > 60) {
        $erro = 'Nome não pode ter mais que 60 caracteres.';
    } elseif (strlen($fantasia) > 100) {
        $erro = 'Fantasia não pode ter mais que 100 caracteres.';
    } elseif (strlen($documento) > 14) {
        $erro = 'Documento inválido (máximo 14 dígitos).';
    } else {
        
        $sql = "UPDATE Clientes SET Nome = ?, Fantasia = ?, Documento = ?, Endereco = ? WHERE Codigo = ?";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$nome, $fantasia, $documento, $endereco, $codigo])) {
            header('Location: ' . BASE_URL . '/modules/clientes/listar.php');
            exit;
        } else {
            $erro = 'Erro ao atualizar cliente. Tente novamente.';
        }
    }
}
?>

<h2>Editar Cliente (Código: <?= htmlspecialchars($cliente['Codigo']) ?>)</h2>

<?php if ($erro): ?>
    <p style="color:red;"><?= htmlspecialchars($erro) ?></p>
<?php endif; ?>

<form method="post">
    
    <label for="nome">Nome</label>
    <input type="text" name="nome" id="nome" maxlength="60" required 
           value="<?= htmlspecialchars($_POST['nome'] ?? $cliente['Nome']) ?>">

    
    <label for="fantasia">Fantasia </label>
    <input type="text" name="fantasia" id="fantasia" maxlength="100" 
           value="<?= htmlspecialchars($_POST['fantasia'] ?? $cliente['Fantasia']) ?>">

    
    <label for="documento">Documento (CPF/CNPJ):</label>
    <input type="text" name="documento" id="documento" maxlength="18" 
           value="<?= htmlspecialchars($_POST['documento'] ?? preg_replace('/\D/', '', $cliente['Documento'])) ?>"
           placeholder="Digite CPF ou CNPJ">

    
    <label for="endereco">Endereço:</label>
    <input type="text" name="endereco" id="endereco" 
           value="<?= htmlspecialchars($_POST['endereco'] ?? $cliente['Endereco']) ?>">

    
    <button type="submit">Salvar</button>
    <a href="<?= BASE_URL ?>/modules/clientes/listar.php">Cancelar</a>
</form>

<?php
include __DIR__ . '/../../includes/footer.php';
?>