<?php
session_start();
include 'db.php';
$found=false;
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $Email=$_POST['Email'];
    $Passsword=$_POST['Password'];
        $sql = "SELECT * FROM `trial`.`users` WHERE `Email`='$Email' AND `Password`='$Passsword' ";
        //echo $sql;

        $result = mysqli_query($con,$sql);
        if(mysqli_num_rows($result))
        {
            $row=$result->fetch_assoc();
            $_SESSION['srno'] = $row['srno'];  
            $found=true;
           // echo "exist";
        }
        else{
            //echo "doesnot";
            echo "<script>  alert('User Does Not Exist')  </script>";
        }
        $con->close();  
    
}  
?>




<!DOCTYPE html>   
<html>   
<head>
<link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@700&display=swap" rel="stylesheet"> 
<title> Login Page </title>
<link rel="stylesheet" href="css/login.css">  
</head> 
 
<body>  
    
        <div class="container">   
             <h1> User Login </h1> 
            <?php
            if($found== true)
            {
                    echo "Loginned Succesfully";
                    header("Location:home.php");
            } 
            ?>
            <form action="Login.php" method="post">  
                <input type="email" placeholder="Enter email" name="Email" id="Email" required>  
                <input type="password" placeholder="Enter Password" name="Password" id="Password" required>
                <button type="submit" name="send"  class="btn">Login </button>  
            </form> 
            <label> Dont have an account?  </label>
            <form action="SignUp.php">
                <button  class="btn1">SignUp </button>  
            </form> 
        </div>   
        
</body>     
</html>     