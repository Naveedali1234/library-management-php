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
        
	if(filter_input(INPUT_POST, 'submit', FILTER_SANITIZE_STRING)){
                $query='select registration_no from student where registration_no="'.$_POST['reg_no'].'"';
                $check=mysql_query($query);
                if(mysql_num_rows($check)!=0)
                {?>
                    <div class="alert alert-warning alert-dismissable">'
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    <strong>Warning!</strong> This Student already exist.
                     </div>
               <?php }
                else{
                        $errors= array();
                          $file_name = $_FILES['image']['name'];
                          $file_size =$_FILES['image']['size'];
                          $file_tmp =$_FILES['image']['tmp_name'];
                          $file_type=$_FILES['image']['type'];
                          $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
      
                          $expensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
      
      if($file_size > 2097152){
         $errors[]='File size must be excately 2 MB';
      }
      
      if(empty($errors)==true){
                        require_once './barcodegen.1d-php5.v5.2.1/class/BCGFontFile.php';
                        require_once './barcodegen.1d-php5.v5.2.1/class/BCGColor.php';
                        require_once './barcodegen.1d-php5.v5.2.1/class/BCGDrawing.php';
                        require_once './barcodegen.1d-php5.v5.2.1/class/BCGcode39.barcode.php';
                        
                        $target_path = "../student/img/".$file_name;
                        move_uploaded_file($file_tmp,$target_path);
                        $student_name= filter_input(INPUT_POST, 'student_name', FILTER_SANITIZE_STRING);
                        $father_name=filter_input(INPUT_POST, 'father_name', FILTER_SANITIZE_STRING);
                        $reg_no=strtoupper(filter_input(INPUT_POST, 'reg_no', FILTER_SANITIZE_STRING));
                        $batch_no=filter_input(INPUT_POST, 'batch_no', FILTER_SANITIZE_STRING);
                        $department=filter_input(INPUT_POST, 'department', FILTER_SANITIZE_STRING);
                        $password=filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
                        $mobile_no=filter_input(INPUT_POST, 'mobile_no', FILTER_SANITIZE_NUMBER_INT);
                        $email=filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
                        
                        $font = new BCGFontFile('./barcodegen.1d-php5.v5.2.1/font/Arial.ttf', 18);
                        $colorFront = new BCGColor(0, 0, 0);
                        $colorBack = new BCGColor(255, 255, 255);
                        // Barcode Part
                        $code = new BCGcode39();
                        $code->setScale(2);
                        $code->setThickness(30);
                        $code->setForegroundColor($colorFront);
                        $code->setBackgroundColor($colorBack);
                        $code->setFont($font);
                        $b=$code->parse($reg_no);
                        $a=$code->getLabel($b);

                        // Drawing Part
                        $drawing = new BCGDrawing('student-barcode-images/'.$a, $colorBack);
                        $drawing->setBarcode($code);
                        $drawing->draw();

                        //header('Content-Type: image/png');
                        $drawing->finish(BCGDrawing::IMG_FORMAT_PNG);
                        
		//$status=$_POST['status'];
		
		mysql_query("INSERT INTO student (registration_no,student_name,father_name,batch,department,password,student_image,mobile_no,email) VALUES('$reg_no','$student_name','$father_name','$batch_no','$department','$password','".$_FILES['image']['name']."','$mobile_no','$email')");
		mysql_query('update student set student_barcode_id="'.$a.'" where registration_no="'.$reg_no.'"');
                ?>
                    <div class="alert alert-success alert-dismissable">'
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    <strong>Success!</strong> Student has been added.
                     </div>
               <?php
		//header('location:list_of_student.php');
      }else{
         print_r($errors);
      }
                       
		
	}
        }

