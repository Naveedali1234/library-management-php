<?php

	ob_start();
	session_start();
	header('location:login.php');
	session_destroy();



?>