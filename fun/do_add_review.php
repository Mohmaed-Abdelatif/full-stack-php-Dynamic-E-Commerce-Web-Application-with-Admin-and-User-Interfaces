<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("location:../login.php");
    exit();
}else{
$user_id=$_SESSION['user_id'];
}
$product_id = $_GET['id'];
$rating = $_POST['rating'];
$review = $_POST['review'];
$dt = date("Y-m-d");

if ($rating == '') {
    $errors['rating'] = 'rating fild cannot be impty';
}





if (empty($errors)) {
    include('connect.php');
    $conn->query("INSERT INTO reviews(user_id, product_id, rating, review, date) VALUES ('$user_id','$product_id','$rating','$review','$dt')");
    
    $total_rate = 0;
    $result = $conn->query("SELECT * FROM reviews WHERE product_id=$product_id");
    while ($row = $result->fetch_assoc()) {
        $total_rate += $row['rating'];
        $user_id = $row["user_id"];
        $user_result = $conn->query("SELECT * FROM users WHERE id=$user_id");
        $user = $user_result->fetch_assoc();
    }
    $new_total_rate = $total_rate / $result->num_rows;
    $conn->query("UPDATE products SET rate='$new_total_rate' WHERE id=$product_id");

    header("location:../detail.php?id=$product_id");
} else {
    $_SESSION["errors"] = $errors;
    header("location:../detail.php?id=$product_id");
}
