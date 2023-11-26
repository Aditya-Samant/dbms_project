<?php
session_start();
unset($_SESSION['coordinator']);
?>
<!DOCTYPE html>   
<html>   
<head>  
<link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@700&display=swap" rel="stylesheet">
<title> Tasks | Event </title>
<link rel="stylesheet" href="css/index.css">  
</head> 
 
<body>  
    <div class="container">
        <center> <h1> Get Started </h1> </center> 
        <form action="Login.php" >
            <button  class="btn">Login </button>  
        </form>
        <form action="Login.php">
        <input type="hidden" name="coordinator" value="true">
        <button class="btn">Co-ordinator Login </button>
        </form>
        <form action="SignUp.php">
            <button  class="btn">SignUp </button>  
        </form>
    </div>
        
</body>     
</html>     