<?php
include("connect.php");
$id = $_GET['id'];

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
    if ($_FILES['image']['error'][0] === 0) {
        $file_name = $_FILES['image']['name'];
        $imgs_names = [];
        if (!empty($file_name)) {
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
            }
        }
        $new_imgs_names = implode(",", $imgs_names);
    
        //delet old from directory(pc,server)
        $result = $conn->query("SELECT imge FROM products WHERE id=$id");
        $row = $result->fetch_assoc();
        $img_name = $row["imge"];
        $images = explode(',', $img_name);
        if (count($images) > 1) {
            for ($i = 0; $i < count($images); $i++){
                $img_path = "../img/" . $images[ $i ];
                print_r($img_path);
                if (file_exists($img_path)) {
                    unlink($img_path);
                    echo "Product and image deleted successfully.";
                } else {
                    echo "Product deleted, but image not found.";
                }
            }
        } else {
            $img_path = "../img/" . $img_name;
            print_r($img_path);
            if (file_exists($img_path)) {
                unlink($img_path);
                echo "Product and image deleted successfully.";
            } else {
                echo "Product deleted, but image not found.";
            }
        }
    
        $update = "UPDATE products SET name='$name',price='$price',imge='$new_imgs_names',categories='$category',brand='$brand',count='$count',description='$desc' WHERE id=$id";
    } else {
        $update = "UPDATE products SET name='$name',price='$price',categories='$category',brand='$brand',count='$count',description='$desc' WHERE id=$id";
    }
    
    $conn->query($update);
    header("location:../Products.php");
}else{
    $_SESSION["errors"] = $errors;
    header("location:../Products.php?action=add");

}


?>