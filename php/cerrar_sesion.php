<?php
	session_start();
	header('Location: ../login/index.php');
	session_destroy();
?>