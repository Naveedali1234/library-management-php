<?php session_start();
include_once 'db.php';
    
    if(isset($_POST['add'])){
        $book_quantity=$_POST["quantity"];
        $_SESSION['check']=$_POST['add'];
        $_SESSION['checking_quantity_number']=$_POST['quantity'];
        $book_isbn= $_POST['book_isbn'];
        $_SESSION['book_isbn']=$_POST['book_isbn'];
        if($book_quantity==null && $book_isbn==null)
        {
            ?>
                <?php            
                header('location: add_subtract_bookQuantity.php');
        }
                else
                {
                    $row=mysql_query('select isbn from book where isbn="'.$book_isbn.'"');
                    $selected_isbn=mysql_fetch_assoc($row);
                    
                    if($book_isbn==$selected_isbn['isbn'])
                    {
                        
                        
                        $query="select barcode_id,quantity,remaining_quantity from book where isbn='$book_isbn'";
                        $row=mysql_query($query);
                        $remaining_and_total_quantity=mysql_fetch_assoc($row);
                        $total_quantity=$remaining_and_total_quantity['quantity'];
                        //$remaining_quantity=$remaining_and_total_quantity['remaining_quantity'];
                        $quantity=$total_quantity+$_POST["quantity"];
                        $remaining_quantity=$remaining_and_total_quantity['remaining_quantity']+$_POST["quantity"];
                        $_SESSION['barcode_id_for_updating_quantity']=$remaining_and_total_quantity['barcode_id'];
                        $_SESSION['total_copies']=$quantity;
                        $_SESSION['remaining_copies']=$remaining_quantity;
                        $_SESSION['remain']=$remaining_quantity;
                        $_SESSION['total_book_quantity_for_checking']=$quantity;
                        
                    }
                    else
                    {
                        header('location: add_subtract_bookQuantity.php');
                    }
                }
    
                
        }
         if(isset($_POST['subtract'])){
                 $_SESSION['check']=$_POST['subtract'];
                 $book_quantity=$_POST["quantity"];
                 $_SESSION['checking_quantity_number']=$_POST['quantity'];
                 $book_isbn= $_POST['book_isbn'];
                 $_SESSION['book_isbn']=$_POST['book_isbn'];
                 if($book_quantity==null && $book_isbn==null)
                    {            
                            header('location: add_subtract_bookQuantity.php');
                    }
                    else
                    {
                      $row=mysql_query('select isbn from book where isbn="'.$book_isbn.'"');
                    $selected_isbn=mysql_fetch_assoc($row);
                    if($book_isbn==$selected_isbn['isbn'])
                    {   
                        $query="select barcode_id,quantity,remaining_quantity from book where isbn='$book_isbn'";
                        $row=mysql_query($query);
                        $remaining_book_quantity=mysql_fetch_assoc($row);
                        if($remaining_book_quantity['remaining_quantity']>=$book_quantity)
                        {
                        
                            $total_quantity=$remaining_book_quantity['quantity'];
                            //$remaining_quantity=$remaining_book_quantity['remaining_quantity'];
                            $quantity=$total_quantity-$_POST["quantity"];
                            $remaining_quantity=$remaining_book_quantity['remaining_quantity']-$_POST["quantity"];
                            $_SESSION['barcode_id_for_updating_quantity']=$remaining_book_quantity['barcode_id'];
                            $_SESSION['total_copies']=$quantity;
                            $_SESSION['remaining_copies']=$remaining_quantity;
                            //$_SESSION['remain']=$remaining1;
                            $_SESSION['total_book_quantity_for_checking']=$quantity;
                        }
                        else
                        {
                            header('location: add_subtract_bookQuantity.php');
                        }
                    }
                    else
                    {
                        header('location: add_subtract_bookQuantity.php');
                    }
                    }
                
                
    }
   
    
    if(isset($_GET["submit"]))
{
       if($_SESSION['check']=='add'){ 
        $barcode1=$_SESSION['barcode_id_for_updating_quantity'];
	$accession_no1=$_GET['access'];
        $quantity1=$_SESSION['total_copies'];
        $remaining_quantity=$_SESSION['remaining_copies'];
        $book_isbn=$_SESSION['book_isbn'];
        
        $row2=mysql_query('select accession_no from book_copy where accession_no="'.$accession_no1.'"');
        $accession_no=mysql_fetch_assoc($row2);
        
        if($accession_no['accession_no']==$accession_no1){
            ?>
                <div class="alert alert-warning alert-dismissable">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                <strong>Warning!</strong> This accession no already exist.
                 </div>
                <?php
        }
        else
        {
            
            $query="update book set quantity='$quantity1' ,remaining_quantity='$remaining_quantity'  where isbn ='$book_isbn'";
            mysql_query($query);
            $check=1;
            while($check <=$_SESSION['checking_quantity_number']){
            mysql_query("insert into book_copy (barcode_id,accession_no,status) VALUES ('$barcode1','$accession_no1','available')");
            $check=$check+1;
            $accession_no1=$accession_no1+1;
            $row= mysql_query("select accession_no from book_copy where barcode_id='$barcode1'"); 
        if(mysql_num_rows($row)==$_SESSION['total_copies']){
            header("location:list_of_book.php"); 
        }
        }
             
        }
       }
        if($_SESSION['check']=='subtract'){ 
                $barcode1=$_SESSION['barcode_id_for_updating_quantity'];
                $accession_no2=$_GET['access'];
                $quantity1=$_SESSION['total_copies'];
                $remaining_quantity=$_SESSION['remaining_copies'];
                $book_isbn=$_SESSION['book_isbn'];
                
                $row2=mysql_query('select accession_no from book_copy where accession_no="'.$accession_no2.'"');
                $accession_n=mysql_fetch_assoc($row2);
                if($accession_n['accession_no']!=$accession_no2)
                {
                    ?>
                <div class="alert alert-warning alert-dismissable">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                <strong>Warning!</strong> This accession no is not valid.
                 </div>
                <?php
                }
                else
                {
                  $queryy=mysql_query('select accession_no from borrowing_info where accession_no="'.$accession_no2.'"');
                  $access=mysql_fetch_assoc($queryy);
                  if($access['accession_no']!=$accession_no2)
                  {
                      mysql_query("update book set quantity='$quantity1' ,remaining_quantity='$remaining_quantity'  where isbn ='$book_isbn'");
                      mysql_query("delete from book_copy where accession_no='$accession_no2'");
                      $row= mysql_query("select accession_no from book_copy where barcode_id='$barcode1'"); 
                      if(mysql_num_rows($row)==$_SESSION['total_book_quantity_for_checking']){
                        header("location:list_of_book.php"); 
                    }
                  }
                  else
                  {
                     ?>
                <div class="alert alert-warning alert-dismissable">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                <strong>Warning!</strong> This book is already issued. Return it first.
                 </div>
                <?php 
                  }
                }
                
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
    <body>
    <div class="container">
     <div class="row panel panel-primary add_student_well">
              <div class="panel-heading bg-primary"><h3><i class="glyphicon glyphicon-search animated flash"></i> Entering the Accession Numbers</h3></div>
          	<div class="col-md-12">
               
                <div class="panel-body">
           <div class="col-md-12 well" style="margin-top:5%;">
               <form action="inserting_bookQuantity.php" method="GET">
                  <div class="form-group">
                        <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                        <div class="input-group input-group-lg">
                          <div class="input-group-addon">Accession no</div>
                          <input type="number" class="form-control search" id="exampleInputAmount" name="access" placeholder="Accession no">
                        
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
   
     </div>
   
     </body>
</html>


