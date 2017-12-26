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
	 require_once('db.php');
	 
	  if(isset($_GET['del'])){
        $del_id=$_GET['del'];
        //checking accession from student borrowing info
        $queryy=mysql_query('select accession_no from borrowing_info where accession_no="'.$del_id.'"');
        $student_access=mysql_fetch_assoc($queryy);
        //checking accession from faculty borrowing info
        $queryy=mysql_query('select accession_no from faculty_borrowing_info where accession_no="'.$del_id.'"');
        $faculty_access=mysql_fetch_assoc($queryy);
        
        if ($student_access['accession_no']!=$del_id && $faculty_access['accession_no']!=$del_id) {
          # code...
            // to decrement the qunatity of the book when book is delete
            $select_barcode=mysql_query('select barcode_id from book_copy where accession_no="'.$del_id.'"');
            $barcode=mysql_fetch_assoc($select_barcode);
            $db_barcode=$barcode['barcode_id'];
            $select_quantity=mysql_query('select quantity,remaining_quantity from book where barcode_id="'.$db_barcode.'"');
            $quantity=mysql_fetch_assoc($select_quantity);
            $db_quantity=$quantity['quantity'];
            $updated_quantity=$db_quantity-1;
            $db_remaining_quantity=$quantity['remaining_quantity'];
            $updated_remaining_quantity=$db_remaining_quantity-1;
            mysql_query("update book set quantity='$updated_quantity',remaining_quantity='$updated_remaining_quantity' where barcode_id='$db_barcode'");
            //to deleete the specfic accession number of the book
            $del_query="DELETE FROM book_copy WHERE accession_no = '$del_id'";
            if(mysql_query($del_query)){
            //$msg ="user has been deleted";
              echo "<div class='alert alert-info alert-dismissable'>
                            <a href='#'' class='close' data-dismiss='alert' aria-label='close'>×</a>
                            <strong>Warning!</strong> Successfully Deleted.
                             </div>";
            }
      }
      else{
        echo "<div class='alert alert-warning alert-dismissable'>
                            <a href='#'' class='close' data-dismiss='alert' aria-label='close'>×</a>
                            <strong>Warning!</strong> This book is already issued.Unable to Delete.
                             </div>";
      }
        
        // else{
        //     $error ="user has not been deleted";
        // }
    }
?>


<?php include('header.php'); ?>                    
             <div class="container content">
     <div class="row panel panel-primary add_student_well">
              <div class="panel-heading bg-primary"><h3><i class="glyphicon glyphicon-book"></i> List of Books</h3></div>
          	<div class="col-md-12">
            <div class="panel-body">
           <?php
           
				$select_query="select * from book";
				$run=mysql_query($select_query);
				if(mysql_num_rows($run) > 0){
					
		
           ?> 
            <!-- label to show the deleted label start-->
           
           
            <?php 
                        if(isset($error)){
						echo "<small class='label pull-right bg-green'>$error</small>";
                            //echo "<span style='color:red;' class='pull-right'>$error</span>";
                        }
                        else if(isset($msg)){
							echo "<small class='label pull-right bg-green'>$msg</small>";
                             //echo "<span style='color:green;' class='pull-right'>$msg</span>";
                        }
                    ?>
           <!-- label to show the deleted label end-->
            
              <table id="example1" class="table table-bordered table-striped">
                <thead class="bg-primary">
                <tr>
                  <th>Book Title</th>
                  <th>Author</th>
                  <th>ISBN</th>
                  <th>Publisher</th>
                  <th>Book Copies</th>
                  <th>Remaining Books</th>
                   <th>Action</th>
                </tr>
                </thead>
                <tbody>
                
                <?php 
                    while($row=mysql_fetch_array($run))
                            {
                                $book_title=$row['book_title'];
                                $book_author=$row['book_author'];
                                $isbn=$row['isbn'];
                                $publisher=$row['publisher'];
                                $quantity=$row['quantity'];
                                $remaining_books=$row["remaining_quantity"];
                                $_SESSION['remain']=$remaining_books;
                                

                               
                   ?>
                
                    <tr>
                  <td><?php echo $book_title ?></td>
                  <td><?php echo $book_author ?></td>
                  <td><?php echo $isbn ?></td>
                  <td><?php echo $publisher ?></td>
                  <td><?php echo $quantity?></td>
                  <td><?php echo $remaining_books?></td>
                
                  <td><a rel="tooltip"  title="Edit" href="edit-book.php?edit=<?php echo $isbn ?>"><input type="button" class="btn btn-primary" value="Edit"></a>
                  <!--<a rel="tooltip"  title="Delete" href="list_of_book.php?del=<?php echo $isbn ?>"><input type="button" class="btn btn-warning" value="Delete"></a>--></td>
                </tr>
               <?php  } ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>Book Title</th>
                  <th>Author</th>
                  <th>ISBN</th>
                  <th>Publisher</th>
                  <th>Quantity</th>
                  <th>Remaining Books</th>

                  <th>Action</th>
                </tr>
                </tfoot>
              </table>
              
              <?php 
                            
                    } // if statement wala
                    else{
                        echo "<center><h2>no user availble </h2></center>";
                    	}	
                  ?>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
                
                </div>
             </div>  <!--row --> 
             
     

<div class="preload">
  <img src="img/ajax_loader.gif"/>
</div>

