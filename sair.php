<?php 
//destroi a sessão e redireciona para o login
 session_start();
 unset($_SESSION['user']);
 unset($_SESSION['pass']);
 header('Location: login.php');
?>