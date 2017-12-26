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
<?php //include('session.php');
   require_once('db.php');
  include('header.php');
  //include('side_bar.php');
  
    
?>
<div class="preload">
  <img src="img/ajax_loader.gif"/>
</div>

  <!-- body content -->
     <div class="container content">   
 <div class="row panel panel-primary add_student_well">
  <div class="panel-heading bg-primary"><h3><i class="glyphicon glyphicon-plus"></i> List of Issued Books To Faculty</h3></div>
   <div class="col-md-12">
                     <div class="panel-body">           
  <!--<div class="alert alert-info"><strong>Borrowed Books</strong></div>-->
  <table cellpadding="0" cellspacing="0" border="0" class="table table-hover table-striped table-bordered" id="example">

      <thead>
                <tr>
                  <th>Faculty CNIC #</th>
                  <th>Book title</th>
                  <th>Book Author</th>                                 
                                                   
                  <th>Accession number</th>                                
                  <th>ISBN</th>
                  <th>Date</th>
               </tr>
      </thead>
              <tbody>
                 
      <?php 
         //$reg=$_SESSION['registration_number'];
         $user_query=mysql_query("select book_title,accession_no,book_author,cnic,isbn,date_of_borrowed from faculty_borrowing_info JOIN book on faculty_borrowing_info.barcode_id=book.barcode_id 
                  ")or die(mysql_error());
                  while($row=mysql_fetch_array($user_query)){
                  //$id=$row['borrow_id'];
                  //$book_id=$row['book_id'];
                  //$borrow_details_id=$row['borrow_details_id'];
        
                  ?>
                  <tr>
                  
                  <td><?php echo $row['cnic']; ?></td>                          
                    <td><?php echo $row['book_title']; ?></td>
                   <td><?php echo $row['book_author']; ?></td>
                   
                  <td><?php echo $row['accession_no']; ?> </td>
                  <td><?php echo $row['isbn']; ?> </td>
                  <td><?php echo $row['date_of_borrowed'];?></td>
                           
                </tr>
                  <?php  }  ?>
                                </tbody>
                            </table>
                       
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
               
         </div>
    
    
   
</body>
</html>
