<?php
session_start();
require 'includes/config.php';
if(isset($_SESSION['logado']) && $_SESSION['logado'] === true){
    header('Location: ' . BASE_URL . '/menu.php');
    exit;
}else{
    header('Location: ' . BASE_URL . '/login.php');
    exit;
}