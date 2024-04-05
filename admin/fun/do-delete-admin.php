<?php
include("connect.php");
$id = $_GET['id'];




$conn->query("DELETE FROM admins WHERE id=$id");






header("location:../admins.php");
?>