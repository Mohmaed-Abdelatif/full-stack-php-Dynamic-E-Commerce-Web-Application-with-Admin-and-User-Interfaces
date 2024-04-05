<?php 
    session_start();
    include("connect.php");
    
    if(!isset($_SESSION['user_id'])){
        header("location:../login.php");
        exit();
    }else{
    $user_id=$_SESSION['user_id'];
    }
    $pro_id=$_GET['id'];

    $conn->query("DELETE FROM cart WHERE user_id='$user_id' and product_id='$pro_id'");
    header("location:../cart.php");

?>