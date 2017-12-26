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
<?php

	 require_once('db.php');
	if(isset($_GET['edit'])){
		
		$reg_no=$_GET['edit'];
		$query="select * from student where registration_no = '$reg_no'";
		$run=mysql_query($query);
		if(mysql_num_rows($run) > 0 ){
			$row = mysql_fetch_array($run);
			$reg_no=$row['registration_no'];
			$student_name=$row['student_name'];
			$father_name=$row['father_name'];
			$batch_no=$row['batch'];
			$department=$row['department'];

		}
		
		
	}
        if(isset($_POST['submit'])){
		$reg_no=$_GET['edit_form'];
		$student_name=$_POST['student_name'];
		$father_name=$_POST['father_name'];
		$batch_no=$_POST['batch_no'];
		$department=$_POST['department'];
		$query="update student set registration_no='$reg_no' ,student_name='$student_name' , father_name='$father_name' ,  batch='$batch_no' , department='$department'  where registration_no ='$reg_no'";
		if(mysql_query($query)){
		header("location:list_of_student.php");
		}
	}
?>

<?php include('header.php'); ?>
<html>
    <body>

      <div class="container content">
     <div class="row panel panel-primary add_student_well">
              <div class="panel-heading bg-primary"><h3><i class="glyphicon glyphicon-plus"></i> Update Student</h3></div>
          	<div class="col-md-12">
            <div class="panel-body">
            	<form method="post" enctype="multipart/form-data" action="edit-student.php?edit_form=<?php  echo $reg_no; ?>">
                <div class="form-group">
                <label>Student Name:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-laptop"></i>
                  </div>
                  <input type="text" name="student_name" class="form-control" value="<?php echo $student_name; ?>">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
               
                 <div class="form-group">
                <label>Father Name:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-laptop"></i>
                  </div>
                  <input type="text" name="father_name" class="form-control" value="<?php  echo $father_name; ?>">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
               
                 <div class="form-group">
                <label>Registration Number:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-laptop"></i>
                  </div>
                  <input type="text" name="reg_no" class="form-control" value="<?php  echo $reg_no; ?>">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
                <div class="form-group">
                <label>Batch Number:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-laptop"></i>
                  </div>
                  <input type="text" name="batch_no" class="form-control" value="<?php  echo $batch_no; ?>">
                </div>
                <!-- /.input group -->
              </div>
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
              
<!--              <div class="form-group">
                <label>Mobile Number:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-laptop"></i>
                  </div>
                  <input type="text" name="mobile_no" class="form-control" value="<?php  echo $mobile_no; ?>">
                </div>
                 /.input group 
              </div>-->
              
<!--              <div class="form-group">
                <label>Email:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-laptop"></i>
                  </div>
                  <input type="text" name="email" class="form-control" value="/]">
                </div>
                 /.input group 
              </div>-->
              <!-- /.form group -->
              <div class="form-group">
                  <label for="status">Status</label>
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-laptop"></i>
                  </div>
                  <select class="form-control" name="status" id="sel1" value="<?php  echo $status; ?>">
                  	
                    <option>Active</option>
                    <option>Inactive</option>
                    
                  </select>
                  </div>
      			 </div>
              
              <!-- /.form group -->
               
              <!-- /.form group -->
              <input type="submit" value="Update student" name="submit" class="btn btn-primary">
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