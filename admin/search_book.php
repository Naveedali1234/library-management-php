
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Search</title>
    <link rel="stylesheet" href="css/bootstrap.css">
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
    
</head>
<?php include('header.php'); ?>
<body>
    <div class="container">
     <div class="row panel panel-primary add_student_well">
              <div class="panel-heading bg-primary"><h3><i class="glyphicon glyphicon-search animated flash"></i> Search Book</h3></div>
          	<div class="col-md-12">
               
                <div class="panel-body">
           <div class="col-md-12 well" style="margin-top:5%;">
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
   
  
   
</body>
</html>






