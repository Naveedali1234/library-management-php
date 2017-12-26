<?php session_start();
include('header.php');
    require_once('db.php');
    if(isset($_POST['submit']))
    {
        $book_fine_row=mysql_query('update borrowing_info set fine="'.$_POST['fine'].'" where accession_no="'.$_POST['accession_no'].'"');
    
        header('location: lost_book.php');
    }
    
?>