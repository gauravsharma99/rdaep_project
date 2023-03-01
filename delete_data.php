<?php 
    include 'connection.php';

    $id=$_GET['id'];

    $qryimg="select Photo from `Employee` where id=$id";
    
    $statusimg=mysqli_query($connect,$qryimg);

    if(!$statusimg)
        die('error while fetching image');

    $resultimg=mysqli_fetch_assoc($statusimg);
    
    $imgpath=$resultimg['Photo'];
    unlink($imgpath);


    $qry="delete from `Employee` where id=$id";
    $status=mysqli_query($connect,$qry);
    if(!$status)
        die('error while deleting record');
    
    header("Location:index.php");

?>