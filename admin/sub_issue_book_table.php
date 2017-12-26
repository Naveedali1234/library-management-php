<?php
    require_once('db.php');
	$book_search=$_POST['book_search'];
    $sql="select * from book where book_title  like '%$book_search%'";
    $result=mysql_query($sql);
    $row=mysql_num_rows($result);
?>

<?php include('header.php'); ?>

<table class="table">
<thead class="bg-primary" style="align:right">
	<th>Book Title</th>
	<th>Book Author</th>
    <th>ISBN</th>
    <th>Publisher</th>  

</thead>
<?php
	if($row > 0){
		while($data=mysql_fetch_assoc($result)){
			
			
		echo "<tr>";
		//echo "<td>".$data['id']."</td>";
		echo "<td>".$data['book_title']."</td>";
		echo "<td> Book Author :".$data['book_author']."</td>";
		echo "<td> ISBN :".$data['isbn']."</td>";
		echo "<td> Publisher :".$data['publisher']."</td>";
		echo "</tr>";
		}
	}
	else{
		echo "No data found";
	}
	//echo $search;


?>
</table>
    