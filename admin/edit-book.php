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
<?php //session_start();

	 require_once('db.php');
         $original_quantity;
         $remaining;
	if(isset($_GET['edit'])){
		
		$isbn=$_GET['edit'];
		$query="select * from book where isbn = '$isbn'";
		$run=mysql_query($query);
		if(mysql_num_rows($run) > 0 ){
			$row = mysql_fetch_array($run);
			$book_title=$row['book_title'];
                        $book_author=$row['book_author'];
                        $place_of_publisher=$row['place_of_publisher'];
                        $year_of_publication=$row['year_of_publication'];
                        $pages=$row['pages'];
                        $size=$row['size'];
                        $binding=$row['binding'];
                        $cost=$row['cost'];
                        $volume=$row['volume'];
                        $publisher=$row['publisher'];
                        $company=$row['company'];
                        $bill_no=$row['bill_no'];
                        $isbn=$row['isbn'];
                        $barcode_id=$row['barcode_id'];
                        $quantity=$row['quantity'];
                        $remaining=$row['remaining_quantity'];
                        $_SESSION['remaining']=$remaining;
                        

		}
		
		
	}
        
        if(isset($_POST['submit'])){
		$isbn=$_GET['edit-form'];
		$book_title=$_POST['book_title'];
	$book_author=$_POST['book_author'];
	$place_of_publisher=$_POST['place_of_publisher'];
	$year_of_publication=$_POST['year_of_publication'];
	$pages=$_POST['pages'];
	$size=$_POST['size'];
	$binding=$_POST['binding'];
	$cost=$_POST['cost'];
	$volume=$_POST['volume'];
	$publisher=$_POST['publisher'];
	$company=$_POST['company'];
	$bill_no=$_POST['bill_no'];
	$isbn=$_POST['isbn'];
	$barcode_id=$_POST['barcode_id'];
	//$quantity=$_POST['quantity'];
        $_SESSION["barcode_id1"]=$_POST['barcode_id'];
//        if($_POST["check"]== "add"){
//                $_SESSION['quantity']=$quantity;
//                $quantity=$quantity+$_POST["quantity"];
//                $remaining1=$_SESSION['remaining']+$_POST["quantity"];
		$query="update book set book_title='$book_title',book_author='$book_author',place_of_publisher='$place_of_publisher',year_of_publication='$year_of_publication',pages='$pages',size='$size',binding='$binding',cost='$cost',volume='$volume',publisher='$publisher',company='$company',bill_no='$bill_no',isbn='$isbn',barcode_id='$barcode_id'  where isbn ='$isbn'";
		if(mysql_query($query)){
		header("location:list_of_book.php");
		}
       // }
//        else if($_POST["check"]== "subtract" && $remaining >= $_POST["quantity"]){
//                $quantity=$quantity-$_POST["quantity"];
//                $remaining1=$_SESSION['remaining']-$_POST["quantity"];
//		$query="update book set book_title='$book_title',book_author='$book_author',place_of_publisher='$place_of_publisher',year_of_publication='$year_of_publication',pages='$pages',size='$size',binding='$binding',cost='$cost',volume='$volume',publisher='$publisher',company='$company',bill_no='$bill_no',isbn='$isbn',barcode_id='$barcode_id',quantity='$quantity',remaining_quantity='$remaining'  where isbn ='$isbn'";
//		if(mysql_query($query)){
//		header("location:update_book.php");
//		}
//        }
//        else{
//            echo "Remaining books quantity is too low to subtract this quantity";
//        }
//        
	}
?>

