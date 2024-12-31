<?php

$title = 'Dashboard';
session_start();

if(!isset($_SESSION["ADMIN"])){
    header("Location: index.php");
    exit();
}else{
    header("Location: orders.php");
}
include 'include/nav.php' ; 

?>

<?php include 'include/footer.php'?>

