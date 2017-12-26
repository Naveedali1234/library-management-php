<!-- code for gif image start-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<style type="text/css">
.content{
  display: none;
}
.preload{
  margin-left: 45%;
  margin-top: 20%;
}

</style>

<script>

$(function(){
    $(".preload").fadeOut(700,function(){
   $(".content").fadeIn(350);
});
});


</script>
<!-- code for gif image end-->

<?php
	 require_once('db.php');
	 
	  if(isset($_GET['del'])){
        $del_id=$_GET['del'];
        //checking registration number from student borrowing info
        $queryy=mysql_query('select registration_no from borrowing_info where registration_no="'.$del_id.'"');
        $student_reg=mysql_fetch_assoc($queryy);
        if ($student_reg['registration_no']!=$del_id) {
          # code...
                  $del_query="DELETE FROM student WHERE registration_no = '$del_id'";
                  $run=mysql_query($del_query);
                  echo "<div class='alert alert-warning alert-dismissable'>
                            <a href='#'' class='close' data-dismiss='alert' aria-label='close'>×</a>
                            <strong>Warning!</strong> Student Successfully deleted.
                             </div>";
        }
        else{
          echo "<div class='alert alert-warning alert-dismissable'>
                            <a href='#'' class='close' data-dismiss='alert' aria-label='close'>×</a>
                            <strong>Warning!</strong> Books are issued to this Student.Return the book first then delete.
                             </div>";
        }
        //$del_query="DELETE FROM student WHERE registration_no = '$del_id'";
        // if(mysql_query($del_query)){
        //     $msg ="user has been deleted";
        // }
        // else{
        //     $error ="user has not been deleted";
        // }
    }
?>
 
           
<?php
	include('header.php');
?>

<div class="preload">
  <img src="img/ajax_loader.gif"/>
</div>

            <div class="container content">
     <div class="row panel panel-primary add_student_well">
              <div class="panel-heading bg-primary"><h3><i class="glyphicon glyphicon-plus"></i> List of Students</h3></div>
          	<div class="col-md-12">
            <div class="panel-body">
           <?php
           
				$select_query="select * from student order by registration_no desc";
				$run=mysql_query($select_query);
				if(mysql_num_rows($run) > 0){
					
		
           ?> 
                <!-- label to show the deleted label start-->
           
           
            <?php 
                        if(isset($error)){
						//echo "<small class='label pull-right bg-green'>$error</small>";
                            echo "<span style='color:red;' class='pull-right'>$error</span>";
                        }
                        else if(isset($msg)){
							//echo "<small class='label pull-right bg-green'>$msg</small>";
                             echo "<span style='color:green;' class='pull-right'>$msg</span>";
                        }
                    ?>
           <!-- label to show the deleted label end-->
           
           
    
              <table id="example1" class="table table-hover table-striped table-bordered">
                <thead class="bg-primary" >
                
                <tr>
                  <th>Registration Number</th>
                  <th>Name</th>
                  <th>Father Name</th>
                  <th>Batch</th>
                  <th>Department</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                
                 <?php 
                                while($row=mysql_fetch_array($run)){
                                    $student_name=$row['student_name'];
                                    $father_name=$row['father_name'];
                                    $reg_no=$row['registration_no'];
                                    $batch_no=$row['batch'];
                                    $department=$row['department'];	
                               
                   ?>
                
                <tr>
                  <td><?php echo $reg_no ?></td>
                  <td><?php echo $student_name ?></td>
                  <td><?php echo $father_name ?></td>
                  <td><?php echo $batch_no ?></td>
                  <td><?php echo $department ?></td>     
                  <td><a rel="tooltip"  title="Edit" href="edit-student.php?edit=<?php echo $reg_no ?>"><input type="button" class="btn btn-primary" value="Edit"></a>
                  <!--<a rel="tooltip"  title="Delete" href="list_of_student.php?del=<?php //echo $reg_no ?>"><input type="button" class="btn btn-warning" value="Delete"></a> --></td>
                </tr>
               <?php  } ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>Registration Number</th>
                  <th>Name</th>
                  <th>Father Name</th>
                  <th>Batch</th>
                  <th>Department</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>
               <?php 
                            
                    } // if statement wala
                    else{
                        echo "<center><h2><span style='color:red;'>no user availble</span> </h2></center>";
                    	}	
                  ?>
              
           
          
          <!-- /.box -->
                
                </div>
             