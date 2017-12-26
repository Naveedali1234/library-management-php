<?php session_start();
include('header.php');
    require_once('db.php');
    if(isset($_POST['submit']))
    {
        $sql=mysql_query('select fine from borrowing_info where accession_no="'.$_POST['accession_no'].'"');
        $row=mysql_fetch_assoc($sql);
        $fine=$row['fine'];
        $updated_fine=$fine-$_POST['fine'];
        $book_fine_row="update borrowing_info set fine= '$updated_fine' where accession_no='".$_POST["accession_no"]."'";
        mysql_query($book_fine_row);
        if($updated_fine==0)
        {
            mysql_query('delete from borrowing_info where accession_no="'.$_POST['accession_no'].'" ');
            header('location: fetching_student_clearance_record.php');
        }
        header('location: fetching_student_clearance_record.php');
    }
    
?>