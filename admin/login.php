<?php
	ob_start();
	session_start();
	require_once('db.php');
	
	
	if(isset($_POST['submit'])){
		
		$cnic=$_POST['cnic'];
		$password=$_POST['password'];
		
		$reg_query="select * from admin where id_card = '$cnic'";
		$reg_run=mysql_query($reg_query);
		if(mysql_num_rows($reg_run) > 0){
			$row=mysql_fetch_assoc($reg_run);
			$db_cnic=$row['id_card'];
			$db_password=$row['password'];
			
			if($cnic == $db_cnic && $password == $db_password){
				header('location:index.php');
				$_SESSION['cnic'] = $db_cnic;
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


<?php //include('header.php'); ?>
<link rel="stylesheet" href="css/login.css" type="text/css">
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Dashboard| Admin Panel</title>
    
    <!-- favicon -->
    <link rel="icon" type="img/jpeg" href="img/favicon.jpeg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <link rel="stylesheet" href="css/font-awesome.css">
    
    <link href="https://fonts.googleapis.com/css?family=Oswald:400,300" rel="stylesheet" type="text/css">
    
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="js/bootstrap.js" rel="stylesheet">
    <link href="js/jquery-3.1.1.min.js" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css" type="text/css">
    <link rel="stylesheet" href="css/animated.css" type="text/css">
    <link href="js/main.js" >
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    
    <![endif]-->

  <body>
<!--<div id="admin_header" style="background-color:#162532;text-align:center; color:#fff;"><h2><i class="fa fa-cog fa-spin"></i> Admin Panel
  </h2></div> -->
  

    <div class="container well main_page_well col-lg-8" style="margin-left:15%;">
		<div class="row">
        <div class="col-md-12">
        <div class = "container-fluid">
  <div class = "row" style = "background: #4f4f4f; color:#fff; margin-top:-20px;" >
    <h3 class="text-center">Login to Admin panel</h3>
  </div>
 <?php
		  if(isset($error)){
			echo $error;  
		  }
		  
		  ?>
</div>
      <form class="form-signin animated shake" action="" method="post">
       <!-- <h2 class="form-signin-heading">Student Panel</h2> -->

        <label for="cnic" class="sr-only">CNIC Number</label>
        <input type="text" id="cnic" name="cnic" class="form-control" placeholder="CNIC Number" required>

        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
        <div class="checkbox">
          <label>
          <!--  <input type="checkbox" value="remember-me"> Remember me -->
          
         
          </label>
        </div>
        <input type="submit" name="submit" value="Sign in" class="btn btn-lg btn-primary btn-block" style="margin-top:-25px">
        <a href="forget_password.php">Forget Password</a>
      </form>
      </div>
		</div>
    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
