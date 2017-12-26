<?php
    require_once('db.php');
	$search=$_POST['search'];
    $sql="select * from student where registration_no = '$search'";
    $result=mysql_query($sql);
    $row=mysql_num_rows($result);
    
    
?>

<table class="table table-bordered">
<thead class="bg-primary">
	<th>Name</th>
	<th>Reg</th>
    <th>batch</th>
    <th>Department</th>
    <th>Book Title</th>
    <th>Accession no</th>
    <th><a href="" class="bg-primary">Edit</a></th>

</thead><?php
        
	if($row > 0){
            $row3=mysql_query('select student_image from student where registration_no="'.$search.'"');
            $student_image=mysql_fetch_array($row3);
            $image=$student_image['student_image'];
            $row2=mysql_query('select book_title,accession_no from borrowing_info JOIN book ON borrowing_info.barcode_id=book.barcode_id where borrowing_info.registration_no= "'.$search.'"');
            $count=mysql_num_rows($row2);
            $data=mysql_fetch_array($result);
            ?> <tr><td><img src="<?php echo '../student/img/'.$image; ?>" width="100" height="100" alt="" /></td></tr> <?php
		while($data2=mysql_fetch_assoc($row2)){
                    
            $student_name=$data['student_name'];
            $father_name=$data['father_name'];
            $reg_no=$data['registration_no'];
            $batch_no=$data['batch'];
            $department=$data['department'];
            $book_title=$data2['book_title'];
            $access=$data2['accession_no'];
        
          ?>  
			
		<tr>
		<td><?php echo $student_name ?></td>
		<td><?php echo $reg_no ?></td>
		<td><?php echo $batch_no ?></td>
		<td><?php  echo $department ?></td>
                <td><?php  echo $book_title ?></td>
                <td><?php  echo $access ?></td>
                
		<td><a  title='Edit' href='edit-student.php?edit=<?php echo $reg_no ?>'><input type='button' class='btn btn-primary' value='Edit'></a>
            <a  title='Delete' href='list_of_student.php?del=<?php echo $reg_no ?>'><input type='button' class='btn btn-warning' value='Delete'></a></td>
		</tr>
	<?php 	
	}}
	else{
		echo "No data found";
	}
       
	//echo $search;


?>
</table>