<?php
	 require_once('db.php');
	 
	  if(isset($_GET['del'])){
        $del_id=$_GET['del'];
        //checking cnic number from facilty borrowing info
        $queryy=mysql_query('select cnic from faculty_borrowing_info where cnic="'.$del_id.'"');
        $faculty_cnic=mysql_fetch_assoc($queryy);
        if ($faculty_cnic['cnic']!=$del_id) {
          # code...
                  $del_query="DELETE FROM faculty WHERE cnic = '$del_id'";
                  $run=mysql_query($del_query);
                  echo "<div class='alert alert-warning alert-dismissable'>
                            <a href='#'' class='close' data-dismiss='alert' aria-label='close'>×</a>
                            <strong>Warning!</strong> faculty Successfully deleted.
                             </div>";
        }
        else{
          echo "<div class='alert alert-warning alert-dismissable'>
                            <a href='#'' class='close' data-dismiss='alert' aria-label='close'>×</a>
                            <strong>Warning!</strong> Books are issued to this faculty member.Return the book first then delete.
                             </div>";
        }
        // $del_query="DELETE FROM faculty WHERE cnic = '$del_id'";
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
            <div class="container content">
     <div class="row panel panel-primary add_student_well">
              <div class="panel-heading bg-primary"><h3><i class="glyphicon glyphicon-plus"></i> List of faculty</h3></div>
          	<div class="col-md-12">
            <div class="panel-body">
           <?php
           
				$select_query="select * from faculty";
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

                  <th>Faculty Name</th>
                  <th>CNIC number</th>
                  <th>Department</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                
                 <?php 
                                while($row=mysql_fetch_array($run)){

                                    $name=$row['name'];
                                    $cnic=$row['cnic'];
                                    $department=$row['department'];
                                   
                                   
                               
                   ?>
                
                <tr>

                  <td><?php echo $name ?></td>
                  <td><?php echo $cnic ?></td>
                  <td><?php echo $department ?></td>

<td><a  title="Edit" href="edit_faculty.php?edit=<?php echo $cnic ?>"><input type="button" class="btn btn-primary" value="Edit"></a>

                 
  <a title="Delete" href="list_of_faculty.php?del=<?php echo $cnic ?>"><input type="button" class="btn btn-warning" value="Delete"></a></td>
                </tr>
               <?php  } ?>
                </tbody>
                <tfoot>
                <tr>
                  
                  <th>Faculty Name</th>
                  <th>CNIC</th>
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

             