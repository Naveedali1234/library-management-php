<?php
 require_once('db.php');
 
 $response=array();
    $sql="select book_title from book where barcode_id LIKE '%".$_POST['value']."%'";
    $result=mysql_query($sql);
    if(mysql_num_rows($result)){
    $book_title=mysql_fetch_assoc($result);
    $response["book_title1"]=$book_title;}
    echo json_encode($response); 

?>
