<?php

session_start();


require_once __DIR__ . '/../../includes/config.php';
require_once __DIR__ . '/../../includes/auth.php';


$titulo = 'Cadastrar Produto'; 
include __DIR__ . '/../../includes/header.php';


$erro = '';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $codigo = trim($_POST['codigo'] ?? '');
    $descricao = trim($_POST['descricao'] ?? '');
    $codigoBarras = trim($_POST['codigoBarras'] ?? ''); 
    $valorVenda = trim($_POST['valorVenda'] ?? '');
    $pesoBruto = trim($_POST['pesoBruto'] ?? '');
    $pesoLiquido = trim($_POST['pesoLiquido'] ?? '');

    
    $valorVenda = str_replace(',', '.', $valorVenda);
    $pesoBruto  = str_replace(',', '.', $pesoBruto);
    $pesoLiquido = str_replace(',', '.', $pesoLiquido);

    
    if (empty($codigo) || empty($descricao) || empty($valorVenda) || empty($pesoBruto) || empty($pesoLiquido)) {
        $erro = 'Todos os campos obrigatórios devem ser preenchidos.';
    } elseif (!ctype_digit($codigo) || $codigo <= 0) {
        $erro = 'Código deve ser um número inteiro positivo.';
    } elseif (strlen($descricao) > 60) {
        $erro = 'Descrição não pode ter mais que 60 caracteres.';
    } elseif (strlen($codigoBarras) > 14) {
        $erro = 'Código de barras não pode ter mais que 14 caracteres.';
    } elseif (!is_numeric($valorVenda) || $valorVenda < 0) {
        $erro = 'Valor de venda deve ser um número válido.';
    } elseif (!is_numeric($pesoBruto) || $pesoBruto < 0) {
        $erro = 'Peso bruto deve ser um número válido.';
    } elseif (!is_numeric($pesoLiquido) || $pesoLiquido < 0) {
        $erro = 'Peso líquido deve ser um número válido.';
    } else {
        
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM Produtos WHERE Codigo = ?");
        $stmt->execute([$codigo]);
        if ($stmt->fetchColumn() > 0) {
            $erro = 'O código do produto já existe. Por favor, escolha um código diferente.';
        } else {
            
            $sql = "INSERT INTO Produtos (Codigo, Descricao, CodigoBarras, ValorVenda, PesoBruto, PesoLiquido) 
                    VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute([$codigo, $descricao, $codigoBarras, $valorVenda, $pesoBruto, $pesoLiquido])) {
                header('Location: ' . BASE_URL . '/modules/produtos/listar.php');
                exit;
            } else {
                $erro = 'Ocorreu um erro ao cadastrar o produto. Por favor, tente novamente.';
            }
        }
    }
}
?>

<h2>Cadastrar Produto</h2>

<?php if ($erro): ?>
    <p style="color:red;"><?= htmlspecialchars($erro) ?></p>
<?php endif; ?>

<form method="post">
    <label for="codigo">Código</label>
    <input type="number" name="codigo" id="codigo" required value="<?= htmlspecialchars($_POST['codigo'] ?? '') ?>" step="1" min="1">

    <label for="descricao">Descrição</label>
    <input type="text" name="descricao" id="descricao" maxlength="60" required value="<?= htmlspecialchars($_POST['descricao'] ?? '') ?>">

    <label for="codigoBarras">Código de Barras</label>
    <input type="text" name="codigoBarras" id="codigoBarras" maxlength="14" value="<?= htmlspecialchars($_POST['codigoBarras'] ?? '') ?>">

    <label for="valorVenda">Valor de Venda (R$):</label>
    <input type="text" name="valorVenda" id="valorVenda" placeholder="0,00" required value="<?= htmlspecialchars($_POST['valorVenda'] ?? '') ?>">

    <label for="pesoBruto">Peso Bruto (kg):</label>
    <input type="text" name="pesoBruto" id="pesoBruto" placeholder="0,000" required value="<?= htmlspecialchars($_POST['pesoBruto'] ?? '') ?>">

    <label for="pesoLiquido">Peso Líquido (kg):</label>
    <input type="text" name="pesoLiquido" id="pesoLiquido" placeholder="0,000" required value="<?= htmlspecialchars($_POST['pesoLiquido'] ?? '') ?>">

    <button type="submit">Salvar</button>
    <a href="<?= BASE_URL ?>/modules/produtos/listar.php">Cancelar</a>
</form>


<script src="<?= BASE_URL ?>/assets/js/mascaras.js"></script>

<?php
include __DIR__ . '/../../includes/footer.php';
?>