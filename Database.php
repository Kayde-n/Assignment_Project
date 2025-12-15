<?php
$database=mysqli_connect("localhost","root","","assignment");

if(mysqli_connect_errno()){
    echo "Failed to connect to MYSQL:".mysqli_connect_error();
}
?>