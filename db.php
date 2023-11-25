<?php
$hname="localhost";
$uname="moon";
$password="qT-nA*@PLGNJGoYm";
$dbname="trial";
$con=mysqli_connect($hname,$uname,$password,$dbname);

if(!$con)
{
    die("Connection failed".mysqli_connect_error());
}
?>