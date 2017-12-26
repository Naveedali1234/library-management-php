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
    include('header.php');
    require_once('db.php');
	
	if(filter_input(INPUT_POST, 'submit', FILTER_SANITIZE_STRING)){
            $query='select isbn from book where isbn="'.$_POST['isbn'].'"';
                $check=mysql_query($query);
                if(mysql_num_rows($check)!=0)
                {?>
                    <div class="alert alert-warning alert-dismissable">'
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    <strong>Warning!</strong> The Book of this ISBN already exist.
                     </div>
               <?php }
               else
               {
                     require_once './barcodegen.1d-php5.v5.2.1/class/BCGFontFile.php';
                     require_once './barcodegen.1d-php5.v5.2.1/class/BCGColor.php';
                     require_once './barcodegen.1d-php5.v5.2.1/class/BCGDrawing.php';
                     require './barcodegen.1d-php5.v5.2.1/class/BCGcode39.barcode.php';
                     
                     
            $student_name= filter_input(INPUT_POST, 'student_name', FILTER_SANITIZE_STRING);
            $_SESSION["quantity1"]=filter_input(INPUT_POST, 'quantity', FILTER_SANITIZE_NUMBER_INT);
            //$_SESSION["barcode_id"]=filter_input(INPUT_POST, 'barcode_id', FILTER_SANITIZE_STRING);
	$book_title=filter_input(INPUT_POST, 'book_title', FILTER_SANITIZE_STRING);
	$book_author=filter_input(INPUT_POST, 'book_author', FILTER_SANITIZE_STRING);
	$place_of_publisher=filter_input(INPUT_POST, 'place_of_publisher', FILTER_SANITIZE_STRING);
	$year_of_publication=filter_input(INPUT_POST, 'year_of_publication', FILTER_SANITIZE_STRING);
	$pages=filter_input(INPUT_POST, 'pages', FILTER_SANITIZE_STRING);
	$size=filter_input(INPUT_POST, 'size', FILTER_SANITIZE_STRING);
	$binding=filter_input(INPUT_POST, 'binding', FILTER_SANITIZE_STRING);
	$cost=filter_input(INPUT_POST, 'cost', FILTER_SANITIZE_STRING);
	$volume=filter_input(INPUT_POST, 'volume', FILTER_SANITIZE_STRING);
	$publisher=filter_input(INPUT_POST, 'publisher', FILTER_SANITIZE_STRING);
	$company=filter_input(INPUT_POST, 'company', FILTER_SANITIZE_STRING);
	$bill_no=filter_input(INPUT_POST, 'bill_no', FILTER_SANITIZE_STRING);
	$isbn=filter_input(INPUT_POST, 'isbn', FILTER_SANITIZE_STRING);
        $_SESSION['isbn']=$isbn;
	$barcode_id=filter_input(INPUT_POST, 'isbn', FILTER_SANITIZE_STRING);
	$quantity=filter_input(INPUT_POST, 'quantity', FILTER_SANITIZE_STRING);
        $_SESSION['book_copy']=filter_input(INPUT_POST, 'quantity', FILTER_SANITIZE_STRING);
        
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
        $code->parse($isbn);
        $code->getLabel($isbn);

        // Drawing Part
        $drawing = new BCGDrawing('book-barcode-images/'.$isbn, $colorBack);
        $drawing->setBarcode($code);

        
        $drawing->draw();
        $drawing->finish(BCGDrawing::IMG_FORMAT_PNG);
	
	mysql_query("insert into book (book_title,book_author,place_of_publisher,year_of_publication,pages,size,binding,cost,volume,publisher,company,bill_no,isbn,barcode_id,quantity,remaining_quantity)
	values('$book_title','$book_author','$place_of_publisher','$year_of_publication','$pages','$size','$binding','$cost','$volume','$publisher','$company','$bill_no','$isbn','$barcode_id','$quantity','$quantity')")or die(mysql_error());
	$row=mysql_query('update book set barcode_id="'.$isbn.'" where isbn="'.$isbn.'"');
        header("location:insert_book.php");

               }
}
?>

        <div class="container content">
        <div class="row panel panel-primary add_student_well">
        <div class="panel-heading bg-primary"><h4><i class="glyphicon glyphicon-plus"></i> Add Book</h4></div>
          	
            	<form method="post" action="add_book.php" onSubmit="return confirm('Are you sure to add this Book Record?')">
                <div class="col-md-6" style="margin-top:15px;">
                    <div class="form-group">
                <label>Book Title:</label>

                <div class="input-group input-group-lg">
                  <div class="input-group-addon">
                    <i class="fa fa-book"></i>
                  </div>
                    <input type="text" name="book_title" class="form-control" required>
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
               
                 <div class="form-group">
                <label>Book Author:</label>

                <div class="input-group input-group-lg">
                  <div class="input-group-addon">
                    <i class="fa fa-book"></i>
                  </div>
                    <input type="text" name="book_author" required class="form-control">
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
                    <input type="text" name="place_of_publisher" class="form-control">
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
                  <input type="text" required name="year_of_publication" class="form-control">
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
                    <input type="text" required name="pages" class="form-control">
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
                    <input type="text" name="size" class="form-control">
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
                    <input type="text" required name="binding" class="form-control">
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
                    <input type="text" name="cost" class="form-control">
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
                    <input type="text" name="volume" class="form-control">
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
                    <input type="text" required name="publisher" class="form-control">
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
                    <input type="text" name="company" class="form-control">
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
                    <input type="text" name="bill_no" class="form-control">
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
                    <input type="text" name="isbn" class="form-control" required>
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
              
              <!-- /.form group -->
              <div class="form-group">
                <label>Quantity:</label>

                <div class="input-group input-group-lg">
                  <div class="input-group-addon">
                    <i class="fa fa-laptop"></i>
                  </div>
                    <input type="text" name="quantity" class="form-control">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
              </div>

              <input type="submit" value="Add Book" name="submit" class="btn btn-primary btn-lg" style="margin-top:100px;"><br>&nbsp
            </form>
           
          </div>
        </div>
        <!-- /.box-body -->
        
        
  
<div class="preload">
  <img src="img/ajax_loader.gif"/>
</div>   
      