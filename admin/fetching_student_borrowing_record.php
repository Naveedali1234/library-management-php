<?php //session_start();
    include('header.php');
    require_once('db.php');
    if(isset($_POST['submit']))
    {
        $book_fine_row=mysql_query('update borrowing_info set fine="'.$_POST['fine'].'" where accession_no="'.$_POST['accession_no'].'"');
    }
    ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<?php
    $result2;
    if(isset($_GET['search'])){
    $search=$_GET['search'];
    
    $sql="select student_name,registration_no,department from student where registration_no='$search'";
    $result=mysql_query($sql);
    $r2=mysql_num_rows($result);
    $_SESSION['check_row']=$r2;
    $r=mysql_fetch_assoc($result);
    
    $row1="select cost,book_title,accession_no from borrowing_info JOIN book on borrowing_info.barcode_id=book.barcode_id where borrowing_info.registration_no='$search'";
    $result2=mysql_query($row1);
    }
    
?>
<?php //include('header.php'); ?>
<div class="container">
     <div class="row panel panel-primary add_student_well">
              <div class="panel-heading bg-primary"><h3><i class="glyphicon glyphicon-book"></i>List of Books Issued</h3></div>
          	<div class="col-md-12">
            <div class="panel-body">

<table class="table table-bordered table-striped">
<thead class="bg-primary">
	<th>Student Name</th>
	<th>Registration No</th>
        <th>Department</th>
    <th>Issued Book</th>
    <th>Accession No</th>
    <th>Book Price</th>
    <th>Action</th>

</thead>
<?php
	if($_SESSION['check_row'] > 0 ){
                
            while($data=mysql_fetch_assoc($result2)){
                    echo "<tr>";
                    echo "<td>".$r['student_name']."</td>";
                    echo "<td>".$r['registration_no']."</td>";
                    echo "<td>".$r['department']."</td>";
                    echo "<td>".$data['book_title']."</td>";
                    echo "<td>".$data['accession_no']."</td>";
                    echo "<td>".$data['cost']."</td>";
                    echo "<td><button data-toggle='modal' class='getUser' data-id='".$data['accession_no']."' id='getUser' ><i class='glyphicon glyphicon-eye-open'>  </i>Lost Book</button>";
                    echo "</tr>";
                    }
                
            }
	else{
		echo "No data found";
	}
	//echo $search;
        ?>
	



</table>
 </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
                
                </div>
             </div>  <!--row --> 
<script>
$('document').ready(function(){
 
 $(".getUser").on('click', function(e){
  e.preventDefault();
  var access_no = $(this).attr('data-id');
  $('#accession_no').val(access_no); // get id of clicked row
  $('#view-modal').modal('show');
  
 });
 
});
</script>

<!-- Modal -->
<div id="view-modal" class="modal fade"  tabindex="-1" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Total Fine Of Book</h4>
      </div>
        <div class="modal-body">
            <form action="update_fine.php" method="POST" id="dynamic-content" >
                  <div class="form-group">
                         <div class="input-group input-group-lg col-lg-6">
                         <div class="input-group-addon">Book Accession No:</div>
                         <input type="text" class="form-control" readonly="true" id="accession_no" name="accession_no">
                         </div>
                        </div>
                    <div class="form-group">
                                    <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                    <div class="input-group input-group-lg col-lg-6">
                                      <div class="input-group-addon">Total Fine:</div>
                                      <input type="text" class="form-control" id="fine" name="fine" placeholder="Fine">
                         
                                    </div>
                                    
                               </div>
                <div class="form-group">
                <button type="submit" name="submit" class="btn btn-primary">Save changes</button>
                </div>
                  </form>
                </div>
                          
                
      
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        
        
      </div>
                
    </div>
  </div>
</div>

<?php

