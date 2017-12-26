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
    $name=$_POST['admin_name'];
    $id_card=$_POST['id_card'];
    $email=$_POST['email'];
    $password=$_POST['password'];

    mysql_query("INSERT INTO admin (name,id_card,email,password) VALUES('$name','$id_card','$email','$password')");
    
    header('location:list_of_admin.php');
  }

?>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js"></script>
 <div class="container content" ng-app="">
     <div class="row panel panel-primary add_student_well">
              <div class="panel-heading bg-primary"><h3><i class="glyphicon glyphicon-plus"></i> Add Admin</h3></div>
              
              
              
          	<div class="col-md-6">
               
                    <div class="panel-body" >
            	<form method="post" id="frmDemo" action="admin.php" enctype="multipart/form-data">
                <div class="form-group">
                <label>Admin Name:</label>

                <div class="input-group  input-group-lg">
                  <div class="input-group-addon">
                    <i class="fa fa-user"></i>
                  </div>
                    <input type="text" name="admin_name" id="admin_name" class="form-control" ng-model="name" required>
                
                </div>
                
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
               
                 <div class="form-group">
                <label>ID card:</label>

                <div class="input-group input-group-lg">
                  <div class="input-group-addon">
                    <i class="fa fa-user"></i>
                  </div>
                    <input type="text" name="id_card" id="id_card" class="form-control" ng-model="id_card" required>
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
               
                 <div class="form-group">
                <label>Email:</label>

                <div class="input-group input-group-lg">
                  <div class="input-group-addon">
                    <i class="fa fa-user"></i>
                  </div>
                  <input type="text" name="email" id="email" class="form-control" ng-model="email" required>
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
                <div class="form-group">
                <label>password:</label>

                <div class="input-group input-group-lg">
                  <div class="input-group-addon">
                    <i class="fa fa-user"></i>
                  </div>
                  <input type="password" name="password" id="batch_no" class="form-control" ng-model="password" required>
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
                
              <!-- /.form group -->
              <input type="submit" value="Add Admin" name="submit" id="submit" class="btn btn-primary">
              </form>
              
              
                       
         </div>
                    
                </div><br><br>
                <div class="row  col-md-6"style="margin-top:-10px;">
                    <div class="add_student_well" style="padding:10px;"><strong>&nbsp;admin Name: </strong><span></span><p style="padding-left: 5px; color:blue; font-family:bold; font-size:30px" ng-bind="name"></p></div>
                    <div class="add_student_well" style="padding:10px;"><strong>&nbsp;ID Card:</strong><p style="padding-left: 5px; color:blue; font-family:bold; font-size:30px" ng-bind="id_card"></p></div>
                    <div class="add_student_well" style="padding:10px;"><strong>&nbsp;Email:</strong><p style="padding-left: 5px; color:blue; font-family:bold; font-size:30px" ng-bind="email"></p></div>
                    
                    <br><br>
                </div>
     </div>
 </div>


<div class="preload">
  <img src="img/ajax_loader.gif"/>
</div>
