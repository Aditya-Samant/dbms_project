<?php
session_start();
include 'db.php';
$insert=false;

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    
    $First=$_POST['First'];
    $Last=$_POST['Last'];
    $Age=$_POST['Age'];
    $Email=$_POST['Email'];
    $PhoneNo=$_POST['PhoneNo'];
    $Passsword=$_POST['Password'];
    $RetypePassword=$_POST['RetypePassword'];
    $address=$_POST['address'];
    if($Passsword==$RetypePassword)
    {
        $sql = "INSERT INTO `trial`.`users` (`First`, `Last`, `Age`, `Email`, `PhoneNo`, `Password`, `RetypePassword`, `address`) VALUES ('$First', '$Last', '$Age', '$Email', '$PhoneNo', '$Passsword', '$RetypePassword', '$address');";
        //echo $sql;
        
        if($con->query($sql) == true )
        {
            $insert=true;
        // echo "success";
        }
        else
        {
            echo "ERROR: $sql <br> $con->error";
        }
        $con->close();
        
    }
    else
    {
        echo "<script>  alert('Please Enter same Password')  </script>";
    } 
}  
?>



<!DOCTYPE html>   
<html>   
<head>  
<link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@700&display=swap" rel="stylesheet">
<title> SignUp Page </title>
<link rel="stylesheet" href="css/SignUp.css">  
</head> 
 
<body>  
    
        <div class="container">   
            <center> <h1> User SignUp </h1> </center>
            <?php
            if($insert== true)
            {
                echo "Inserted";
                header("Location:Login.php");
            } 
            ?>
            <form action="SignUp.php" method="post">  
                <input type="text" placeholder="Enter First name" name="First" id="First" required> 
                <input type="text" placeholder="Enter Last name" name="Last" id="Last" required>  
                <input type="text" placeholder="Enter age" name="Age" id="Age" required>
                <input type="email" placeholder="Enter email" name="Email" id="Email" required>  
                <input type="phone" placeholder="Enter phone number" name="PhoneNo" id="PhoneNo" required>
                <textarea name="address" id="address" cols="1" rows="5" required placeholder="Enter address"></textarea>
                <input type="password" placeholder="Enter Password" name="Password" id="Password" required>  
                <input type="password" placeholder="Retype Password" name="RetypePassword" id="RetypePassword" required> 

                <button  class="btn">SignUp </button>  
            </form>  
            <center><label> Already have an account?  </label></center>
            <form action="Login.php">
                <button  class="btn1">Login </button>  
            </form> 
        </div>   
        
</body>     
</html>     