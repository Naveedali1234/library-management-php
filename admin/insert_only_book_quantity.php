<?php include_once 'db.php';
    $book_quantity=$_POST["quantity"];
    $book_isbn= $_POST['book_isbn'];
    $addition=$_POST["addition"];
    $subtraction=$_POST["subtraction"];
    if($addition== "add"){
                $query="select remaining_quantity from book where isbn='$book_isbn'";
                $row=mysql_query($query);
                $remaining_book_quantity=mysql_fetch_assoc($row);
                $remaining_quantity=$remaining_book_quantity['remaining_quantity'];
                
		$query="update book set quantity='$book_quantity' ,remaining_quantity='$remaining+$remaining_quantity'  where isbn ='$book_isbn'";
		mysql_query($query);
        }
        else if($subtraction== "subtract" && $remaining >= $_POST["quantity"]){
                $quantity=$quantity-$_POST["quantity"];
                $remaining=$remaining-$_POST["quantity"];
		$query="update book set book_title='$book_title',book_author='$book_author',place_of_publisher='$place_of_publisher',year_of_publication='$year_of_publication',pages='$pages',size='$size',binding='$binding',cost='$cost',volume='$volume',publisher='$publisher',company='$company',bill_no='$bill_no',isbn='$isbn',barcode_id='$barcode_id',quantity='$quantity',remaining_quantity='$remaining'  where isbn ='$isbn'";
		mysql_query($query);
        }
        
?>


