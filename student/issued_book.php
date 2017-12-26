<?php include('session.php');
require_once('db.php');
	include('header.php');
	include('side_bar.php');
	
    
?>


	<!-- body content -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Dashboard</h2>   
                        <h5 style="color:green;">Welcome to Student Panel </h5>
                       
                       <div class="alert alert-info"><strong>Borrowed Books</strong></div>
                            <table cellpadding="0" cellspacing="0" border="0" class="table" id="example">

                                <thead>
                                    <tr>
                                        <th>Book title</th>                                 
                                        <th>Barcode Id</th>                                 
                                        <th>Book Author</th>                                 
                                        <th>Bill Number</th>                                 
                                        <th>Accession number</th>                                
                                        <th>ISBN</th>
					<th>Publisher</th>
                                    </tr>
                                </thead>
                                <tbody>
								 
                                  <?php  $user_query=mysql_query("select b.book_title,b.barcode_id,b.isbn,b.book_author,b.publisher,b.bill_no,s.accession_no from book_copy AS s LEFT JOIN book AS b ON s.barcode_id=b.barcode_id WHERE s.barcode_id='00000'
								  ")or die(mysql_error());
									while($row=mysql_fetch_array($user_query)){
									//$id=$row['borrow_id'];
									//$book_id=$row['book_id'];
									//$borrow_details_id=$row['borrow_details_id'];
				
									?>
									<tr>
									
									                              
                                    <td><?php echo $row['book_title']; ?></td>
                                    <td><?php echo $row['barcode_id'];?></td>
                                    <td><?php echo $row['book_author']; ?></td>
									<td><?php echo $row['bill_no']; ?></td> 
                                    <td><?php echo $row['accession_no']; ?> </td>
									<td><?php echo $row['isbn']; ?> </td>
									<td><?php echo $row['publisher'];?></td>
									 
                                    </tr>
									<?php  }  ?>
                                </tbody>
                            </table>
                       
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
               
   			 </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="js/jquery.metisMenu.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="js/custom.js"></script>
    
   
</body>
</html>
