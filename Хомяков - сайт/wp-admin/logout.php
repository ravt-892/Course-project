<?php 
	require 'db.php';
	unset($_SESSION['logged_admin']);
	header('Location: /wp-admin');
?>
