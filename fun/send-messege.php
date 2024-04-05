<?php

$name=$_POST['name'];
$phone=$_POST['phone'];
$email=$_POST['email'];
$message=$_POST['message'];
$timestamp = date('Y-m-d H:i:s');

include("connect.php");
$quereyMessage = $conn->query("INSERT INTO message (name,phone,email,message,messageDate) VALUES ('$name','$phone','$email','$message','$timestamp')");

if($quereyMessage){
    echo '<div class="alert alert-success">Message Send Succesfully</div>';
}else{
    echo $conn->error;
}

?>