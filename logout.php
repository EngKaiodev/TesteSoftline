<?php
session_start();
require 'includes/config.php';
session_destroy();
header('Location: ' . BASE_URL . '/login.php');
exit;