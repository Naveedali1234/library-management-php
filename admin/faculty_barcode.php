<?php //session_start();
    require_once('db.php');
    include('header.php');
    //code for issue book
    if(isset($_POST["submit"]))
    {
		    $barcodeid=$_SESSION['barcodeid'];
        $cnic=$_POST["cnic"];
        $accession_no=$_POST["acession_no"];
        
        //1st if condition for checking if the textbox are empty or not
        if($cnic!=null && $barcodeid!=null && $accession_no!=null)
        {
           //for checking that a student is registered or a valid student registration no 
            $check=mysql_query('select cnic from faculty where cnic = "'.$cnic.'"');
            $row=mysql_fetch_assoc($check);
            $check_for_faculty=$row['cnic'];
            if($check_for_faculty==$cnic)
            {
               //for checking remaining quantity
                $row=mysql_query("select remaining_quantity from book where barcode_id='$barcodeid'");
                $remaining_quantity=mysql_fetch_assoc($row);
                if($remaining_quantity["remaining_quantity"]>=1)
                {
                    //for checking an accession no if it exist in book_copy
                    $row2=mysql_query("select accession_no from book_copy where barcode_id='$barcodeid' AND accession_no='$accession_no'");
                    $access_no_of_book_copy=mysql_fetch_assoc($row2);
                    if($access_no_of_book_copy["accession_no"]==$_POST['acession_no'])
                    {
                       //checking for accession no if it is already issued or not to faculty
                        $check2=mysql_query('select accession_no from faculty_borrowing_info where accession_no="'.$accession_no.'"');
                        $selected_accession_no=mysql_fetch_assoc($check2);
                        $found_accession_no=$selected_accession_no['accession_no'];
                        //checking for accession no if it is already issued or not to student
                        $check3=mysql_query('select accession_no from borrowing_info where accession_no="'.$accession_no.'"');
                        $selected_accession_no_student=mysql_fetch_assoc($check3);
                        $found_accession_no_student=$selected_accession_no_student['accession_no'];

                        if($found_accession_no != $accession_no && $found_accession_no_student != $accession_no)
                        {
                             mysql_query("insert into faculty_borrowing_info(barcode_id,cnic,accession_no,date_of_borrowed)"
                    .       "values ('$barcodeid','$cnic','$accession_no',NOW())");
                            $select_remaining_quantity=mysql_query("select remaining_quantity from book where barcode_id='$barcodeid'");
                            $remaining_quantity=mysql_fetch_assoc($select_remaining_quantity);
                            $updated_remaining_quantity=$remaining_quantity['remaining_quantity']-1;
                            ?>
                            <div class="alert alert-success alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <strong>Success!</strong> Book has been issued.
                            </div>
                            <?php

                           mysql_query("update book set remaining_quantity='$updated_remaining_quantity' where barcode_id='$barcodeid'");
                           //email functionality
                           
                           // date and time

			          $datetime = new DateTime;
			          $otherTZ  = new DateTimeZone('Asia/Karachi');
			          $datetime->setTimezone($otherTZ);
			         
			          $date = $datetime->format('m/d/Y');
			          $time = $datetime->format('g:i a');
			
			          //=========
			          //fetch email from faculty
			          $query=mysql_query("select email from faculty where cnic='$cnic'");
			          $row=mysql_fetch_assoc($query);
			          $email=$row['email'];
			         
			         //fetch book title from book
				 $query=mysql_query("SELECT book_title FROM book WHERE barcode_id='$barcodeid'");
        			//$run= mysql_num_rows($query);
          			 $row=mysql_fetch_assoc($query);
         			 $book_title=$row['book_title'];
				 
			          $to=$email;
			          $message="Request date : $date.\n Request Time : $time \n\n\n your Cnic number : $cnic \n\n\n accession # of the book copy : $accession_no \n\n\n your barcode id of the book : $barcodeid \n\n\n Issued book title : $book_title";
			          $subject="Isssued Book Notification ";
			          mail($to,$subject,$message);
                           
                           //email end
                        }
                        else
                        {
                            ?>
                            <div class="alert alert-warning alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <strong>Warning!</strong> This book is already issued.
                             </div>
                            <?php  
                        }
                    }
                    else
                    {
                      ?>
                    <div class="alert alert-warning alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    <strong>Warning!</strong> The Accession no doesn't match for the required book.
                     </div>
               <?php  
                    }
                }
                else
                {
                   ?>
                    <div class="alert alert-warning alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    <strong>Warning!</strong> There are no books left in the Library.
                     </div>
               <?php 
                }
                
            }
            else
            {
              ?>
                    <div class="alert alert-warning alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    <strong>Warning!</strong> The Faculty CNIC is not valid.
                     </div>
               <?php  
            }
        }
        else
        {
          ?>
                    <div class="alert alert-warning alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    <strong>Warning!</strong> The Textbok must not be empty.
                     </div>
               <?php  
        }
    }
?>
      
       

  <script>

