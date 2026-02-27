<?php
session_start();

require_once '../../includes/config.php';
require_once '../../includes/auth.php';

$titulo = 'Cadastrar Cliente';

$erro = '';

include __DIR__ . '/../../includes/header.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $codigo = trim($_POST['codigo'] ?? '');
    $nome = trim($_POST['nome'] ?? '');
    $fantasia = trim($_POST['fantasia'] ?? '');
    $documento = trim($_POST['documento'] ?? '');
    $endereco = trim($_POST['endereco'] ?? '');


$documento = preg_replace('/\D/', '', $documento);

if(empty($codigo) || empty($nome)){
    $erro = 'Código e Nome são obrigatórios.';
}elseif(!ctype_digit($codigo) || $codigo <= 0){
    $erro = 'Código deve ser um número inteiro positivo.';
}elseif(strlen($nome) >60 ){
    $erro = 'Nome deve ter no máximo 60 caracteres.';
}elseif(strlen($fantasia) >100 ){
    $erro = 'Fantasia deve ter no máximo 100 caracteres.';
}elseif(strlen($documento) >14 ){
    $erro = 'Documento inválido.';
}elseif(!empty($documento) && !is_numeric($documento)){
    $erro = 'Documento deve conter apenas números.';
}else{
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM Clientes WHERE codigo = ?");
    $stmt->execute([$codigo]);
    if($stmt->fetchColumn() > 0){
        $erro = 'Código já existe. Escolha outro.';
    }else{
        $sql = "INSERT INTO Clientes (codigo, nome, fantasia, documento, endereco) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
    }if($stmt->fetchColumn() > 0){
        $erro = 'Código já existe. Escolha outro.';
    }else{
        $sql ="INSERT INTO Clientes (codigo, nome, fantasia, documento, endereco) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        if($stmt->execute([$codigo, $nome, $fantasia, $documento, $endereco])){
            header('Location: ' . BASE_URL . '/modules/clientes/listar.php');
            exit;
        }else{
            $erro = 'Erro ao cadastrar cliente. Tente novamente.';    
        } 
    }
  }
}
?>

<h2>Cadastrar Cliente</h2>

<?php if ($erro): ?>
    <p style="color:red;"><?= htmlspecialchars($erro) ?></p>
<?php endif; ?>

<form method="post">
    <label for="codigo">Código</label>
    <input type="text" name="codigo" id="codigo" required value="<?= htmlspecialchars($_POST['codigo'] ?? '') ?>">

    <label for="nome">Nome</label>
    <input type="text" name="nome" id="nome" maxlength="60" required value="<?= htmlspecialchars($_POST['nome'] ?? '') ?>">

    <label for="fantasia">Fantasia</label>
    <input type="text" name="fantasia" id="fantasia" maxlength="100" value="<?= htmlspecialchars($_POST['fantasia'] ?? '') ?>">

    <label for="documento">Documento (CPF/CNPJ):</label>
    <input type="text" name="documento" id="documento" maxlength="18" placeholder="Digite CPF ou CNPJ" value="<?= htmlspecialchars($_POST['documento'] ?? '') ?>">

    <label for="endereco">Endereço:</label>
    <input type="text" name="endereco" id="endereco" value="<?= htmlspecialchars($_POST['endereco'] ?? '') ?>">

    <button type="submit">Salvar</button>
    <a href="<?= BASE_URL ?>/modules/clientes/listar.php">Cancelar</a>
</form>

<?php
include __DIR__ . '/../../includes/footer.php';
?>







