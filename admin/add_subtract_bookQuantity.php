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
//    if(isset($_POST['submit']))
//    {
//        if($_POST["add"]== "add"){
//                $_SESSION['quantity']=$quantity;
//                $quantity=$quantity+$_POST["quantity"];
//                $remaining1=$_SESSION['remaining']+$_POST["quantity"];
//		$query="update book set book_title='$book_title',book_author='$book_author',place_of_publisher='$place_of_publisher',year_of_publication='$year_of_publication',pages='$pages',size='$size',binding='$binding',cost='$cost',volume='$volume',publisher='$publisher',company='$company',bill_no='$bill_no',isbn='$isbn',barcode_id='$barcode_id',quantity='$quantity' ,remaining_quantity='$remaining1'  where isbn ='$isbn'";
//		if(mysql_query($query)){
//		header("location:update_book.php");
//		}
//        }
//        else if($_POST["subtract"]== "subtract" && $remaining >= $_POST["quantity"]){
//                $quantity=$quantity-$_POST["quantity"];
//                $remaining1=$_SESSION['remaining']-$_POST["quantity"];
//		$query="update book set book_title='$book_title',book_author='$book_author',place_of_publisher='$place_of_publisher',year_of_publication='$year_of_publication',pages='$pages',size='$size',binding='$binding',cost='$cost',volume='$volume',publisher='$publisher',company='$company',bill_no='$bill_no',isbn='$isbn',barcode_id='$barcode_id',quantity='$quantity',remaining_quantity='$remaining'  where isbn ='$isbn'";
//		if(mysql_query($query)){
//		header("location:update_book.php");
//		}
//    }
//    }
?>

<div class="container content">
        <div class="row panel panel-primary add_student_well">
        <div class="panel-heading bg-primary"><h4><i class="glyphicon glyphicon-plus"></i> Add/Subtract Book Quantity</h4></div>
        <form method="post" enctype="multipart/form-data" action="inserting_bookQuantity.php">
              <div class="col-md-3"></div>
             <div class="col-md-6" style="margin-top:15px;">

             
             <div class="form-group">
               

                <div class="input-group input-group-lg">
                  <div class="input-group-addon">
                    <i class="fa fa-laptop"></i>
                  </div>
                    <input type="text" id="book_isbn" name="book_isbn" class="form-control" placeholder="Enter Book ISBN">
                </div>

                 
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
              <div class="form-group">
               

                <div class="input-group input-group-lg">
                  <div class="input-group-addon">
                    <i class="fa fa-laptop"></i>
                  </div>
                    <input type="text" id="book_copy" name="quantity" class="form-control" placeholder="Enter Book copies">
                </div>
                 
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
              
              
              <div class="form-group">
                  <button type="submit" id="addition" value="add"  name="add"  class="btn btn-primary form-control" style="margin-top:15px;">Add Quantity</button>
                  <button type="submit" id="subtraction" value="subtract" name="subtract"  class="btn btn-info form-control" data-toggle="modal" data-target=".bs-example-modal-lg" style="margin-top:15px;">Subtract Quantity</button>
              </div>
             </div>
            
         </form>
        
        </div>
</div>

<div class="preload">
  <img src="img/ajax_loader.gif"/>
</div>   
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  