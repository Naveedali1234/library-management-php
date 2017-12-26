<?php
	ob_start();
	session_start();
	require_once('db.php');
	if(!isset($_SESSION['cnic'])){
	header('location:login.php');	
		
	}
	$student_query="select * from admin";
	$student_run=mysql_query($student_query);
	$student_rows=mysql_num_rows($student_run);
	
?>