$('document').ready(function() {
    
var searchKey;
var searchTimeout;//Timer to wait a little before fetching the data
$('#barcodeid_textBox').keyup(function() {
      searchKey = $(this).val();

    clearTimeout(searchTimeout);

    searchTimeout = setTimeout(function() {
        barcodeTextboxFill(searchKey);    
    }, 400); //If the key isn't pressed 400 ms, we fetch the data
});
function barcodeTextboxFill(searchKey){
     $.ajax({
        url: 'fetching_book_title_for_barcode.php',
        type: 'POST',
        dataType: 'json',
        data: {value: searchKey},
        success: function(data) {
                $("#book_title_textBox").val(data.book_title1.book_title);
        }
    }); 
        
}
})



   </script>
   
   <!-- code for return book start -->
   
   <?php
 require_once('db.php');
    //include('header.php');
    if(isset($_POST["return_submit"]))
    {
        //$brcode_id=$_POST["barcode_id"];
		    $barcodeid=$_SESSION['barcodeid'];
        $cnic=$_POST["cnic"];
        //$issue_date=$_POST["issue_date"];
        $accession_no=$_POST["acession_no"];
        
        //check if it empty or not
        if($barcodeid !=null && $cnic !=null && $accession_no !=null)
        {
           $row=mysql_query("select accession_no,cnic,barcode_id from faculty_borrowing_info where accession_no='$accession_no'");
           $check=mysql_fetch_assoc($row);
           if($check['accession_no']==$accession_no 
             && $check['cnic']==$cnic
             && $check['barcode_id']==$barcodeid)
           {
                mysql_query("delete from faculty_borrowing_info where accession_no='$accession_no'");
                $select_remaining_quantity=mysql_query("select remaining_quantity from book where barcode_id='$barcodeid'");
                $remaining_quantity=mysql_fetch_assoc($select_remaining_quantity);
                $updated_remaining_quantity=$remaining_quantity['remaining_quantity']+1;
                mysql_query("update book set remaining_quantity='$updated_remaining_quantity' where barcode_id='$barcodeid'");
                ?>
                <div class="alert alert-success alert-dismissable">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                <strong>Success!</strong> Book has been returned.
                </div>
                <?php
                //email functionality
                           
                           // date and time

			          $datetime = new DateTime;
			          $otherTZ  = new DateTimeZone('Asia/Karachi');
			          $datetime->setTimezone($otherTZ);
			         
			          $date = $datetime->format('m/d/Y');
			          $time = $datetime->format('g:i a');
			
			          //=========
			          //fetch email from faculty
			          $query=mysql_query("select email from faculty where cnic='$cnic'");
			          $row=mysql_fetch_assoc($query);
			          $email=$row['email'];
			         
			         //fetch book title from book
				 $query=mysql_query("SELECT book_title FROM book WHERE barcode_id='$barcodeid'");
        			//$run= mysql_num_rows($query);
          			 $row=mysql_fetch_assoc($query);
         			 $book_title=$row['book_title'];
				 
			          $to=$email;
			          $message="Request date : $date.\n Request Time : $time \n\n\n your CNIC number : $cnic \n\n\n accession # of the book copy : $accession_no \n\n\n your barcode id of the book : $barcodeid \n\n\n Issued book title : $book_title";
			          $subject="Return Book Notification ";
			          mail($to,$subject,$message);
                           
                           //email end
           }
           else
           {
                ?>
                <div class="alert alert-warning alert-dismissable">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                <strong>Warning!</strong> The Given Entries are not matchable or the book is not issued to this cnic.
                </div>
                <?php 
           }
        }
        else
        {
            ?>
            <div class="alert alert-warning alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <strong>Warning!</strong> Entries must not be empty.
            </div>
            <?php
        }
    }
?>
	<!-- end of return -->
    
    
<html>
<head>
	<title></title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- code for scanner -->
    <script type="text/javascript">

$(document).scannerDetection({
    
  //https://github.com/kabachello/jQuery-Scanner-Detection

    timeBeforeScanTest: 200, // wait for the next character for upto 200ms
    avgTimeByChar: 40, // it's not a barcode if a character takes longer than 100ms
  endChar: [13],
  //preventDefault: true, //this would prevent text appearing in the current input field as typed 
        onComplete: function(barcode, qty){
   
    alert(barcode);
    } // main callback function 
});



</script>
    
