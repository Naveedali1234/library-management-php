<?php session_start(); 
	require_once('db.php');
if(isset($_GET["submit"]))
{
    $barcode=$_SESSION["isbn"];
      
    //$barcode1=$_SESSION["barcode_id"];
	$accession_no=$_GET['access'];
        $check=1;
        $row= mysql_query("select accession_no from book_copy where accession_no='$accession_no'");
        if(mysql_num_rows($row)==0){
        while($check <=$_SESSION['book_copy']){
        mysql_query("insert into book_copy (barcode_id,accession_no,status) VALUES ('$barcode','$accession_no','Available')");
        $check=$check+1;
        $accession_no=$accession_no+1;
        $row= mysql_query("select accession_no from book_copy where barcode_id='$barcode'"); 
        if(mysql_num_rows($row)==$_SESSION['book_copy']){
            header("location:list_of_book.php"); 
        }
        }
        }
        else
        {
            ?>
                    <div class="alert alert-warning alert-dismissable">'
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    <strong>Warning!</strong> The Accession no already exist.
                     </div>
               <?php 
        }
//        mysql_query("insert into book_copy (barcode_id,accession_no) VALUES ('$barcode1','$accession_no')");
//        
//         $row= mysql_query("select accession_no from book_copy where barcode_id='$barcode1'"); 
//    if(mysql_num_rows($row)==$_SESSION['quantity1']){
//            header("location:list_of_book.php"); 
//    }
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
               <form action="insert_book.php" method="GET">
                  <div class="form-group">
                        <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                        <div class="input-group input-group-lg">
                          <div class="input-group-addon">Accession no</div>
                          <input type="text" class="form-control search" id="exampleInputAmount" name="access" placeholder="Accession no">
                          </div>
                          </div>
                          <div class="form-group">
                       <div class="input-group">
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