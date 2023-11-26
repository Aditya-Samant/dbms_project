<?php
session_start();
print_r($_SESSION);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
     <title> Home </title> 
    <link rel="stylesheet" href="css/home.css">
   </head>
<body>
  <nav>
    <div class="nav-content">
      <div class="logo">
        <a href="#">Welcome.</a>
      </div>    
      <ul class="nav-links">
        <li><a href="#">Home</a></li>
        <li><a href="newtodo.php">To-Do</a></li>
        <li><a href="uevent.php">Events</a></li>
        <li><a href="#">About</a></li>
        <li><a href="logout.php" id="rr">LOGOUT</a></li>
      </ul>
    </div>
  </nav>
  <!-- <section class="home"></section> -->
  <div class="text">
<!-- //content here     -->
</div>

  <script>
  let nav = document.querySelector("nav");
  nav.classList.add("sticky");

    window.onscroll = function() {
      
    }
  </script>

</body>
</html>