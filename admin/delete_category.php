<?php
    session_start();

    if(!isset($_SESSION["ADMIN"])){
        header("Location: index.php");
        exit();
    }
    
    //include 'include/nav.php';
    include 'function/function.php';

    if(isset($_GET['id'])){
        $del_id = $_GET['id'];
        $query = "DELETE FROM categories WHERE id='$del_id'";
        $result = mysqli_query($con,$query);
        if($result){
            header("Location: manage_category.php");
        }
    }
?>