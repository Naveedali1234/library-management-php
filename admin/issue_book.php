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
    include('header.php');
    if(isset($_POST["submit"]))
    {   
        //variables
        $brcode_id=$_POST["barcode_id"];
        $student_registration_no= strtoupper($_POST["student_registration_no"]);
        $accession_no=$_POST["acession_no"];
        
        //1st if condition for checking if the textbox are empty or not
        if($student_registration_no!=null && $brcode_id!=null && $accession_no!=null)
        {
           //for checking that a student is registered or a valid student registration no 
            $check=mysql_query('select registration_no,email from student where registration_no = "'.$student_registration_no.'"');
            $student_registration_array=mysql_fetch_assoc($check);
            $check_for_student=$student_registration_array['registration_no'];
            if($check_for_student==$student_registration_no)
            {
               //for checking remaining quantity
                $row=mysql_query("select remaining_quantity from book where barcode_id='$brcode_id'");
                $remaining_quantity=mysql_fetch_assoc($row);
                if($remaining_quantity["remaining_quantity"]>=1)
                {
                    //for checking an accession no if it exist in book_copy
                    $row2=mysql_query("select accession_no from book_copy where barcode_id='$brcode_id' AND accession_no='$accession_no'");
                    $access_no_of_book_copy=mysql_fetch_assoc($row2);
                    if($access_no_of_book_copy["accession_no"]==$_POST['acession_no'])
                    {
                       //checking for accession no if it is already issued or not to student
                        $check2=mysql_query('select accession_no from borrowing_info where accession_no="'.$accession_no.'"');
                        $selected_accession_no=mysql_fetch_assoc($check2);
                        $found_accession_no=$selected_accession_no['accession_no'];
                        //checking for accession no if it is already issued or not to faculty
                        $check3=mysql_query('select accession_no from faculty_borrowing_info where accession_no="'.$accession_no.'"');
                        $selected_accession_no_faculty=mysql_fetch_assoc($check3);
                        $found_accession_no_faculty=$selected_accession_no_faculty['accession_no'];

                        if($found_accession_no != $accession_no && $found_accession_no_faculty != $accession_no)
                        {
                             mysql_query("insert into borrowing_info(barcode_id,registration_no,accession_no,date_of_borrowed)"
                    .       "values ('$brcode_id','$student_registration_no','$accession_no',NOW())");
                            mysql_query('update book_copy set status="Issued Student" where accession_no="'.$accession_no.'"');
                            $select_remaining_quantity=mysql_query("select remaining_quantity from book where barcode_id='$brcode_id'");
                            $remaining_quantity=mysql_fetch_assoc($select_remaining_quantity);
                            $updated_remaining_quantity=$remaining_quantity['remaining_quantity']-1;
                            ?>
                            <div class="alert alert-success alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <strong>Success!</strong> Book has been issued.
                            </div>
                            <?php

                           
                            mysql_query("update book set remaining_quantity='$updated_remaining_quantity' where barcode_id='$brcode_id'");
                            //email functionality
                           
                           // date and time

			          $datetime = new DateTime;
			          $otherTZ  = new DateTimeZone('Asia/Karachi');
			          $datetime->setTimezone($otherTZ);
			         
			          $date = $datetime->format('m/d/Y');
			          $time = $datetime->format('g:i a');
			
			          //=========
			          //fetch email from student
			         $email= $student_registration_array['email'];
			         //fetch book title from book
				 $query=mysql_query("SELECT book_title FROM book WHERE barcode_id='$brcode_id'");
        			//$run= mysql_num_rows($query);
          			 $row=mysql_fetch_assoc($query);
         			 $book_title=$row['book_title'];
				 
			          $to=$email;
			          $message="Request date : $date.\n Request Time : $time \n\n\n your registration number : $student_registration_no \n\n\n accession # of the book copy : $accession_no \n\n\n your barcode id of the book : $brcode_id \n\n\n Issued book title : $book_title";
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
                    <strong>Warning!</strong> The Student Registration no is not valid.
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
      
       
    <script src="js/jquery-3.1.1.min.js" type="text/javascript"></script>
    
<!--     <script>
   	$('document').ready(function() {
		
       $('.search').keyup(function(){
		   
		   var search=$(this).val();
		   $.post($('form').attr('action'),
		   {'search':search},
		   function(data){
			   $('.success').html(data);
			  
			   })
	   }) 
            $('.search2').keyup(function(){
		   
		   var search2=$(this).val();
		   $.post('sub_issue_book_table.php',
		   {'book_search':search2},
		   function(data){
			   $('.success').html(data);
			  
			   })
	   }) 
    })
</script>-->	
  <script>
//   	$('document').ready(function() {
//		
//       $('.search').keyup(function(){
//		   
//		   var search=$(this).val();
//		   $.post("fetching_book_title_for_barcode.php",
//		   {'barcode_id':search},
//		   function(data){
//			   $('.success').html(data);
//			  
//			   })
//	   }) 	
//	 })
//setup before functions
$('document').ready(function() {
    
var searchKey;
var searchTimeout;//Timer to wait a little before fetching the data
$('#barcode_id_textBox').keyup(function() {
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
        <div class="container content">
             <div class="row panel panel-primary add_student_well">
                  <div class="panel-heading bg-primary"><h3><i class="glyphicon glyphicon-share-alt"></i> Issue Book</h3></div>
          	
                    <div class="panel-body">
                       <div class="col-lg-12">

                           <form action="issue_book.php" method="post">
                               
                                <!--text field of issuing date of a book-->
<!--                               <div class="form-group">
                                    <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                    <div class="input-group input-group-lg col-lg-6">
                                      <div class="input-group-addon">Issue Date:</div>
                                      <input type="date" class="form-control" id="exampleInputAmount" name="issue_date" placeholder="Issuing date">
                         
                                    </div>
                               </div>-->
                               
                                <div class="form-group">
                                    <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                    <div class="input-group input-group-lg col-lg-6">
                                      <div class="input-group-addon">Student Registration no:</div>
                                      <input type="text" class="form-control search" id="exampleInputAmount" name="student_registration_no" placeholder="student registration no">
                         
                                    </div>
                               </div>
                                
                                
                                 <div class="form-group">
                                    <div class="input-group input-group-lg col-lg-12">
                                      <div class="input-group-addon">Barcode ID:</div>
                                      <input type="text" class="form-control" id="barcode_id_textBox" autofocus   name="barcode_id" placeholder="Barcode ID">
                                      <span class="input-group-btn" style="width:0px;"></span>
                                      <input type="text" class="form-control " id="book_title_textBox"   name="book_title" placeholder="Book title">

                                    </div>
                               </div>
                                
                                
                                <div class="form-group">
                                    <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                    <div class="input-group input-group-lg col-lg-6">
                                      <div class="input-group-addon">Acession no:</div>
                                      <input type="text" class="form-control " id="exampleInputAmount" name="acession_no" placeholder="accession no">
                         
                                    </div>
                                </div>
                                    <div>
                                    
                                        <input type="submit" value="issue Book" name="submit" class="btn btn-lg btn-primary">
                                    </div>
                                        </form>
                


                        </div><!-- /.col-lg-6 -->

<!--                        <div class="col-lg-6">
                           <form action="sub_issue_book_table.php" method="post">
                                <div class="form-group">
                                    <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                    <div class="input-group input-group-lg">
                                      <div class="input-group-addon">Search</div>
                                      <input type="text" class="form-control search2" id="exampleInputAmount" name="search" placeholder="Search Book to issue">
                         
                                    </div>
                               </div>
                          
                          </form>
                
                       </div> /.col-lg-6 
              -->
	            </div><!-- /.row -->
	    </div>
	    
	</div>
   
   
   
   
   
   
   
	
<!--<div class="container">
        <div class="row panel panel-primary add_student_well" >
                    <div class="panel-body">
                    
                       <div class="col-lg-12">
                    
                           <div class="panel-heading bg-primary"><h3><i class="glyphicon glyphicon-user"></i> Member</h3></div>						 								<div class="success"></div>
                             <table class="table table-hover table-striped table-bordered">
      			                <thead>
                                    <tr class="warning">
                                        <th>Name</th>
                                        <th>Reg #</th>
                                        <th>Batch #</th>
                                        <th>Department</th>

                                    </tr>
                              </thead>
                            </table> 
                            
                        </div>
              
	               
	                
	                
                     <div class="col-lg-12" >
                    			   
                            <div class="panel-heading bg-primary"><h3><i class="glyphicon glyphicon-th"></i> Book</h3></div>										 								<div class="result"></div>
                             table class="table table-hover table-striped table-bordered">
      			                <thead>
                                    <tr class="warning">
                                        <th>Name</th>
                                        <th>Reg #</th>
                                        <th>Batch #</th>
                                        <th>Department</th>

                                    </tr>
                              </thead>
                            </table> 
                            
                        </div>
               </div> 
	               
	    </div>
	    
</div>                        -->


<div class="preload">
  <img src="img/ajax_loader.gif"/>
</div>