<?php session_start(); 
	require_once('db.php');
	
//	if(isset($_POST['submit'])){
//            $_SESSION["quantity"]=$_POST['quantity'];
//            $_SESSION["barcode_id"]=$_POST['barcode_id'];
//	$book_title=$_POST['book_title'];
//	$book_author=$_POST['book_author'];
//	$place_of_publisher=$_POST['place_of_publisher'];
//	$year_of_publication=$_POST['year_of_publication'];
//	$pages=$_POST['pages'];
//	$size=$_POST['size'];
//	$binding=$_POST['binding'];
//	$cost=$_POST['cost'];
//	$volume=$_POST['volume'];
//	$publisher=$_POST['publisher'];
//	$company=$_POST['company'];
//	$bill_no=$_POST['bill_no'];
//	$isbn=$_POST['isbn'];
//	$barcode_id=$_POST['barcode_id'];
//	$quantity=$_POST['quantity'];
//	
//	mysql_query("insert into book (book_title,book_author,place_of_publisher,year_of_publication,pages,size,binding,cost,volume,publisher,company,bill_no,isbn,barcode_id,quantity,remaining_quantity)
//	 values('$book_title','$book_author','$place_of_publisher','$year_of_publication','$pages','$size','$binding','$cost','$volume','$publisher','$company','$bill_no','$isbn','$barcode_id','$quantity','$quantity')")or die(mysql_error());
//	

if(isset($_GET["submit"]))
{
    
      $number_of_the_quantity=$_SESSION["quantity"];
    $barcode1=$_SESSION["barcode_id1"];
	$accession_no=$_GET['access'];
        
        mysql_query("insert into book_copy (barcode_id,accession_no) VALUES ('$barcode1','$accession_no')");
        
         $row= mysql_query("select accession_no from book_copy where barcode_id='$barcode1'"); 
    if(mysql_num_rows($row)==$number_of_the_quantity){
            header("location:list_of_book.php"); 
    }
}




?>
<html>
<head>
    <meta charset="utf-8">
    <title>Entering Accession No</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="js/jquery-3.1.1.min.js" type="text/javascript"></script>
    </head>
    <div class="container">
     <div class="row panel panel-primary add_student_well">
              <div class="panel-heading bg-primary"><h3><i class="glyphicon glyphicon-search animated flash"></i> Entering the Accession Numbers</h3></div>
          	<div class="col-md-12">
               
                <div class="panel-body">
           <div class="col-md-12 well" style="margin-top:5%;">
               <form action="update_book.php" method="GET">
                  <div class="form-group">
                        <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                        <div class="input-group input-group-lg">
                          <div class="input-group-addon">Accession no</div>
                          <input type="text" class="form-control search" id="exampleInputAmount" name="access" placeholder="Accession no">
                         <input type="submit" value="Add accession no" name="submit" class="btn btn-primary">
                        </div>
                  </div>
                          
                </form>
                <div class="success"></div>
           </div>
       </div>
       
   </div> 
   
  
   
     </body>
</html>