<?php include('header.php'); ?>

      <div class="container content">
        <div class="row panel panel-primary add_student_well">
        <div class="panel-heading bg-primary"><h4><i class="glyphicon glyphicon-plus"></i> Add Book</h4></div>
          	<div class="col-md-6" style="margin-top:15px;">
                    <form method="post" enctype="multipart/form-data" action="edit-book.php?edit-form=<?php echo $isbn ; ?>">
                <div class="form-group">
                <label>Book Title:</label>

                <div class="input-group input-group-lg">
                  <div class="input-group-addon">
                    <i class="fa fa-laptop"></i>
                  </div>
                    <input type="text" name="book_title" class="form-control" value="<?php echo $book_title;?>">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
               
                 <div class="form-group">
                <label>Book Author:</label>

                <div class="input-group input-group-lg">
                  <div class="input-group-addon">
                    <i class="fa fa-laptop"></i>
                  </div>
                  <input type="text" name="book_author" class="form-control" value="<?php echo $book_author;?>">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
               
                 <div class="form-group">
                <label>Place of Publication:</label>

                <div class="input-group input-group-lg">
                  <div class="input-group-addon">
                    <i class="fa fa-laptop"></i>
                  </div>
                    <input type="text" name="place_of_publisher" class="form-control" value="<?php echo $place_of_publisher;?>">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
                <div class="form-group">
                <label>Year of Publication:</label>

                <div class="input-group input-group-lg">
                  <div class="input-group-addon">
                    <i class="fa fa-laptop"></i>
                  </div>
                  <input type="text" name="year_of_publication" class="form-control" value="<?php echo $year_of_publication;?>">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
                <div class="form-group">
                <label>Pages:</label>

                <div class="input-group input-group-lg">
                  <div class="input-group-addon">
                    <i class="fa fa-laptop"></i>
                  </div>
                    <input type="text" name="pages" class="form-control" value="<?php echo $pages;?>">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
                <div class="form-group">
                <label>Size:</label>

                <div class="input-group input-group-lg">
                  <div class="input-group-addon">
                    <i class="fa fa-laptop"></i>
                  </div>
                    <input type="text" name="size" class="form-control" value="<?php echo $size;?>">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
              <div class="form-group">
                <label>Binding:</label>

                <div class="input-group input-group-lg">
                  <div class="input-group-addon">
                    <i class="fa fa-laptop"></i>
                  </div>
                    <input type="text" name="binding" class="form-control" value="<?php echo $binding;?>">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
              <div class="form-group">
                <label>Cost:</label>

                <div class="input-group input-group-lg">
                  <div class="input-group-addon">
                    <i class="fa fa-laptop"></i>
                  </div>
                    <input type="text" name="cost" class="form-control" value="<?php echo $cost;?>">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
              </div>
              <div class="col-md-6" style="margin-top:15px;">
              <div class="form-group">
                <label>Volume:</label>

                <div class="input-group input-group-lg">
                  <div class="input-group-addon">
                    <i class="fa fa-laptop"></i>
                  </div>
                    <input type="text" name="volume" class="form-control" value="<?php echo $volume;?>">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
              <div class="form-group">
                <label>Publisher:</label>

                <div class="input-group input-group-lg">
                  <div class="input-group-addon">
                    <i class="fa fa-laptop"></i>
                  </div>
                    <input type="text" name="publisher" class="form-control" value="<?php echo $publisher;?>">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
              <div class="form-group">
                <label>Company:</label>

                <div class="input-group input-group-lg">
                  <div class="input-group-addon">
                    <i class="fa fa-laptop"></i>
                  </div>
                    <input type="text" name="company" class="form-control" value="<?php echo $company;?>">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
              <div class="form-group">
                <label>Bill number:</label>

                <div class="input-group input-group-lg">
                  <div class="input-group-addon">
                    <i class="fa fa-laptop"></i>
                  </div>
                    <input type="text" name="bill_no" class="form-control" value="<?php echo $bill_no;?>">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
              <div class="form-group">
                <label>ISBN:</label>

                <div class="input-group input-group-lg">
                  <div class="input-group-addon">
                    <i class="fa fa-laptop"></i>
                  </div>
                    <input type="text" name="isbn" class="form-control" value="<?php echo $isbn;?>">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
              <div class="form-group">
                <label>Barcode id:</label>

                <div class="input-group input-group-lg">
                  <div class="input-group-addon">
                    <i class="fa fa-laptop"></i>
                  </div>
                    <input type="text" name="barcode_id" class="form-control" value="<?php echo $barcode_id;?>">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
              <div class="form-group">
                <label>Total Quantity:</label>

                <div class="input-group input-group-lg">
                  <div class="input-group-addon">
                    <i class="fa fa-laptop"></i>
                  </div>
                    <input type="text" readonly="true" name="o_quantity" class="form-control" value="<?php echo $quantity;?>">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
<!--              <div class="form-group">
                <label>Add/subtract Quantity:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-laptop"></i>
                  </div>
                    <input type="text" name="quantity" class="form-control">
                </div>
                <label class="checkbox-inline">
                <input type="radio" name="check" value="add" > Add Book Quantity
                </label>
                <label class="checkbox-inline">
                <input type="radio" name="check" value="subtract" >Subtract Book Quantity
                </label>
                 /.input group 
              </div>
               /.form group -->
               </div>

              <input type="submit" value="Update Book" name="submit" class="btn btn-primary btn-lg" style="margin-top:100px;"><br> &nbsp
              </form>
                      </div>
        </div>
        <!-- /.box-body -->
                
</body>
</html>
<div class="preload">
  <img src="img/ajax_loader.gif"/>
</div> 

<?php
	
	
?>