</head>
<body>
		<div class="container">
        <div class="row panel panel-primary">
        <div class="panel-heading bg-primary" style="text-align:center"><h3><i class="glyphicon glyphicon-barcode"></i> Book Barcode faculty Related</h3></div>
          	<div class="col-md-12">

	<form method="POST">

		<!-- <input type="text" name="barcode" autofocus> -->
		 <div class="form-group">
                <!-- <label style="text-align:center;"></label> -->
                

                <div class="input-group row col-md-6 input-group-lg" style="margin-left:20%; margin-top:10px;">
                  <div class="input-group-addon">
                    <i class="fa fa-barcode"></i>
                  </div>
                  <input type="text" name="barcode" class="form-control" autofocus placeholder="Scan book barcode">
                </div>
                <!-- /.input group -->
              </div>


	</form>
	<table id="example1" class="table table-bordered table-striped">
                <thead class="bg-primary">
                <tr>
                  <th>Book Title</th>
                  <th>Author</th>
                  <th>ISBN</th>
                  <th>Publisher</th>
                  <th>Total Copies</th>
                  <th>Remaining Copies</th>
                  <th>Issue Book</th>
                  <th>Return Book</th>
                  
                </tr>
                </thead>
                <tbody>
                <?php 
				require_once('db.php');
	if (isset($_POST['barcode'])) {
				$barcode = $_POST['barcode'];
				
				$_SESSION['barcodeid']=$barcode;
				
				
				 $select_query="select * from book where barcode_id='$barcode'";
				 $run=mysql_query($select_query);
				 
               while($row=mysql_fetch_array($run)){
			 
                                $book_title=$row['book_title']; 
                                $book_author=$row['book_author'];
                                $isbn=$row['isbn'];
                                $publisher=$row['publisher'];
                             	  $quantity=$row['quantity'];
								 $remaining_quantity=$row['remaining_quantity'];
			   
				 
    ?>
     <tr>
                  <td><?php echo $book_title ?></td>
                  <td><?php echo $book_author ?></td>
                  <td><?php echo $isbn ?></td>
                  <td><?php echo $publisher ?></td>
                  <td><?php echo $quantity ?></td>
                  <td><?php echo $remaining_quantity ?></td>
                  <td><button type="submit" name="submit" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg">Issue Book</button></td>
<td><button type="submit" name="submit" class="btn btn-primary" data-toggle="modal" data-target=".return-example-modal-lg">Return Book</button></td>                
                
               
                </tr>
               <?php } }?>
                </tbody>
                </table>
                </div>
                </div>
                </div>
                
               
</body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!-- codoe for issue model start -->

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h2 class="modal-title" style="text-align:center">Issue Book to faculty</h2>
      </div>
      
      
      <div class="modal-body">
          <form method="post">
            <!--text field of issuing date of a book
               <div class="form-group">
                  <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                     <div class="input-group input-group-lg">
                       <div class="input-group-addon">Issue Date:</div>
                 <input type="date" class="form-control" id="exampleInputAmount" name="issue_date" placeholder="Issuing date">
                         
                          </div>
                  </div> -->
                               
                 <div class="form-group">
                    <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                       <div class="input-group input-group-lg">
                         <div class="input-group-addon"> Faculty CNIC #:</div>
                   <input type="text" class="form-control search" id="exampleInputAmount" name="cnic" placeholder=" Faculty CNIC #">
                         
                        </div>
                  </div>
                  
                   
                 <!-- <div class="form-group">
                     <div class="input-group input-group-lg col-lg-12">
                       <div class="input-group-addon">Barcode ID:</div>
                 <input type="text" class="form-control" id="barcode_id_textBox"   name="barcode_id" >
                         <span class="input-group-btn" style="width:0px;"></span>
                <input type="text" class="form-control " id="book_title_textBox"   name="book_title" placeholder="Book title">

                   </div>
                </div>  -->
                                
                  <div class="form-group">
                     <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                        <div class="input-group input-group-lg">
                           <div class="input-group-addon">Acession no:</div>
               <input type="text" class="form-control " id="exampleInputAmount" name="acession_no" placeholder="accession no">
                         
                          </div>
                      </div>
                      
                       <div>                                 
                      <input type="submit" value="issue Book" name="submit" class="btn btn-lg btn-danger">
                         </div>
                                       
           </form>
                

      </div>
      
      
      
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div><!-- /.modal-content -->
  </div>
</div>
<!-- codoe for issue model end -->


<!-- codoe for return model start -->

<div class="modal fade return-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h2 class="modal-title" style="text-align:center">Return Book</h2>
      </div>
      
      
      <div class="modal-body">
           <form method="post">
                               
              <div class="form-group">
                  <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                    <div class="input-group input-group-lg">
                      <div class="input-group-addon"> Faculty CNIC #:</div>
                   <input type="text" class="form-control search" id="exampleInputAmount" name="cnic" placeholder="Faculty CNIC #">
                         
                      </div>
                  </div>
                                
                                
             <!--   <div class="form-group">
                   <div class="input-group input-group-lg col-lg-12">
                     <div class="input-group-addon">Barcode ID:</div>
                 <input type="text" class="form-control" id="barcode_id_textBox"   name="barcode_id" placeholder="Barcode ID">
                     <span class="input-group-btn" style="width:0px;"></span>
                 <input type="text" class="form-control " id="book_title_textBox"   name="book_title" placeholder="Book title">

                    </div>
             	 </div> -->
                                
                                
                 <div class="form-group">
          		   <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                     <div class="input-group input-group-lg ">
                       <div class="input-group-addon">Acession number:</div>
               <input type="text" class="form-control " id="exampleInputAmount" name="acession_no" placeholder="accession no">
                         
                     </div>
                   </div>
                		<div>
                                    
                   <input type="submit" value="Return Book" name="return_submit" class="btn btn-lg btn-primary">
                     </div>
        </form>
                

      </div>
      
      
      
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div><!-- /.modal-content -->
  </div>
</div>
<!-- codoe for return model end -->