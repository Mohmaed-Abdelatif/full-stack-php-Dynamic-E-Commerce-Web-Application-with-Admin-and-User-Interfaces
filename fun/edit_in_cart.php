<?php
session_start();
include ("connect.php");
$errors = [];


if (!isset ($_SESSION['user_id'])) {
    header("location:../login.php");
    exit();
} else {
    $user_id = $_SESSION['user_id'];
}
$pro_id = $_GET['id'];
$quantity = $_POST['quantity'];

$result = $conn->query("SELECT * FROM cart WHERE user_id='$user_id' AND product_id='$pro_id'");
$row = $result->fetch_assoc();
$new_quantity = $quantity;


$pro_result=$conn->query("SELECT * FROM products WHERE id='$pro_id'");
$product=$pro_result->fetch_assoc();
if($new_quantity > $product['count']){
    $errors['largeQuantity'] = 'Quantity Available For This Product is '.$product["count"];
    $new_quantity = $product['count'];
}


if($new_quantity <= 0){
    $conn->query("DELETE FROM cart WHERE user_id='$user_id' and product_id='$pro_id'");
}else{
    $conn->query("UPDATE cart SET quantity='$new_quantity' WHERE user_id='$user_id' AND product_id='$pro_id'");
}

if (empty($errors)) {
    header("location:../cart.php");
}else {
    $_SESSION["errors"] = $errors;
    header("location:../cart.php?id=$pro_id");
}

?>