?>

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js"></script>

 <div class="container content" ng-app="">
     <div class="row panel panel-primary add_student_well">
              <div class="panel-heading bg-primary"><h3><i class="glyphicon glyphicon-plus"></i> Add Student</h3></div>
          	<div class="col-md-6">
               
                    <div class="panel-body" >
            	<form method="post" action="add_student.php" enctype="multipart/form-data">
                <div class="form-group">
                <label>Student Name:</label>

                <div class="input-group  input-group-lg">
                  <div class="input-group-addon">
                    <i class="fa fa-user"></i>
                  </div>
                    <input type="text" name="student_name" class="form-control" ng-model="name" required>
                
                </div>
                
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
               
                 <div class="form-group">
                <label>Father Name:</label>

                <div class="input-group input-group-lg">
                  <div class="input-group-addon">
                    <i class="fa fa-user"></i>
                  </div>
                    <input type="text" name="father_name" class="form-control" ng-model="father_name" required>
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
               
                 <div class="form-group">
                <label>Registration Number:</label>

                <div class="input-group input-group-lg">
                  <div class="input-group-addon">
                    <i class="fa fa-user"></i>
                  </div>
                  <input type="text" name="reg_no" class="form-control" ng-model="registration_no" required>
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
                <div class="form-group">
                <label>Batch Number:</label>

                <div class="input-group input-group-lg">
                  <div class="input-group-addon">
                    <i class="fa fa-user"></i>
                  </div>
                  <input type="text" name="batch_no" class="form-control" ng-model="batch_no" required>
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
                <div class="form-group">
                <label>Department:</label>

                <div class="input-group input-group-lg">
                  <div class="input-group-addon">
                    <i class="fa fa-list"></i>
                  </div>
                  <select name="department" class="form-control selectpicker" ng-model="department" required>
                      <option value="">Select Department</option>
                      <option>Department of Computer Software</option>
                      <option>Department of Telecommunication</option>
                      <option >Department of Electrical Engineering Power</option>
                      <option >Department of Electrical Engineering Communication</option>
                  </select>
                </div>
                <!-- /.input group -->
              </div>
              
              <!-- /.form group -->
              
              <div class="form-group">
                <label>Mobile Number:</label>

                <div class="input-group input-group-lg ">
                  <div class="input-group-addon">
                    <i class="fa fa-mobile"></i>
                  </div>
                  <input type="text" name="mobile_no" class="form-control" ng-model="mobile_no" required>
                </div>
                <!-- /.input group -->
              </div>
              
              <div class="form-group">
                <label>Email:</label>

                <div class="input-group input-group-lg ">
                  <div class="input-group-addon">
                    <i class="fa fa-address-book"></i>
                  </div>
                    <input type="email" name="email" class="form-control" ng-model="email" required>
                </div>
                <!-- /.input group -->
              </div>
<!--               <div class="form-group">
                <label>Generate Barcode:</label>

                <div class="input-group input-group-lg ">
                  <div class="input-group-addon">
                    <i class="fa fa-barcode"></i>
                  </div>
                    <input type="button" onclick='$("#bc").barcode("1234567890128", "ean13");' value="Generate Barcode">  
                </div>
                 /.input group 
                <div id="bc" ng-model="email">
                    
                </div>
              </div>-->
              <!-- /.form group -->
<!--              <div class="form-group">
                  <label for="status">Status</label>
                  <div class="input-group input-group-lg">
                  <div class="input-group-addon">
                    <i class="fa fa-laptop"></i>
                  </div>
                  <select class="form-control" name="status" id="sel1">
                  	
                    <option>Active</option>
                    <option>Inactive</option>
                    
                  </select>
                  </div>
      			 </div>-->
              
              <!-- /.form group -->
              
                <div class="form-group">
                <label>Password:</label>

                <div class="input-group input-group-lg">
                  <div class="input-group-addon">
                    <i class="fa fa-lock"></i>
                  </div>
                  <input type="password" name="password" class="form-control" required>
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
               <div class="form-group">
                <label>Upload Image:</label>

                <div class="input-group input-group-lg">
                  <div class="input-group-addon">
                    <i class="fa fa-image"></i>
                  </div>
                  <input type="file" name="image" class="form-control"  required>
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
              <input type="submit" value="Add student" name="submit" class="btn btn-primary">
              </form>
                       
         </div>
                    
                </div><br><br>
                 <div class="row  col-md-6"style="margin-top:-10px;">
                    <div class="add_student_well" style="padding:10px;"><strong>&nbsp;Student Name: </strong><span></span><p style="padding-left: 5px; color:blue; font-family:bold; font-size:30px" ng-bind="name"></p></div>
                    <div class="add_student_well" style="padding:10px;"><strong>&nbsp;Fther Name:</strong><p style="padding-left: 5px; color:blue; font-family:bold; font-size:30px" ng-bind="father_name"></p></div>
                    <div class="add_student_well" style="padding:10px;"><strong>&nbsp;Registration No:</strong><p style="padding-left: 5px; color:blue; font-family:bold; font-size:30px" ng-bind="registration_no"></p></div>
                    <div class="add_student_well" style="padding:10px;"> <strong>&nbsp;Batch no:</strong><p style="padding-left: 5px; color:blue; font-family:bold; font-size:30px" ng-bind="batch_no"></p></div>
                    <div class="add_student_well" style="padding:10px;"><strong>&nbsp;Department:</strong><p style="padding-left: 5px; color:blue; font-family:bold; font-size:30px" ng-bind="department"></p></div>
                    <div class="add_student_well" style="padding:10px;"><strong>&nbsp;Mobile No:</strong><p style="padding-left: 5px; color:blue; font-family:bold; font-size:30px" ng-bind="mobile_no"></p></div>
                    <div class="add_student_well" style="padding:10px;"> <strong>&nbsp;Email:</strong><p style="padding-left: 5px; color:blue; font-family:bold; font-size:30px" ng-bind="email"></p></div>
                    <br><br>
                </div>
     </div>
 </div>
<!-- code for gif -->


<div class="preload">
  <img src="img/ajax_loader.gif"/>
</div>
