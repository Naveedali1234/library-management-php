
<?php include('session.php');
	include('header.php');
	//include('side_bar.php');
	
?>

<!--side bar -->

<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top" id="nav_start" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Student Panel</a> 
            </div>
  <div style="color: white; padding: 15px 50px 5px 50px;float: right;font-size: 16px;"> <a href="logout.php" class="btn btn-danger square-btn-adjust"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a> </div>
  
  
  <!-- change password button and model are not shown in search page i have comment it if want just remove the below coment the the will start work -->
  
 <div style="color: white; padding: 15px 1px ;float: right;font-size: 16px;"><!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Change Password</button>
<!-- model start -->
<!--<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary" style="color:black; text-align:center;">Update Password</div>
      <div class="modal-body">
      <div class="row">
      <div class="col-md-6" style="margin-left:25%;">
      
      <form method="post" action="update_password.php">
             <div class="input-group">
                  <div class="input-group-addon">
                    <i class="">Old Password</i>
                  </div>
                  <input type="password" name="old" class="form-control" placeholder="Enter Old Password" required>
                </div></div>
                <div class="col-md-6" style="margin-left:25%; margin-top:15px;">
                 <div class="input-group">
                  <div class="input-group-addon">
                    <i class="">New Password</i>
                  </div>
                  <input type="password" name="new" class="form-control" placeholder="Enter New Password" required>
                </div></div>
                 <div class="col-md-6" style="margin-left:25%; margin-top:15px;">
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="">Repeat New Password</i>
                  </div>
                  <input type="password" name="repeat" class="form-control" placeholder="Repeat New Password" required>
                </div></div>
                <div class="col-md-6" style="margin-left:40%; margin-top:15px;">
                <input type="submit" class="btn btn-info" name="submit" value="Update Password">
                </div>
                <!-- /.input group -->
              </form>
              </div>
    <!-- </div>
  </div>
</div>
</div> -->
<!-- model end -->
        </nav>   
           <!-- /. NAV TOP  -->
                <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
				<li class="text-center">
                    <img src="img/find_user.png" class="user-image img-responsive"/>
					</li>
				
					
                    <li>
                        <a  href="index.php"><i class="fa fa-dashboard fa-2x"></i> Dashboard</a>
                    </li>
                      <li>
                        <a  href="issued_book.php"><i class="fa fa-book fa-2x"></i> Issued Book</a>
                    </li>
                    <li>
                        <a  href="search_book.php"><i class="fa fa-search fa-2x"></i> Search Book</a>
                    </li>
					
                  
                </ul>
               
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>


<!-- sidde bar end -->


	<!-- body content -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Dashboard</h2>   
                        <h5 style="color:green;">Welcome to Student Panel </h5>
                       <div class="panel-heading bg-primary"><h3 style="text-align:center"><i class="glyphicon glyphicon-search animated flash"></i> Search Book</h3></div>
                          <div class="panel-body">
           <div class="col-md-12 well" style="margin-top:1%;">
               <form action="search_book_table.php" method="post">
                  <div class="form-group">
                        <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                        <div class="input-group input-group-lg">
                          <div class="input-group-addon">Search</div>
                          <input type="text" class="form-control search" id="exampleInputAmount" name="search" placeholder="Search by name">
                         
                        </div>
                  </div>
                          
                </form>
                <div class="success"></div>
           </div>
       </div>
       
   </div> 
                       
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


<script src="js/jquery-3.1.1.min.js" type="text/javascript"></script>
    
     <script>
   	$('document').ready(function() {
		
       $('.search').keyup(function(){
		   
		   var search=$(this).val();
		   $.post($('form').attr('action'),
		   {'search':search},
		   function(data){
			   $('.success').html(data);
			   })
	   }) 
    })
   </script>
    

 
  