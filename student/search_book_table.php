<?php
	//include('header.php');
	//include('side_bar.php');
?>
<?php
    require_once('db.php');
	$search=$_POST['search'];
    $sql="select * from book where book_title  like '%$search%' limit 1";
    $result=mysql_query($sql);
    $row=mysql_num_rows($result);
?>

<?php include('header.php'); ?>
<table class="table table-bordered">
<thead class="bg-primary">
	<th>Book title</th>
	<th>Book Author</th>
    <th>Book Copies</th>
    <th>ISBN</th>

</thead>
<?php
	if($row > 0){
		while($data=mysql_fetch_assoc($result)){
			
			
		echo "<tr>";
		echo "<td>".$data['book_title']."</td>";
		echo "<td>".$data['book_author']."</td>";
		echo "<td>".$data['quantity']."</td>";
		echo "<td>".$data['isbn']."</td>";
		echo "</tr>";
		}
	}
	else{
		echo "No data found";
	}
	//echo $search;


?>
</table>