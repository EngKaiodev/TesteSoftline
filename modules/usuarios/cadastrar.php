<?php
session_start();

require_once __DIR__ . "/../../includes/config.php";

$titulo = "Cadastrar Usuário";
include __DIR__ . "/../../includes/header.php";

$erro ='';
$sucesso = '';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $usuario = trim($_POST['usuario'] ?? '');
    $senha = $_POST['senha'] ?? '';
    $confirmarSenha = $_POST['confirmar_senha'] ?? '';


    if(empty($usuario) || empty($senha) || empty($confirmarSenha)){
        $erro = 'Todos os campos são obrigatórios.';
    }elseif(strlen($usuario) < 4 ){
        $erro = 'O nome de usuário deve conter pelo menos 4 caracteres.';
    }elseif(strlen($senha) < 6){
        $erro = 'A senha deve conter pelo menos 6 caracteres.';
    }elseif($senha !== $confirmarSenha){
        $erro = 'As senhas não coincidem.';
    }else{
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM Usuarios WHERE Usuario = ?");
        $stmt->execute([$usuario]);
        if($stmt->fetchColumn() > 0){
            $erro = 'O nome de usuário já está em uso.';
        }else{
            $stmt = $pdo->prepare("INSERT INTO Usuarios (Usuario, Senha) VALUES (?, ?)");
            if ($stmt->execute([$usuario, $senha])) {
                $sucesso = 'Usuário cadastrado com sucesso! <a href="' . BASE_URL . '/login.php">Clique aqui para fazer login</a>.';
                $_POST['usuario'] = '';
            } else {
                $erro = 'Ocorreu um erro ao cadastrar o usuário. Tente novamente.';
            }
        }
    }

}
?>

<h2>Cadastrar Novo Usuário</h2>

<?php if ($erro): ?>
    <p style="color:red;"><?= htmlspecialchars($erro) ?></p>
<?php endif; ?>

<?php if ($sucesso): ?>
    <p style="color:green;"><?= $sucesso ?></p> 
<?php endif; ?>

<form method="post">
    <label for="usuario">Usuário </label>
    <input type="text" name="usuario" id="usuario" required value="<?= htmlspecialchars($_POST['usuario'] ?? '') ?>">

    <label for="senha">Senha </label>
    <input type="password" name="senha" id="senha" required>

    <label for="confirmar_senha">Confirmar Senha:</label>
    <input type="password" name="confirmar_senha" id="confirmar_senha" required>

    <button type="submit">Cadastrar</button>
    <a href="<?= BASE_URL ?>/login.php">Cancelar</a> 
</form>

<?php
include __DIR__ . '/../../includes/footer.php';
?>