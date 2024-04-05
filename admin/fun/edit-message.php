<?php

$id = $_POST['messageId'];

include("./connect.php");


$query = $conn->query("UPDATE message SET view='1' WHERE id=$id");

if ($query) {
    $messegeCountResult = $conn->query("SELECT * FROM message WHERE view='0'");
    $count = $messegeCountResult->num_rows;
    echo $count;
}
