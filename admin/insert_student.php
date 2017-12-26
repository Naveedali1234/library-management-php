<?php

	 require_once('db.php');

	if(filter_input(INPUT_POST, 'submit', FILTER_SANITIZE_STRING)){
		$student_name= filter_input(INPUT_POST, 'student_name', FILTER_SANITIZE_STRING);
		$father_name=filter_input(INPUT_POST, 'father_name', FILTER_SANITIZE_STRING);
		$reg_no=filter_input(INPUT_POST, 'reg_no', FILTER_SANITIZE_STRING);
		$batch_no=filter_input(INPUT_POST, 'batch_no', FILTER_SANITIZE_STRING);
		$department=filter_input(INPUT_POST, 'department', FILTER_SANITIZE_STRING);
		$password=filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
		$mobile_no=filter_input(INPUT_POST, 'mobile_no', FILTER_SANITIZE_NUMBER_INT);
		$email=filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
		$status=$_POST['status'];
		
		mysql_query("INSERT INTO student (registration_no,student_name,father_name,batch,department,password) VALUES('$reg_no','$student_name','$father_name','$batch_no','$department','$password')");
		
		header('location:list_of_student.php');
		
	}

?>