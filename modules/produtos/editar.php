<?php
// sessao
session_start();

// conexao e autenticação
require_once __DIR__ . '/../../includes/config.php';
require_once __DIR__ . '/../../includes/auth.php';


// titulo
$title = "Editar Produto";
// header
include __DIR__.'/../../includes/header.php';

// variavel para armazenar erro
$erro ='';

// obtem codigo do produto
$codigo = isset($_GET['codigo'])? (int)$_GET['codigo']: 0;

// codigo invalido
if($codigo <= 0){
    header('Location: '.BASE_URL.'/modules/produtos/listar.php');
    exit;
}

// busca no bd
$stmt = $pdo->prepare("SELECT * FROM produtos WHERE Codigo = ?");
$stmt->execute([$codigo]);
$prod = $stmt->fetch(PDO::FETCH_ASSOC);

// produto nao encontrado
if(!$prod){
    header('Location: '.BASE_URL.'/modules/produtos/listar.php');
    exit;
}
// processa o formulario
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $descricao = trim($_POST['descricao'] ?? '');
    $codigoBarras = trim($_POST['codigoBarras'] ?? '');
    $valorVenda = trim($_POST['valorVenda'] ?? '');
    $pesoBruto = trim($_POST['pesoBruto'] ?? '');
    $pesoLiquido = trim($_POST['pesoLiquido'] ?? '');

    
    $valorVenda = str_replace(',', '.', $valorVenda);
    $pesoBruto = str_replace(',', '.', $pesoBruto);
    $pesoLiquido = str_replace(',', '.', $pesoLiquido);

    if (empty($descricao) || empty($valorVenda) || empty($pesoBruto) || empty($pesoLiquido)) {
        $erro = 'Todos os campos obrigatórios devem ser preenchidos.';
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
        
        $sql = "UPDATE produtos SET Descricao = ?, CodigoBarras = ?, ValorVenda = ?, PesoBruto = ?, PesoLiquido = ? WHERE Codigo = ?";
        $stmt = $pdo->prepare($sql);
        if($stmt->execute([$descricao, $codigoBarras, $valorVenda, $pesoBruto, $pesoLiquido, $codigo])){
            
            header('Location: '.BASE_URL.'/modules/produtos/listar.php');
            exit;
        } else {
            $erro = 'Erro ao atualizar produto. Tente novamente.';
            }    
        }    
    }

 ?>       

<h2>Editar Produto (Código: <?= htmlspecialchars($prod['Codigo']) ?>)</h2>

<?php if ($erro): ?>
    <p style="color:red;"><?= htmlspecialchars($erro) ?></p>
<?php endif; ?>

<form method="post">
    
    <label for="descricao">Descrição</label>
    <input type="text" name="descricao" id="descricao" maxlength="60" required 
           value="<?= htmlspecialchars($_POST['descricao'] ?? $prod['Descricao']) ?>">

    
    <label for="codigoBarras">Código de Barras</label>
    <input type="text" name="codigoBarras" id="codigoBarras" maxlength="14" 
           value="<?= htmlspecialchars($_POST['codigoBarras'] ?? $prod['CodigoBarras']) ?>">

    
    <label for="valorVenda">Valor de Venda (R$):</label>
    <input type="text" name="valorVenda" id="valorVenda" placeholder="0,00" required 
           value="<?= htmlspecialchars($_POST['valorVenda'] ?? number_format($prod['ValorVenda'], 2, ',', '.')) ?>">

    
    <label for="pesoBruto">Peso Bruto (kg):</label>
    <input type="text" name="pesoBruto" id="pesoBruto" placeholder="0,000" required 
           value="<?= htmlspecialchars($_POST['pesoBruto'] ?? number_format($prod['PesoBruto'], 3, ',', '.')) ?>">

    
    <label for="pesoLiquido">Peso Líquido (kg):</label>
    <input type="text" name="pesoLiquido" id="pesoLiquido" placeholder="0,000" required 
           value="<?= htmlspecialchars($_POST['pesoLiquido'] ?? number_format($prod['PesoLiquido'], 3, ',', '.')) ?>">

    
    <button type="submit">Salvar</button>
    <a href="<?= BASE_URL ?>/modules/produtos/listar.php">Cancelar</a>
</form>

<?php

include __DIR__ . '/../../includes/footer.php';
?>