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
		
		$cnic=$_GET['edit'];
		$query="select * from faculty where cnic = '$cnic'";
		$run=mysql_query($query);
		if(mysql_num_rows($run) > 0 ){
			$row = mysql_fetch_array($run);
			$name=$row['name'];
			$cnic=$row['cnic'];
			$department=$row['department'];



		}
		
		
	}
        if(isset($_POST['submit'])){
		$cnic=$_GET['edit_form'];
		$name=$_POST['name'];
		$department=$_POST['department'];

		
		$query="update faculty set name='$name' ,cnic='$cnic' , department='$department' where cnic ='$cnic'";
		if(mysql_query($query)){
		header("location:list_of_faculty.php");
		}
	}
?>

<?php include('header.php'); ?>
<html>
    <body>

      <div class="container content">
     <div class="row panel panel-primary add_student_well">
              <div class="panel-heading bg-primary"><h3><i class="glyphicon glyphicon-plus"></i> Update Faculty</h3></div>
          	<div class="col-md-12">
            <div class="panel-body">
            	<form method="post" enctype="multipart/form-data" action="edit_faculty.php?edit_form=<?php  echo $cnic; ?>">
                <div class="form-group">
                <label>Faculty Name:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-laptop"></i>
                  </div>
                  <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
               
                <!-- <div class="form-group">
                <label>CNIC number:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-laptop"></i>
                  </div>
                  <input type="text" name="cnic" class="form-control" value="<?php  //echo $cnic; ?>">
                </div>
                <!-- /.input group 
              </div> -->
              <!-- /.form group -->
               
                 <div class="form-group">
                <label>Department:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-laptop"></i>
                  </div>
                  <input type="text" name="department" class="form-control" value="<?php  echo $department; ?>">
                </div>
                <!-- /.input group -->
              </div>
             
              <!-- /.form group -->
              <input type="submit" value="Update Faculty" name="submit" class="btn btn-primary">
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