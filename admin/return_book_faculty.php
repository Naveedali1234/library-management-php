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
    include('header.php');
    if(isset($_POST["submit"]))
    {
        $brcode_id=$_POST["barcode_id"];
        $cnic=$_POST["cnic"];
        //$issue_date=$_POST["issue_date"];
        $accession_no=$_POST["acession_no"];
        
        //check if it empty or not
        if($brcode_id !=null && $cnic !=null && $accession_no !=null)
        {
           $row=mysql_query("select accession_no,cnic,barcode_id from faculty_borrowing_info where accession_no='$accession_no'");
           $check=mysql_fetch_assoc($row);
           if($check['accession_no']==$accession_no 
             && $check['cnic']==$cnic
             && $check['barcode_id']==$brcode_id)
           {
                mysql_query("delete from faculty_borrowing_info where accession_no='$accession_no'");
                $select_remaining_quantity=mysql_query("select remaining_quantity from book where barcode_id='$brcode_id'");
                $remaining_quantity=mysql_fetch_assoc($select_remaining_quantity);
                $updated_remaining_quantity=$remaining_quantity['remaining_quantity']+1;
                mysql_query("update book set remaining_quantity='$updated_remaining_quantity' where barcode_id='$brcode_id'");
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
				 $query=mysql_query("SELECT book_title FROM book WHERE barcode_id='$brcode_id'");
        			//$run= mysql_num_rows($query);
          			 $row=mysql_fetch_assoc($query);
         			 $book_title=$row['book_title'];
				 
			          $to=$email;
			          $message="Request date : $date.\n Request Time : $time \n\n\n your CNIC number : $cnic \n\n\n accession # of the book copy : $accession_no \n\n\n your barcode id of the book : $brcode_id \n\n\n Issued book title : $book_title";
			          $subject="Return Book Notification ";
			          mail($to,$subject,$message);
                           
                           //email end
           }
           else
           {
                ?>
                <div class="alert alert-warning alert-dismissable">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                <strong>Warning!</strong> The Given Entries are not matchable or the book is not issued to this registration no.
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
<div class="container content">
             <div class="row panel panel-primary add_student_well">
                  <div class="panel-heading bg-primary"><h3><i class="glyphicon glyphicon-share-alt"></i> Return Book from Faculty</h3></div>
            
                    <div class="panel-body">
                       <div class="col-lg-12">

                           <form action="return_book_faculty.php" method="post">
                               
<!--                                text field of issuing date of a book
                               <div class="form-group">
                                    <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                    <div class="input-group input-group-lg col-lg-6">
                                      <div class="input-group-addon">Issue Date:</div>
                                      <input type="date" class="form-control" id="exampleInputAmount" name="issue_date" placeholder="Issuing date">
                         
                                    </div>
                               </div>-->
                               
                                <div class="form-group">
                                    <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                    <div class="input-group input-group-lg col-lg-6">
                                      <div class="input-group-addon">Faculty CNIC #:</div>
                                      <input type="text" class="form-control search" id="exampleInputAmount" name="cnic" placeholder="Faculty CNIC #">
                         
                                    </div>
                               </div>
                                
                                
                                 <div class="form-group">
                                    <div class="input-group input-group-lg col-lg-12">
                                      <div class="input-group-addon">Barcode ID:</div>
                                      <input type="text" class="form-control" id="barcode_id_textBox"   name="barcode_id" placeholder="Barcode ID">
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
                                    
                                        <input type="submit" value="Return Book" name="submit" class="btn btn-lg btn-primary">
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

<div class="preload">
  <img src="img/ajax_loader.gif"/>
</div>
