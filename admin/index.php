<?php include('session.php');

     require_once('db.php'); 
?>

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

<html>
  <head>
    <title>Dashboard| Admin Panel</title>
    <!-- favicon -->
    <link rel="icon" type="img/jpeg" href="img/favicon.jpeg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    

<!-- jQuery library -->
    
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
  </head>
  <body>

<!-- nave bar -->
<nav class="navbar navbar-inverse" style="background-color:#293a4a">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
     <h3 style="color:white;">Admin Panel</h3> 
    </div>
   
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      
      <ul class="nav navbar-nav navbar-right">
        <li><a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a></li>
       <!-- <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Admin <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li role="separator" class="divider"></li>
            <li><a href="#">Change Password</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="logout.php">Logout</a></li>
          </ul>
        </li> -->
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
 <form action="barcode.php">
              <input type="text" autofocus style="width:0%; height:0%; border-style:none;">  
              </form>
<!-- nav bar end -->
    <div class="container-fluid well content" style="background-color:#F5F5F5">
      <div class="row">
        <div class="col-md-9">
    <div class="panel panel-default">
      <div class="panel-heading cc" id="cc"> <h4 style="margin-left:10px;">Student Records</h2></div>
  <div class="panel-body">
    <a href="add_student.php"><i class="fa fa-plus-circle fa-3x" aria-hidden="true" style="padding:3px;"></i> Add Student</a>
    
   <a href="list_of_student.php"> <i class="fa fa-list fa-3x ccc" aria-hidden="true" style="padding:3px;"></i> Student List</a>
    
   <a href="search_student.php"> <i class="fa fa-search fa-3x ccc" aria-hidden="true" style="padding:3px;"></i> Search Student</a> <br><br>
    
    
    <a href="student_clearance.php"><i class="fa fa-user-circle fa-3x" aria-hidden="true" style="padding:3px;"></i> Student Clearnce</a>

    
    
      </div>
  </div>
  </div>


        <div class="col-md-3">
    <div class="panel panel-default">
      <div class="panel-heading cc" id="cc"> <h4 style="text-align:center">Students Information</h2></div>
  <div class="panel-body">
    <i class="fa fa-user fa-3x" aria-hidden="true" style="padding:3px;"></i>  Total Student : <?php 
                 $query="select * from student";
                 $run=mysql_query($query);
                $rows=mysql_num_rows($run);
                    echo $rows;
                

                  ?>
  
  </div>
  </div>
  </div>


  
</div>  

<!-- code for book record -->

<div class="row">
        <div class="col-md-9">
    <div class="panel panel-default">
      <div class="panel-heading cc" id="cc"> <h4 style="margin-left:10px;">Book Records</h2></div>
  <div class="panel-body">
    <a href="add_book.php"><i class="fa fa-book fa-3x" aria-hidden="true" style="padding:3px;"></i> Add Book</a>
    
    <a href="list_of_book.php"><i class="fa fa-list fa-3x ccc" aria-hidden="true" style="padding:3px;"></i> Book List</a>
    
       <a href="search_book.php"> <i class="fa fa-search fa-3x ccc" aria-hidden="true" style="padding:3px; margin-left:140px;"></i> Search Book </a><br><br>
    
    
   <a href="lost_book.php"> <i class="fa fa-arrows fa-3x" aria-hidden="true" style="padding:3px;"></i> Lost Book</a>
    
        <a href="add_subtract_bookQuantity.php"><i class="fa fa-plus fa-3x ccc" aria-hidden="true" style="padding:3px;"></i> Add-Subtract Book Quantity</a>

    
      </div>
  </div>
  </div>


        <div class="col-md-3">
    <div class="panel panel-default">
      <div class="panel-heading cc" id="cc"> <h4 style="text-align:center">Books Information</h2></div>
  <div class="panel-body">
    <i class="fa fa-book fa-3x" aria-hidden="true" style="padding:3px;"></i> Total Books : <?php 
                 $query="select * from book";
                 $run=mysql_query($query);
                $rows=mysql_num_rows($run);
                    echo $rows;
                

                  ?>
  
  </div>
  </div>
  </div>


  
</div> 


<!-- code for circulation -->

