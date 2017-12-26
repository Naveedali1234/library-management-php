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
    include('header.php');
require_once('db.php');

  if(isset($_POST['submit'])){
    $name=$_POST['name'];
    $cnic=$_POST['cnic'];
    $department=$_POST['department'];
    $email=$_POST['email'];
    $checking=mysql_query("select cnic from faculty where cnin='".$_POST['cnic']."'");
    if(mysql_num_rows($checking)!=0)
    {
        ?>
                    <div class="alert alert-warning alert-dismissable">'
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    <strong>Warning!</strong> This faculty member already exist.
                     </div>
               <?php
    }
    else{
    mysql_query("INSERT INTO faculty (name,cnic,department,email) VALUES('$name','$cnic','$department','$email')");
    
    header('location:list_of_faculty.php');
  }
  }
?>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js"></script>
 <div class="container content" ng-app="">
     <div class="row panel panel-primary add_student_well">
              <div class="panel-heading bg-primary"><h3><i class="glyphicon glyphicon-plus"></i> Add Faculty</h3></div>
              
              
              
          	<div class="col-md-6">
               
                    <div class="panel-body" >
            	<form method="post" id="frmDemo" action="add_faculty.php" enctype="multipart/form-data">
                <div class="form-group">
                <label>faculty Name:</label>

                <div class="input-group  input-group-lg">
                  <div class="input-group-addon">
                    <i class="fa fa-user"></i>
                  </div>
                    <input type="text" name="name" id="name" class="form-control" ng-model="name" required>
                
                </div>
                
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
               
                 <div class="form-group">
                <label>CNIC #:</label>

                <div class="input-group input-group-lg">
                  <div class="input-group-addon">
                    <i class="fa fa-user"></i>
                  </div>
                    <input type="text" name="cnic" id="cnic" class="form-control" ng-model="cnic" required>
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
               
                 <div class="form-group">
                <label>Department:</label>

                <div class="input-group input-group-lg">
                  <div class="input-group-addon">
                    <i class="fa fa-user"></i>
                  </div>
                  <input type="text" name="department" id="department" class="form-control" ng-model="department" required>
                </div>
                <!-- /.input group -->
              </div>
              
              <div class="form-group">
                <label>Email:</label>

                <div class="input-group input-group-lg">
                  <div class="input-group-addon">
                    <i class="fa fa-user"></i>
                  </div>
                    <input type="email" name="email" id="email" class="form-control" ng-model="email" required>
                </div>
                <!-- /.input group -->
              </div>
                
              <!-- /.form group -->
              <input type="submit" value="Add Faculty" name="submit" id="submit" class="btn btn-primary">
              </form>
              
              
                       
         </div>
                    
                </div><br><br>
                <div class="row  col-md-6"style="margin-top:-10px;">
                    <div class="add_student_well" style="padding:10px;"><strong>&nbsp;Faculty Name: </strong><span></span><p style="padding-left: 5px; color:blue; font-family:bold; font-size:30px" ng-bind="name"></p></div>
                    <div class="add_student_well" style="padding:10px;"><strong>&nbsp;CNIC:</strong><p style="padding-left: 5px; color:blue; font-family:bold; font-size:30px" ng-bind="cnic"></p></div>
                    <div class="add_student_well" style="padding:10px;"><strong>&nbsp;Department:</strong><p style="padding-left: 5px; color:blue; font-family:bold; font-size:30px" ng-bind="department"></p></div>
                    <div class="add_student_well" style="padding:10px;"><strong>&nbsp;Email:</strong><p style="padding-left: 5px; color:blue; font-family:bold; font-size:30px" ng-bind="email"></p></div>
                    
                    <br><br>
                </div>
     </div>
 </div>

<div class="preload">
  <img src="img/ajax_loader.gif"/>
</div>

