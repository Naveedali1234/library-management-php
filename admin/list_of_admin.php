
<?php
	 require_once('db.php');
	 
	  if(isset($_GET['del'])){
        $del_id=$_GET['del'];
        $del_query="DELETE FROM admin WHERE id_card = '$del_id'";
        if(mysql_query($del_query)){
            $msg ="user has been deleted";
        }
        else{
            $error ="user has not been deleted";
        }
    }
?>
 
           
<?php
	include('header.php');
?>
            <div class="container content">
     <div class="row panel panel-primary add_student_well">
              <div class="panel-heading bg-primary"><h3><i class="glyphicon glyphicon-plus"></i> List of Admin</h3></div>
          	<div class="col-md-12">
            <div class="panel-body">
           <?php
           
				$select_query="select * from admin order by id desc";
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
                  <th>ID</th>
                  <th>Admin Name</th>
                  <th>NIC number</th>
                  <th>Email</th>
                  <th>Password</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                
                 <?php 
                                while($row=mysql_fetch_array($run)){
                                    $id=$row['id'];
                                    $name=$row['name'];
                                    $id_card=$row['id_card'];
                                    $email=$row['email'];
                                    $password=$row['password'];
                                   
                               
                   ?>
                
                <tr>
                  <td><?php echo $id ?></td>
                  <td><?php echo $name ?></td>
                  <td><?php echo $id_card ?></td>
                  <td><?php echo $email ?></td>
                  <td><?php echo $password ?></td>
<td><a rel="tooltip"  title="Edit" href="edit_admin.php?edit=<?php        echo $id_card ?>"><input type="button" class="btn btn-primary" value="Edit"></a>

                 
  <a rel="tooltip"  title="Delete" href="list_of_admin.php?del=<?php echo $id_card ?>"><input type="button" class="btn btn-warning" value="Delete"></a></td>
                </tr>
               <?php  } ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>ID Card</th>
                  <th>Email</th>
                  <th>Password</th>
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

             