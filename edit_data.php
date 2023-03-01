<?php 
    include 'connection.php';
    session_start();

    $pass=1;    //flag variable
    $fname=$lname=$email=$mob=$address=$gender=$country_code=$photo=$error=''; 
    $hobby=array();
    
    $id=$_GET['id'];
    $qry='';
    $qry="select * from Employee where id='$id'";
    $status=mysqli_query($connect,$qry);
    if(!$status)
        die('failed');

    $result_ary=mysqli_fetch_assoc($status);
    

    if(isset($_POST['update'])){     
        
        if(empty($_POST['first_name'])){        
            $error='First Name is required.';
            $pass=0;
        }else{
            if(!preg_match("/^[a-zA-Z]*$/",$_POST["first_name"])){
                $error='Invalid First Name';
                $pass=0;
            }
            else{
                $fname=$_POST['first_name'];
            }
            
        }

        if(empty($_POST['last_name'])){        
            $error='Last Name is required.';
            $pass=0;
        }else{
            if(!preg_match("/^[a-zA-Z]*$/",$_POST["last_name"])){
                $error='Invalid Last Name';
                $pass=0;
            }
            else{
                $lname=$_POST['last_name'];
            }
            
        }

        if(empty($_POST['email'])){        
            $error='Email is required.';
            $pass=0;
        }else{
            if(!preg_match("/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/",$_POST["email"])){
                $error='Invalid Email';
                $pass=0;
            }
            else{
                $email=$_POST['email'];
            }
        }
        if(empty($_POST['mobile_number'])){         
            $error='Mobile Number is required.';
            $pass=0;

        }else{
            if(!preg_match("/^[0-9]*$/",$_POST["mobile_number"])){
                $error='Invalid Mobile Number';
                $pass=0;
            }
            else{
                $mob=$_POST['mobile_number'];
            }
        }
        if(empty($_POST['address'])){        
            $error='Address is required.';
            $pass=0;
        }else{
            
            $address=$_POST['address'];
        
        }
        if(empty($_POST['gender'])){         
            $error='Choose Gender.';
            $pass=0;
        }else{
            
                $gender=$_POST['gender'];
            
        }
        if(empty($_POST['hobby'])){         
            $error='Select Atleast 1 Hobby.';
            $pass=0;
        }else{
            
                $hobby=$_POST['hobby'];
                
        }
        if($_FILES['photo']['name']!=''){
            
            $time=time();
            $targetpath="photos/employee_".$time.$_FILES['photo']['name'];

            if(move_uploaded_file($_FILES['photo']['tmp_name'],$targetpath)){
               
                //old image
                $qryimg="select Photo from `Employee` where id=$id";
    
                $statusimg=mysqli_query($connect,$qryimg);

                if(!$statusimg)
                    die('error while fetching image');

                $resultimg=mysqli_fetch_assoc($statusimg);
                
                $imgpath=$resultimg['Photo'];
                unlink($imgpath);


                
                
                
                
                $hobby=implode(",",$hobby);
                $pass=1;
                $photo=$targetpath;
                $date=date('Y-m-d');
                $qry="UPDATE `Employee` SET 
                `First_Name`='$fname',
                `Last_Name`='$lname',
                `Email`='$email',
                `Country Code`='$_POST[mobile_country_code]',
                `Mobile`='$mob',
                `Address`='$address',
                `Gender`='$gender',
                `Hobby`='$hobby',
                `Photo`='$targetpath',
                `Created_Date`='$date'
                 WHERE `id`=$id";
                
                $status=mysqli_query($connect,$qry);
                if(!$status)
                    die("Error while updating.");

                header("Location:index.php");  

            }else{
                $pass=0;
                echo "here";
            }
            
        }
    
        if($pass==1){
            
            $date=date('Y-m-d');
            $hobby=implode(",",$hobby);
            $qry="UPDATE `Employee` SET 
                `First_Name`='$fname',
                `Last_Name`='$lname',
                `Email`='$email',
                `Country Code`='$_POST[mobile_country_code]',
                `Mobile`='$mob',
                `Address`='$address',
                `Gender`='$gender',
                `Hobby`='$hobby',
                `Created_Date`='$date'
                WHERE `id`=$id";

            
            $status=mysqli_query($connect,$qry);

            if(!$status)
                die("Error while updating.");
            
            header("Location:index.php");   
            
            
        }


        
    }
