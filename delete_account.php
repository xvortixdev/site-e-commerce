<?php
    include 'includes/nav.php';
    
    if(!isset($_SESSION["USER"])){
        header("Location: index.php");
        exit();
    }

    if(isset($_GET['id'])){
        $del_id = $_GET['id'];
        $query = "DELETE FROM users WHERE id='$del_id'";
        $result = mysqli_query($con,$query);
        if($result){
            header("Location: users.php");
        }
    }


?>