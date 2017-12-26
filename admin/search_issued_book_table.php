<?php
    require_once('db.php');
	$search=$_POST['search'];
    $sql="select student_name,student.registration_no,batch,department,accession_no from student JOIN borrowing_info ON student.registration_no = borrowing_info.registration_no where borrowing_info.accession_no = '$search'";
    $result=mysql_query($sql);
    $row=mysql_num_rows($result);
?>

<table class="table table-bordered">
<thead class="bg-primary">
	<th>Student Name</th>
	<th>Registration No</th>
    <th>Department</th>
    <th>Batch</th>
    <th>Accession_no</th>

</thead>
<?php
	if($row > 0){
		while($data=mysql_fetch_assoc($result)){
			
			$student_name=$data['student_name'];
			$registration_no=$data['registration_no'];
			$department=$data['department'];
			$batch=$data['batch'];
			$status=$data['accession_no'];

		
		?>	
			
		<tr>
		<td><?php echo $student_name ?></td>
		<td><?php echo $registration_no ?></td>
		<td><?php echo $department ?></td>
		<td><?php echo $batch ?></td>
		<td><?php echo $status ?></td>
		</tr>
		<?php 	
	}}
	else{
		echo "No data found";
	}


?>
</table>