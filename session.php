<?php
    session_start();
    if(!isset($_SESSION['mySession'])){
        echo "<script>alert('Please login first.');window.location.href='../../Login.php';</script>";
    }
?>