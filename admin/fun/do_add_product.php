<?php
session_start();
$errors=[];

$file_name = $_FILES['image']['name'];
$imgs_names=[];
$imge_exist=$_FILES['image']['error'][0];

if ($imge_exist==0) {
    foreach ($file_name as $key => $value) {

        $img_name = $_FILES['image']["name"][$key];
        $img_tmp = $_FILES['image']['tmp_name'][$key];
        $img_size = $_FILES['image']['size'][$key];

        $img_explode = explode('.', $img_name);
        $img_ext = end($img_explode);
        $allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];

        if (!in_array($img_ext, $allowed_ext)) {
            echo 'imge '; print_r($img_name); echo ' type error';
            exit();
        }

        if ($img_size > 8000000) {
            echo 'imge'; print_r($img_name);echo ' is too large should be less than 8 mega';
            exit();
        }

        $new_img_name = time() . rand(0, 10000) . $img_name;
        array_push($imgs_names, $new_img_name);

        move_uploaded_file($img_tmp, "../img/$new_img_name");
        echo"okokokok";
    }
}else{
    // header("location:../Products.php?action=add&error='image fild cant be impty'");

    $errors['image']='image fild cannot be impty';
}

$new_imgs_names = implode(",", $imgs_names);


$name = $_POST['name'];
$price = $_POST['price'];
$count = $_POST['count'];
$desc = $_POST['desc'];
$category = $_POST['category'];
$brand = $_POST['brand'];

if($name==''){
    $errors['name']='name fild cannot be impty';
}
if($price==''){
    $errors['price']='price fild cannot be impty';
}
if($count==''){
    $errors['count']='count fild cannot be impty';
}
if($desc==''){
    $errors['descrption']='descrption fild cannot be impty';
}

if(empty($errors)){
    include('connect.php');
    $insert = "INSERT INTO products( name, price, imge, categories, brand, count, description) VALUES ('$name','$price','$new_imgs_names','$category','$brand','$count','$desc')";
    $conn->query($insert);
    header("location:../Products.php");
}else{
    $_SESSION["errors"] = $errors;
    header("location:../Products.php?action=add");

}

?>