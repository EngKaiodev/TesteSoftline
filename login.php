<?php
session_start();
require 'includes/config.php';

if(isset($_SESSION['logado']) && $_SESSION['logado']===true){
    header('Location: ' . BASE_URL . '/menu.php');
    exit;
}

$erro = '';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $usuario = trim($_POST['usuario'] ?? '');
    $senha = trim($_POST['senha'] ?? '');

    if($usuario === '' || $senha === ''){
        $erro = 'Preencha usuario e senha.';
    }else{
        $stmt = $pdo->prepare("SELECT * FROM Usuarios WHERE Usuario = ? AND Senha = ?");
        $stmt->execute([$usuario, $senha]);
        $user = $stmt->fetch();

        if($user){
            $_SESSION['logado'] = true;
            $_SESSION['usuario'] = $user['Usuario'];
            header('Location: ' . BASE_URL . '/menu.php');
            exit;
        }else{
            $erro = 'Usuario ou senha incorretos.';
        }

    }
}

$titulo = 'Login';
include 'includes/header.php';

?>

<div style="max-width:400px; margin:0 auto;">
        <h2>Acesso ao Sistema</h2>
        <?php if ($erro): ?>
            <p style="color:red;"><?= htmlspecialchars($erro) ?></p>
        <?php endif; ?>
        <form method="post" id="loginForm">
            <label>Usuário:</label>
            <input type="text" name="usuario" required autofocus>
            <label>Senha:</label>
            <input type="password" name="senha" required>
            <button type="submit">Confirmar</button>
            <p>Ainda não tem conta? <a href="<?= BASE_URL ?>/modules/usuarios/cadastrar.php">Cadastre-se aqui</a>.</p>
        </form>
    </div>
<?php include 'includes/footer.php'; ?>
