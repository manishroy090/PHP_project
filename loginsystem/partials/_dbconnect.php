<?php
$servername = "localhost";
$username = "root";
$password = "";
$database="users";
//create connection//
$conn = mysqli_connect($servername, $username, $password, $database);
if(!$conn){
    die("connection is not sucessful" . mysqli_connect_error());
}
?>