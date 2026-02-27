<?php
session_start();

require_once __DIR__ . '/../../includes/config.php';
require_once __DIR__ . '/../../includes/auth.php';

$codigo = isset($_GET['codigo']) ? (int)$_GET['codigo'] : 0;

if($codigo >0){
    $stmt = $pdo->prepare("DELETE FROM Clientes WHERE Codigo = ?");
    $stmt->execute([$codigo]);
}

header('Location: ' . BASE_URL . '/modules/clientes/listar.php');
exit;
?>