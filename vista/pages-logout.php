<?php
	require '../assets/db/config.php';
	session_destroy();

	header('Location: pages-login');
?>
