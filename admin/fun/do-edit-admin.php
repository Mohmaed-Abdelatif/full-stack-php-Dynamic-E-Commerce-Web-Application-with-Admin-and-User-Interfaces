<?php
include("connect.php");
$id = $_GET['id'];

$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$gender = $_POST['gender'];
$permtion = $_POST['permtion'];

if($username==''){
    $errors['username']='name fild cannot be impty';
}
if($password==''){
    $errors['password']='password fild cannot be impty';
}
if($email==''){
    $errors['email']='email fild cannot be impty';
}


if(empty($errors)){
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $update = "UPDATE admins SET username='$username',password='$hashedPassword',email='$email',gender='$gender',permtion='$permtion' WHERE id=$id";

    $conn->query($update);
    header("location:../admins.php");
}else{
    $_SESSION["errors"] = $errors;
    header("location:../admins.php?action=add");

}


?>