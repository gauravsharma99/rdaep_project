<?php 
    include 'connection.php';
    session_start();
   
    $fname=$_SESSION['fname'];
    $lname=$_SESSION['lname'];
    $email=$_SESSION['email'];
    $mob=$_SESSION['mob'];
    $country_code=$_SESSION['country_code'];
    $address=$_SESSION['address'];
    $gender=$_SESSION['gender'];
    $hobby=$_SESSION['hobby'];
    $image=$_SESSION['image'];

    $hobby=implode(",",$hobby);
    
    $date=date('Y-m-d');
    
    $qry="INSERT INTO `Employee`(`First_Name`, `Last_Name`, `Email`, `Country Code`, `Mobile`, `Address`, `Gender`, `Hobby`, `Photo`, `Created_Date`) 
        VALUES ('$fname','$lname','$email','$country_code','$mob','$address','$gender','$hobby','$image','$date')";
  
    if (mysqli_query($connect, $qry)) {
        header('Location:index.php');
      } else {
        echo "Error: " . $qry . "<br>" . mysqli_error($conn);
      }
   
    
    
    
    
    
?>