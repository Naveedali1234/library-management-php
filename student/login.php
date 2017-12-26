<?php
	ob_start();
	session_start();
	require_once('db.php');
	
	
	if(isset($_POST['submit'])){
		
		$reg_no=$_POST['reg_no'];
		$password=$_POST['password'];
		
		$reg_query="select * from student where registration_no = '$reg_no'";
		$reg_run=mysql_query($reg_query);
		if(mysql_num_rows($reg_run) > 0){
			$row=mysql_fetch_assoc($reg_run);
			$db_reg_no=$row['registration_no'];
			$db_password=$row['password'];
			
			if($reg_no == $db_reg_no && $password == $db_password){
				header('location:index.php');
				$_SESSION['registration_number'] = $db_reg_no;
				}
				else{
					$error="<div class='alert alert-success' role='alert' style='text-align:center'>Wrong registration or password!!  PLZ try Again</div> ";
					}
		
		}	
		else{
				$error="<div class='alert alert-success' role='alert' style='text-align:center'>Wrong registration or password !!  PLZ try Again </div>";	
		}
	}

?>


<?php include('header.php'); ?>
<link rel="stylesheet" href="css/login.css" type="text/css">

  <body>
<div id="admin_header" style="background-color:#162532;text-align:center; color:#fff;"><h2><i class="fa fa-cog fa-spin"></i> Student Panel
  </h2></div>
  

    <div class="container well main_page_well col-lg-8" style="margin-left:15%;">
		<div class="row">
        <div class="col-md-12">
        <div class = "container-fluid">
  <div class = "row" style = "background: #4f4f4f; color:#fff; margin-top:-20px;" >
    <h4 class="text-center">Login to student panel</h4>
  </div>
 <?php
		  if(isset($error)){
			echo $error;  
		  }
		  
		  ?>
</div>
      <form class="form-signin animated shake" action="" method="post">
       <!-- <h2 class="form-signin-heading">Student Panel</h2> -->
        <label for="registration number" class="sr-only">Registration Number</label>
        <input type="text" id="reg_no" name="reg_no" class="form-control" placeholder="Registration Number" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
        <div class="checkbox">
          <label>
          <!--  <input type="checkbox" value="remember-me"> Remember me -->
          
         
          </label>
        </div>
        <input type="submit" name="submit" value="Sign in" class="btn btn-lg btn-primary btn-block" style="margin-top:-25px">
        
      </form>
      </div>
		</div>
    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
