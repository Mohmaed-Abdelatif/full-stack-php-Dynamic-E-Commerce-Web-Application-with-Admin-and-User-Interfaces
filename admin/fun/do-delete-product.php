<?php
include("connect.php");
$id = $_GET['id'];

$result = $conn->query("SELECT imge FROM products WHERE id=$id");
$row = $result->fetch_assoc();
$img_name = $row["imge"];
$images = explode(',', $img_name);


$conn->query("DELETE FROM products WHERE id=$id");



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





header("location:../products.php");
?>