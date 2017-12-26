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
	if(isset($_GET['edit'])){
		
		$id_card=$_GET['edit'];
		$query="select * from admin where id_card = '$id_card'";
		$run=mysql_query($query);
		if(mysql_num_rows($run) > 0 ){
			$row = mysql_fetch_array($run);
			$name=$row['name'];
			$id_card=$row['id_card'];
			$email=$row['email'];
			$password=$row['password'];


		}
		
		
	}
        if(isset($_POST['submit'])){
		$id_card=$_GET['edit_form'];
		$name=$_POST['name'];
		$email=$_POST['email'];
		$password=$_POST['password'];
		
		$query="update admin set name='$name' ,id_card='$id_card' , email='$email' ,  password='$password'  where id_card ='$id_card'";
		if(mysql_query($query)){
		header("location:list_of_admin.php");
		}
	}
?>

<?php include('header.php'); ?>
<html>
    <body>

      <div class="container content">
     <div class="row panel panel-primary add_student_well">
              <div class="panel-heading bg-primary"><h3><i class="glyphicon glyphicon-plus"></i> Update Admin</h3></div>
          	<div class="col-md-12">
            <div class="panel-body">
            	<form method="post" enctype="multipart/form-data" action="edit_admin.php?edit_form=<?php  echo $id_card; ?>">
                <div class="form-group">
                <label>Admin Name:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-laptop"></i>
                  </div>
                  <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
               
              <!--   <div class="form-group">
                <label>NIC number:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-laptop"></i>
                  </div>
                  <input type="text" name="id_card" class="form-control" value="<?php  //echo $id_card; ?>">
                </div>
                <!-- /.input group
              </div> -->
              <!-- /.form group -->
               
                 <div class="form-group">
                <label>Email:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-laptop"></i>
                  </div>
                  <input type="text" name="email" class="form-control" value="<?php  echo $email; ?>">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
                <div class="form-group">
                <label>Password:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-laptop"></i>
                  </div>
                  <input type="text" name="password" class="form-control" value="<?php  echo $password; ?>">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
                
               
              <!-- /.form group -->
              <input type="submit" value="Update Admin" name="submit" class="btn btn-primary">
              </form>
            </div>
          </div>
        </div>
        <!-- /.box-body -->
        
      </div>
      <!-- /.box -->
                
</body>
</html>

<div class="preload">
  <img src="img/ajax_loader.gif"/>
</div>

<?php
	
	
?>