<?php
session_start();
include("connect.php");
$errors = [];

if (!isset($_SESSION['user_id'])) {
    header("location:../login.php");
    exit();
} else {
    $user_id = $_SESSION['user_id'];
}

$pro_id = $_GET['id'];

if (isset($_POST['quantity'])) {
    $quantity = $_POST['quantity'];
} else {
    $quantity = 1;
}


$pro_result = $conn->query("SELECT * FROM products WHERE id='$pro_id'");
$product = $pro_result->fetch_assoc();
if ($product["count"] == "0") {
    $errors['outOfStock'] = 'This Product Is Out OF Stock';
    $_SESSION["errors"] = $errors;
    header("location:../detail.php?id=$pro_id");
    exit("");
} elseif ($quantity > $product["count"]) {
    $errors['largeQuantity'] = 'Quantity Available For This Product is '.$product["count"];
    $quantity = $product["count"];
} elseif ($quantity == 0) {
    $quantity = 1;
}

$result = $conn->query("SELECT * FROM cart WHERE user_id='$user_id' AND product_id='$pro_id'");
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $old_quantity = $row["quantity"];
    $new_quantity = $old_quantity + $quantity;

    if ($new_quantity > $product["count"]) {
        $errors['largeQuantity'] = 'Quantity Available For This Product is '.$product["count"];
        $new_quantity = $product["count"];
    }
    $conn->query("UPDATE cart SET quantity='$new_quantity' WHERE user_id='$user_id' AND product_id='$pro_id'");
} else {
    $conn->query("INSERT INTO cart(user_id, product_id, quantity) VALUES ('$user_id','$pro_id','$quantity')");
}

if (empty($errors)) {
    header("location:../cart.php");
}else {
    $_SESSION["errors"] = $errors;
    header("location:../cart.php?id=$pro_id");
}
