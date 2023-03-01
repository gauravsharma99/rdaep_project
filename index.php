<?php 
    include 'connection.php';
    session_start();

    $pass=1;    //flag variable
    $fname=$lname=$email=$mob=$address=$gender=$country_code=$photo=$error=''; 
    $hobby=array();
   
    if(isset($_POST['submit'])){     
        
        if(empty($_POST['first_name'])){        
            $error='First Name is required.';
            $pass=0;
        }else{
            if(!preg_match("/^[a-zA-Z]*$/",$_POST["fnname"])){
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
        if(empty($_FILES['photo']['name'])){
            $error='Upload a photo';
            $pass=0;
        }else{
            
            $time=time();
            $targetpath="photos/employee_".$time.$_FILES['photo']['name'];

            if(move_uploaded_file($_FILES['photo']['tmp_name'],$targetpath)){
               
                $pass=1;
                $photo=$targetpath;
            }else{
                $pass=0;
            }
            
        }

        if($pass==1){
            
            $_SESSION['fname']=$fname;
            $_SESSION['lname']=$lname;
            $_SESSION['email']=$email;
            $_SESSION['mob']=$mob;
            $_SESSION['country_code']=$_POST['mobile_country_code'];
            $_SESSION['address']=$address;
            $_SESSION['gender']=$gender;
            $_SESSION['hobby']=$hobby; 
            $_SESSION['image']=$photo; 
            header("Location:insert_data.php");
            
            
        }


        
    }
?>
<html>
    <head>
        <style>
            table,th td {
                border: 1px solid black;
            }
            td,th{
                text-align: center;
            }
            
        </style>
    </head>
    <body>
            <form  method="post" enctype="multipart/form-data">

                <h3>Employee Management</h3><br>
                <label for="first_name">First Name :</label>
                <input type="text" id="first_name" name="first_name" value="<?php echo $fname ?>"><br><br>
                
                <label for="last_name">Last Name :</label>
                <input type="text" id="last_name" name="last_name" value="<?php echo $lname ?>"><br><br>
                
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" value="<?php echo $email ?>"><br><br>
                
                <label for="mobile_number">Mobile Number :</label>
                <select id="mobile_country_code" name="mobile_country_code">
                    <option <?php if (isset($_POST['mobile_country_code']) && $_POST['mobile_country_code'] == "+1") echo "selected"; ?> value="+1">+1 (USA)</option>
                    <option <?php if (isset($_POST['mobile_country_code']) && $_POST['mobile_country_code'] == "+44") echo "selected"; ?> value="+44">+44 (UK)</option>
                    <option <?php if (isset($_POST['mobile_country_code']) && $_POST['mobile_country_code'] == "+91") echo "selected"; ?> value="+91">+91 (India)</option>
                </select>
                <input type="text" id="mobile_number" name="mobile_number" value="<?php echo$mob ?>"><br><br>
                
                <label for="address" >Address :</label><br>
                <textarea id="address" rows="3" cols="50" name="address" ><?php echo $address?></textarea><br><br>
                
                <label for="gender">Gender:</label>
                <input type="radio" id="Male" name="gender" value="Male" <?php if (isset($_POST['gender']) && $gender == "Male") echo "checked"; ?>>
                <label for="male">Male</label>
                <input type="radio" id="Female" name="gender" value="Female" <?php if (isset($_POST['gender']) && $gender == "Female") echo "checked"; ?>>
                <label for="female">Female</label><br><br>
                
                <label for="hobby">Hobby :</label>
                <input type="checkbox" id="hobby1" name="hobby[]" <?php if (isset($_POST['hobby']) && in_array("reading",$hobby)) echo "checked"; ?> value="reading">
                <label for="hobby1">Reading</label>
                <input type="checkbox" id="hobby2" name="hobby[]"  <?php if (isset($_POST['hobby']) && in_array("traveling",$hobby)) echo "checked"; ?> value="traveling">
                <label for="hobby2">Traveling</label>
                <input type="checkbox" id="hobby3" name="hobby[]"  <?php if (isset($_POST['hobby']) && in_array("cooking",$hobby)) echo "checked"; ?> value="cooking">
                <label for="hobby3">Cooking</label><br><br>
                
                <label for="photo">Photo :</label>
                <input type="file" id="photo" name="photo" accept="images/*"><br><br>
                
                <input type="submit" name="submit" value="Submit"><br><br>

                <label name="errortext" style="color:red"><?php echo$error ?></label>
            </form><hr><br>
        <div>
            <h4>Employee data</h4>

            <?php
                
                $qry="select * from Employee order by id desc";
                $status=mysqli_query($connect,$qry);
                echo '<table style="width:100%;border:1px solid black;">';
                echo '<th>Photo</th>';
                echo '<th>Name</th>';
                echo '<th>Email </th>';
                echo '<th>Mobile Number</th>';
                echo '<th>Address</th>';
                echo '<th>Gender</th>';
                echo '<th>Hobby</th>';
                echo '<th>Edit</th>';
                echo '<th>Delete</th>';
               
                while($result_ary=mysqli_fetch_assoc($status)){
                    echo '<tr>';
                    echo '<td><img width="120" src="'.$result_ary['Photo'].'"</td>';
                    echo '<td>'.$result_ary['First_Name'].' '.$result_ary['Last_Name'].'</td>';
                    echo '<td>'.$result_ary['Email'].'</td>';
                    echo '<td>'.$result_ary['Country Code'].$result_ary['Mobile'].'</td>';
                    echo '<td>'.$result_ary['Address'].'</td>';
                    echo '<td>'.$result_ary['Gender'].' </td>';
                    echo '<td>'.$result_ary['Hobby'].' </td>';
                    $id=$result_ary['id'];
                    echo '<td><a href="edit_data.php?id='.$id.'">Edit</a></td>';
                    echo '<td><a href="delete_data.php?id='.$id.'">Delete</a></td>';
                    echo '</tr>';




                    
                }
                echo "</table>"
            ?>
        </div>
    </body>
</html>