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
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Search</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="js/jquery-3.1.1.min.js" type="text/javascript"></script>
    
</head>
<?php include('header.php'); ?>
<body>
    <div class="container content">
     <div class="row panel panel-primary add_student_well">
              <div class="panel-heading bg-primary"><h3><i class="glyphicon glyphicon-search animated flash"></i> Lost Book</h3></div>
          	<div class="col-md-12">
               
                <div class="panel-body">
                <div class="col-md-12 " style="margin-top:5%;">
               <form action="fetching_student_borrowing_record.php" method="get">
                  <div class="form-group">
                        <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                        <div class="input-group input-group-lg">
                          <div class="input-group-addon">Registration no</div>
                          <input type="text" class="form-control search" id="exampleInputAmount" name="search" placeholder="Search by Registration no">                        </div>
                  </div>
                   <div class="form-group">
                        <div class="input-group input-group-lg">
                          <input type="submit" class="form-control btn-primary" value="search" name="submit">
                        </div>
                  </div>       
                </form>
           </div>
       </div>
       
   </div> 
     </div>
    </div>
   
  
   
</body>
</html>


<div class="preload">
  <img src="img/ajax_loader.gif"/>
</div>



