<?php
	 require_once('db.php');
	 
	  if(isset($_GET['del'])){
        $del_id=$_GET['del'];
        $del_query="DELETE FROM faculty WHERE cnic = '$del_id'";
        if(mysql_query($del_query)){
            $msg ="user has been deleted";
        }
        else{
            $error ="user has not been deleted";
        }
    }
?>



<?php
    require_once('db.php');
	$search=$_POST['search'];
    $sql="select * from faculty where cnic = '$search'";
    $result=mysql_query($sql);
    $row=mysql_num_rows($result);
?>


<table class="table table-bordered">
<thead class="bg-primary">
	<th>Name</th>
	<th>CNIC</th>
    <th>Department #</th>
    <th>Issued Books</th>
    <th>Action</th>

</thead>
<?php
	if($row > 0){
            $row2=mysql_query('select accession_no from faculty_borrowing_info where cnic="'.$search.'"');
            $count=mysql_num_rows($row2);
            while($data=mysql_fetch_array($result)){
                $name=$data['name'];
                $cnic=$data['cnic'];
                $department=$data['department'];
        
          ?>  
			
		<tr>
		<td><?php echo $name ?></td>
		<td><?php echo $cnic ?></td>
		<td><?php  echo $department ?></td>
                <td><?php  echo $count ?></td>
		<td><a  title='Edit' href='edit_faculty.php?edit=<?php echo $cnic ?>'><input type='button' class='btn btn-primary' value='Edit'></a>
            <a  title='Delete' href='list_of_faculty.php?del=<?php echo $cnic ?>'><input type='button' class='btn btn-warning' value='Delete'></a></td>
		</tr>
	<?php 	
	}}
	else{
		echo "No data found";
	}
       
	//echo $search;


?>
</table>