<div class="row">
        <div class="col-md-9">
    <div class="panel panel-default">
      <div class="panel-heading cc" id="cc"> <h4 style="margin-left:10px;">Circulation Records of Student</h2></div>
  <div class="panel-body">
   <a href="issue_book.php"> <i class="fa fa-chevron-circle-right fa-3x" aria-hidden="true" style="padding:3px;"></i> Issue Book to Student</a>
    
      <a href="return_book.php"> <i class="fa fa-chevron-circle-left fa-3x ccc" aria-hidden="true" style="padding:3px; margin-left:30px;"></i> Return Book from Student</a>
    
    <a href="student_issued_book_list.php"><i class="fa fa-list fa-3x ccc" aria-hidden="true" style="padding:3px;"></i> Student Issue List</a> <br><br>
    
    
    <a href="barcode.php"><i class="fa fa-barcode fa-3x" aria-hidden="true" style="padding:3px;"></i> Student Issue-Return barcode scanner</a>
    
    
    
      </div>
  </div>
  </div>


        <div class="col-md-3">
    <div class="panel panel-default">
      <div class="panel-heading cc" id="cc"> <h4 style="text-align:center">Issue Book Information</h2></div>
  <div class="panel-body">
    <i class="fa fa-arrows fa-3x" aria-hidden="true" style="padding:3px;"></i> Issue books to student: <?php 
                 $query="select * from borrowing_info";
                 $run=mysql_query($query);
                $rows=mysql_num_rows($run);
                    echo $rows;
                

                  ?>
        
  
  </div>
  </div>
  </div>


  
</div> 

<!-- code for faculty -->

<div class="row">
        <div class="col-md-9">
    <div class="panel panel-default">
      <div class="panel-heading cc" id="cc"> <h4 style="margin-left:10px;">Faculty Records</h2></div>
  <div class="panel-body">
    <a href="add_faculty.php"><i class="fa fa-plus-circle fa-3x" aria-hidden="true" style="padding:3px;"></i> Add faculty</a>
    
   <a href="list_of_faculty.php"> <i class="fa fa-list fa-3x ccc" aria-hidden="true" style="padding:3px;"></i> faculty List</a>
    
   <a href="search_faculty.php"> <i class="fa fa-search fa-3x ccc" aria-hidden="true" style="padding:3px;"></i> Search faculty</a> <br><br>
   <a href="issue_book_faculty.php"> <i class="fa fa-chevron-circle-right fa-3x" aria-hidden="true" style="padding:3px;"></i> Issue Book to faculty</a> 
   <a href="return_book_faculty.php"> <i class="fa fa-chevron-circle-left fa-3x ccc" aria-hidden="true" style="padding:3px; margin-left:35px;"></i> Return book from faculty</a> 
   <a href="faculty_issued_book_list.php"> <i class="fa fa-list fa-3x ccc" aria-hidden="true" style="padding:3px; margin-left:35px;"></i> faculty Issue List</a> <br><br>
       <a href="faculty_barcode.php"><i class="fa fa-barcode fa-3x" aria-hidden="true" style="padding:3px;"></i> faculty Issue-Return barcode scanner</a>
    
    
    
      </div>
  </div>
  </div>


        <div class="col-md-3">
    <div class="panel panel-default">
      <div class="panel-heading cc" id="cc"> <h4 style="text-align:center">faculty Information</h2></div>
  <div class="panel-body">
    <i class="fa fa-user-circle fa-3x" aria-hidden="true" style="padding:3px;"></i> Total faculty :<?php 
                 $query="select * from faculty";
                 $run=mysql_query($query);
                $rows=mysql_num_rows($run);
                    echo $rows;
                

                  ?><br><br> 
      <i class="fa fa-book fa-3x" aria-hidden="true" style="padding:3px;"></i> Issue Book to faculty : <?php 
                 $query="select * from faculty_borrowing_info";
                 $run=mysql_query($query);
                $rows=mysql_num_rows($run);
                    echo $rows;
                

                  ?>
  
  </div>
  </div>
  </div>


  
</div>  

<!-- faculty code end -->


<!-- code for user -->

<div class="row">
        <div class="col-md-9">
    <div class="panel panel-default">
      <div class="panel-heading cc" id="cc"> <h4 style="margin-left:10px;">Admin Records</h2></div>
  <div class="panel-body">
    <a href="admin.php"><i class="fa fa-plus-circle fa-3x" aria-hidden="true" style="padding:3px;"></i> Add Admin</a>
    
   <a href="list_of_admin.php"> <i class="fa fa-list fa-3x ccc" aria-hidden="true" style="padding:3px;"></i> Admin List</a>
    
   
    
    
      </div>
  </div>
  </div>


        <div class="col-md-3">
    <div class="panel panel-default">
      <div class="panel-heading cc" id="cc"> <h4 style="text-align:center"> Admin Information</h2></div>
  <div class="panel-body">
    <i class="fa fa-user fa-3x" aria-hidden="true" style="padding:3px;"></i> Total Admin : <?php 
                 $query="select * from admin";
                 $run=mysql_query($query);
                $rows=mysql_num_rows($run);
                    echo $rows;
                

                  ?>
  
  </div>
  </div>
  </div>


  
</div>  

<!-- user code end -->

</div>
    
  </body>
  
  
  
</html>



<style type="text/css">
#cc{
  background-color:#293a4a;
  color:#fff;
  padding:10px;
  
  
}

.ccc{
 margin-left:100px;
}


.fa-superpowers {
  color: red;
}
.fa-envelope{
  color: green;
}
.fa-image{
  color: blue;
}

</style>


<div class="preload">
  <img src="img/ajax_loader.gif"/>
</div>

