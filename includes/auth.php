<?php
if(session_status() == PHP_SESSION_NONE){
    session_start();
}

if(!isset($_SESSION['logado'])|| $_SESSION['logado'] !== true){
    require_once __DIR__ . '/config.php';
    header('Location: ' . BASE_URL . '/testedev/login.php');
    exit;
}