<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=testedev', 'root', 'root');
    echo 'Conectado com sucesso!';
} catch (PDOException $e) {
    echo 'Erro: ' . $e->getMessage();
}