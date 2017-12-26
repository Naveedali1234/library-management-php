<?php
    require_once('db.php');
	$search=$_POST['search'];
    $sql="select book_title,book_author,isbn,accession_no,status from book_copy JOIN book ON book_copy.barcode_id=book.barcode_id where book.book_title like '%$search%'";
    $result=mysql_query($sql);
    $row=mysql_num_rows($result);
?>

<table class="table table-bordered">
<thead class="bg-primary">
	<th>Book title</th>
	<th>Book Author</th>
    <th>ISBN</th>
    <th>Accession No</th>
    <th>Status</th>
    <th>Action</th>

</thead>
<?php
	if($row > 0){
		while($data=mysql_fetch_assoc($result)){
			
			$book_title=$data['book_title'];
			$book_author=$data['book_author'];
			$isbn=$data['isbn'];
			$accession=$data['accession_no'];
			$status=$data['status'];

		
		?>	
			
		<tr>
		<td><?php echo $book_title ?></td>
		<td><?php echo $book_author ?></td>
		<td><?php echo $isbn ?></td>
		<td><?php echo $accession ?></td>
		<td><?php echo $status ?></td>
		<td><a  title="Edit" href="edit-book.php?edit=<?php echo $isbn ?>"><input type="button" class="btn btn-primary" value="Edit"></a>
            <a  title="Delete" href="list_of_book.php?del=<?php echo $accession ?>"><input type="button" class="btn btn-warning" value="Delete"></a></td>
		</tr>
		<?php 	
	}}
	else{
		echo "No data found";
	}


?>
</table>