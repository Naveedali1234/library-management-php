<?php 
	include('session.php');
	require_once('db.php'); 
	include('header.php');
	include('side_bar.php');?>

	<!-- body content -->
      <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Dashboard</h2>   
                        <h5 style="color:green;">Welcome to Student Panel </h5> 
                      
   <?php 
		//session_start();
		$user=$_SESSION['registration_no'];
		if($user){
				if(isset($_POST['submit'])){
				$old_password=$_POST['old'];
				$new_password=$_POST['new'];	
				$repeat_password=$_POST['repeat'];
				$query=mysql_query("select password from student where registration_no = '$user'") or die("query not work");
				$row=mysql_fetch_array($query);
				$db_password=$row['password'];
				if($old_password == $db_password){
					
					if($new_password==$repeat_password){
						//chnage password in database
						$query_change=mysql_query("update student set password = '$new_password' where registration_no = '$user'");
						session_destroy();
						header("location:login.php");
						
					}
					else{
						$error="<div class='alert  bg-primary' role='alert' style='text-align:center; font-family:bold;'><h2>Warning</h2> <br>New password don't match!! Plz Try it again</div> ";
						
		 				 if(isset($error)){
						echo $error;  
		  						}
		  	
		 
						
					}
				}
				else{
					$error="<div class='alert  bg-primary' role='alert' style='text-align:center; font-family:bold;'><h2>Warning</h2> <br>Old password don't match!! Plz Try it again</div> ";
						
		 				 if(isset($error)){
						echo $error;  
		  						}
				}
	
				}
				
		}
		else{
			$error="<div class='alert  bg-primary' role='alert' style='text-align:center; font-family:bold;'><h2>Warning</h2> <br>You must Login to change Password</div> ";
						
		 				 if(isset($error)){
						echo $error;  
		  						}	
		}
	
			
  
  ?>
  
                       
                   </div> 
                </div>
                 <!-- /. ROW  -->
                 <hr /> 
               
   			 </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
   <script src="js/jquery.metisMenu.js"></script>
      <!-- CUSTOM SCRIPTS -->
   <script src="js/custom.js"></script>
    
   
</body>
</html>
 