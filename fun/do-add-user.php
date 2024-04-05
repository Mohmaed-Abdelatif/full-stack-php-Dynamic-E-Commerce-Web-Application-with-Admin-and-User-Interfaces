<?php
session_start();
$errors = [];


$username = $_POST["username"];
$email = $_POST["email"];
$inputPassword = $_POST["inputPassword"];
$repeatPassword = $_POST["repeatPassword"];
$gender= $_POST["gender"];

if ($username == '') {
    $errors['username'] = 'name fild cannot be impty';
}
if ($email == '') {
    $errors['email'] = 'email fild cannot be impty';
}
if ($inputPassword == '') {
    $errors['inputPassword'] = 'Password fild cannot be impty';
}
if ($repeatPassword == '') {
    $errors['repeatPassword'] = 'Repeat Password fild cannot be impty';
}
if ($repeatPassword != $inputPassword) {
    $errors['difPass'] = 'Two Password Should Be The Same';
}

if (empty($errors)) {
    $hashedPassword = password_hash($inputPassword, PASSWORD_DEFAULT);
    include("connect.php");
    $conn->query("INSERT INTO users(username, password, email, gender) VALUES ('$username','$hashedPassword','$email','$gender')");

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        if (password_verify($inputPassword, $row['password'])) {
            $_SESSION["user_login"] = $username;
            $_SESSION['user_id'] = $row['id'];
            header("location:../index.php");
            exit();
        }
    }
} else {
    $_SESSION["errors"] = $errors;
    header("location:../register.php");
}
