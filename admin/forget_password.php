<?php session_start();

require_once("db.php");
$result='';
$id_card='';
  if(isset($_POST['submit'])){

    $id_card=test_input($_POST['id_card']);
    $id_card=mysql_real_escape_string($id_card);
    if(!empty($id_card)){
        $query=mysql_query("SELECT password,email FROM admin WHERE id_card='$id_card'");
        if(mysql_num_rows($query)>0){
          $row=mysql_fetch_assoc($query);
          $password=$row['password'];
	  $email=$row['email'];
          // date and time

          $datetime = new DateTime;
          $otherTZ  = new DateTimeZone('Asia/Karachi');
          $datetime->setTimezone($otherTZ);
         
          $date = $datetime->format('m/d/Y');
          $time = $datetime->format('g:i a');

          //=========
          

          $to=$email;
          $message="Request date : $date.\n Request Time : $time \n\n\n Requested by : $username \n\n\n Password : $password";
          $subject="Forget Password Request";
          if(mail($to,$subject,$message))
          {
            $result="<div class = 'alert-success alert newsdiv'>Your password is sent to you through Email!<br>Please check your email</div>";

          }
          else
          {
            $result="<div class = 'alert-danger alert newsdiv'>Unknown error! Please contact your developer.</div>";
          }

          header("refresh:5;admin.php");


        }else{
          $result="<div class = 'alert-danger alert newsdiv'>Invalid UserName!</div>";
        }

    }
  }

//validating the fields
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
  return $data;
  }



?>

<html>
<head>
  <title>library</title>
   
  <meta http-equiv="X-UA-compatible" Content="IE-edge">
  <meta name="viewport" content="width=device-width">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="admin_script.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  


<style type="text/css">

.my_login_form{
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  margin-left:25%;
  margin-bottom: 120px;
  margin-top: 70px;
  padding-bottom: 30px;
}
.sub_container{
  margin-left:24%; 
}
</style>
</head>
<body style = "background: #eceeef;">

  <?php //require_once"admin_header.php"; ?>
  
  <div class="col-sm-6 col-lg-6 col-xs-12 col-md-6 container thumbnail contact_us_container my_login_form" >
  

  <div class = "container-fluid">
  <div class = "row" style = "background: #4f4f4f; color:#fff;" >

    <h1 class="text-center">Forget Password</h1>


  </div>
</div>

<!-- error div-->
<div class = "row">
  <div class = " text-center text-danger col-sm-12 col-lg-12 col-xs-12 col-md-12 " style="font-size:20px;">
    <h3><?php echo $result; ?></h3>
  </div>

</div>
  <!-- error div end-->
  

  <div class="container col-lg-6 col-sm-6 col-xs-12 col-md-6 sub_container" >
    <br>
  <br>
  <form class="form-horizontal" method='post'>
    <div class="form-group">
      <label class="control-label col-sm-1 col-xs-1 col-lg-1 col-md-1" for="nm">CNIC:</label>
      <div class="col-sm-12">
        <input type="text" required class="form-control" name="id_card" placeholder="Enter CNIC here" value="<?php echo $id_card; ?>">
      </div>
    </div>
    
      
    <div class="form-group">
      <div class="col-sm-10 col-xs-12 col-lg-10 col-md-12">
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>

      </div>
    </div>

      
  </form>
  </div>
</div>
  <!-- login container end-->


</body>
</html>