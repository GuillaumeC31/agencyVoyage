<?php
session_start();
$_SESSION = array();
session_destroy();

if(!isset($_SESSION['user']) && empty($_SESSION['user'])){
	header('Location: index.php'); // Redirection vers la page "flux.php"
}
?>
