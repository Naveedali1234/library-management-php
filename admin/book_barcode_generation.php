<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Search</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="js/jquery-3.1.1.min.js" type="text/javascript"></script>
    
</head>
<?php include('header.php');
 include 'db.php';
if(isset($_GET['submit'])){
 require_once './barcodegen.1d-php5.v5.2.1/class/BCGFontFile.php';
 require_once './barcodegen.1d-php5.v5.2.1/class/BCGColor.php';
 require_once './barcodegen.1d-php5.v5.2.1/class/BCGDrawing.php';
 require './barcodegen.1d-php5.v5.2.1/class/BCGisbn.barcode.php';
 $font = new BCGFontFile('./barcodegen.1d-php5.v5.2.1/font/Arial.ttf', 18);
 $colorFront = new BCGColor(0, 0, 0);
$colorBack = new BCGColor(255, 255, 255);
$text=$_GET['isbn'];
// Barcode Part
$code = new BCGcode39();
$code->setScale(2);
$code->setThickness(30);
$code->setForegroundColor($colorFront);
$code->setBackgroundColor($colorBack);
$code->setFont($font);
$b=$code->parse($text);
$a=$code->getLabel($text);

// Drawing Part
$drawing = new BCGDrawing('img/'.$text, $colorBack);
$drawing->setBarcode($code);

$row=mysql_query('update book set barcode_id="'.$text.'" where isbn="'.$text.'"');
$drawing->draw();
$drawing->finish(BCGDrawing::IMG_FORMAT_PNG);
}
?>
<body>
    <div class="container">
     <div class="row panel panel-primary add_student_well">
              <div class="panel-heading bg-primary"><h3><i class="glyphicon glyphicon-search animated flash"></i> Lost Book</h3></div>
          	<div class="col-md-12">
               
                <div class="panel-body">
                <div class="col-md-12 " style="margin-top:5%;">
                    <form action="book_barcode_generation.php" method="get">
                  <div class="form-group">
                        <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                        <div class="input-group input-group-lg">
                          <div class="input-group-addon">Book ISBN</div>
                          <input type="text" class="form-control search" id="exampleInputAmount" name="isbn" placeholder="Enter ISBN">                        </div>
                  </div>
                   <div class="form-group">
                        <div class="input-group input-group-lg">
                          <input type="submit" class="form-control btn-primary" value="Generate Barcode" name="submit">
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






