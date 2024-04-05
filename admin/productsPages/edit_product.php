<?php
include("fun/connect.php");
$id = $_GET['id'];

$result = $conn->query("SELECT * FROM products WHERE id=$id");
$product = $result->fetch_assoc();
?>

<form method="POST" action="fun/do-edit-product.php?id=<?= $product['id'] ?>" enctype="multipart/form-data">
    <div class="form-group">
        <label for="name" style='font-weight: bold;'>Product Name:</label>
        <input type="text" class='form-control' name='name'  value="<?= $product['name'] ?>">
        <?php
        if (isset($_SESSION["errors"]['name'])) {
        ?>
            <div class="alert alert-danger" role="alert">
                <?= $_SESSION['errors']['name'] ?>
            </div>
        <?php
        }
        ?>
    </div>
    <div class="form-group">
        <label for="price" style='font-weight: bold;'>Price:</label>
        <input type="number" class='form-control' name='price'  value="<?= $product['price'] ?>">
        <?php
        if (isset($_SESSION["errors"]['price'])) {
        ?>
            <div class="alert alert-danger" role="alert">
                <?= $_SESSION['errors']['price'] ?>
            </div>
        <?php
        }
        ?>
    </div>
    <div class="form-group">
        <label for="count" style='font-weight: bold;'>Count:</label>
        <input type="number" class='form-control' name='count' value="<?= $product['count'] ?>">
        <?php
        if (isset($_SESSION["errors"]['count'])) {
        ?>
            <div class="alert alert-danger" role="alert">
                <?= $_SESSION['errors']['count'] ?>
            </div>
        <?php
        }
        ?>
    </div>
    <div class="form-group">
        <label for="desc" style='font-weight: bold;'>describtion:</label>
        <textarea style="height: 150px;" class='form-control' name='desc'><?= $product['description'] ?></textarea>
        <?php
        if (isset($_SESSION["errors"]['descrption'])) {
        ?>
            <div class="alert alert-danger" role="alert">
                <?= $_SESSION['errors']['descrption'] ?>
            </div>
        <?php
        }
        ?>
    </div>
    <div class="form-group">
        <label for="image" style='font-weight: bold;'>Image:</label>
        <input type="file" name='image[]' multiple="">
        <div style="display: flex;">
            <?php
            $images = explode(',', $product['imge']);
            for ($i = 0; $i < count($images); $i++) {
            ?>
                <img src="img/<?= $images[$i] ?>" alt="product imge" class='form-control' style="width: 100px; height:100px">
            <?php
            }
            ?>
        </div>
    </div>
    <div class="form-group">
        <label for="category" style='font-weight: bold;'>Category:</label>
        <select class='form-control' name='category'>
            <?php
            $catResult = $conn->query("SELECT * FROM categories");
            while ($catRow = $catResult->fetch_assoc()) {
            ?>
                <option value="<?= $catRow['id'] ?>" <?php
                    if ($catRow['id'] === $product['categories']) {
                        echo "selected";
                    }
                    ?>><?= $catRow['name'] ?>
                </option>
            <?php
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="brand" style='font-weight: bold;'>Brand:</label>
        <select class='form-control' name='brand'>
            <?php
            $brandResult = $conn->query("SELECT * FROM brands");
            while ($brandRow = $brandResult->fetch_assoc()) {
            ?>
                <option value="<?= $brandRow['id'] ?>" <?php
                    if ($brandRow['id'] === $product['brand']) {
                        echo "selected";
                    }
                    ?>><?= $brandRow['name'] ?>
                </option>
            <?php
            }
            ?>
        </select>
    </div>
    <button type='submit' value="edit Product" class="btn btn-success">Edit</button>
</form>
<?php
unset($_SESSION['errors']);
?>