?>
<html>
    <head>
        
    </head>
    <body>
            <form  method="post" enctype="multipart/form-data">

                <h3>Edit Employee</h3><br>
                <label for="first_name">First Name :</label>
                <input type="text" id="first_name" name="first_name" value="<?php echo $result_ary['First_Name'] ?>"><br><br>
                
                <label for="last_name">Last Name :</label>
                <input type="text" id="last_name" name="last_name" value="<?php echo $result_ary['Last_Name'] ?>"><br><br>
                
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" value="<?php echo $result_ary['Email'] ?>"><br><br>
                
                <label for="mobile_number">Mobile Number :</label>
                
                <select id="mobile_country_code" name="mobile_country_code">
                    <option <?php if ((isset($_POST['mobile_country_code']) && $_POST['mobile_country_code'] == "+1") || $result_ary['Country Code']== "+1") echo "selected"; ?> value="+1">+1 (USA)</option>
                    <option <?php if ((isset($_POST['mobile_country_code']) && $_POST['mobile_country_code'] == "+44") || $result_ary['Country Code']== "+44") echo "selected"; ?> value="+44">+44 (UK)</option>
                    <option <?php if ((isset($_POST['mobile_country_code']) && $_POST['mobile_country_code'] == "+91") || $result_ary['Country Code']== "+91") echo "selected"; ?> value="+91">+91 (India)</option>
                </select>
                <input type="text" id="mobile_number" name="mobile_number" value="<?php echo $result_ary['Mobile'] ?>"><br><br>
                
                <label for="address" >Address :</label><br>
                <textarea id="address" rows="3" cols="50" name="address" ><?php echo $result_ary['Address']?></textarea><br><br>
                
                <label for="gender">Gender:</label>
                <input type="radio" id="Male" name="gender" value="Male" <?php if ((isset($_POST['gender']) && $gender == "Male")|| $result_ary['Gender']== "Male") echo "checked"; ?>>
                <label for="male">Male</label>
                <input type="radio" id="Female" name="gender" value="Female" <?php if ((isset($_POST['gender']) && $gender == "Female")|| $result_ary['Gender']== "Female" ) echo "checked"; ?>>
                <label for="female">Female</label><br><br>
                
                <?php $dbhobby=explode(",",$result_ary['Hobby']);?>
                <label for="hobby">Hobby :</label>
                <input type="checkbox" id="hobby1" name="hobby[]" <?php if ((isset($_POST['hobby']) && in_array("reading",$hobby))|| in_array("reading",$dbhobby)) echo "checked"; ?> value="reading">
                <label for="hobby1">Reading</label>
                <input type="checkbox" id="hobby2" name="hobby[]"  <?php if ((isset($_POST['hobby'])) && in_array("traveling",$hobby)|| in_array("traveling",$dbhobby)) echo "checked"; ?> value="traveling">
                <label for="hobby2">Traveling</label>
                <input type="checkbox" id="hobby3" name="hobby[]"  <?php if ((isset($_POST['hobby'])) && in_array("cooking",$hobby)|| in_array("cooking",$dbhobby)) echo "checked"; ?> value="cooking">
                <label for="hobby3">Cooking</label><br><br>
                
                <label for="photo">Photo :</label>
                <input type="file" id="photo" name="photo" accept="images/*"><br><br>
                
                <input type="submit" name="update" value="Update"><br><br>

                <label name="errortext" style="color:red"><?php echo$error ?></label>
            </form><hr><br>
        
        
    </body>
</html>