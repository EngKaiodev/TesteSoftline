<?php
$host = 'localhost';
$dbname = 'testedev';
$username = 'root';
$password = 'root';

try{
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);

}catch(PDOException $e){
    die("Erro na conexao: ". $e->getMessage());

}


//define('BASE_URL','http://localhost/testedev' );


if (!defined('BASE_URL')) {
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'] ?? 'localhost:8000';
    define('BASE_URL', $protocol . '://' . $host);
}

?>