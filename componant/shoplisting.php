<?php

if (isset($_GET['cat'])) {
    $cat_id = $_GET["cat"];
}


if (isset($_GET['cat'])) {
    $sql_all = "SELECT * FROM products WHERE categories='$cat_id'";
} else {
    $sql_all = "SELECT * FROM products";
}

$result = $conn->query("$sql_all");
$numresult = $result->num_rows;

?>

<div class="col-lg-9 order-1 order-lg-2 mb-5 mb-lg-0">
    <div class="row mb-3 align-items-center">
        <div class="col-lg-6 mb-2 mb-lg-0">
            <p class="text-small text-muted mb-0">Showing 1–3 of <?=$numresult?> results</p>
        </div>
        <div class="col-lg-6">
            <ul class="list-inline d-flex align-items-center justify-content-lg-end mb-0">
                <li class="list-inline-item text-muted mr-3"><a class="reset-anchor p-0" href="#"><i class="fas fa-th-large"></i></a></li>
                <li class="list-inline-item text-muted mr-3"><a class="reset-anchor p-0" href="#"><i class="fas fa-th"></i></a></li>
                <li class="list-inline-item">
                    <select class="selectpicker ml-auto" name="sorting" data-width="200" data-style="bs-select-form-control" data-title="Default sorting">
                        <option value="default">Default sorting</option>
                        <option value="popularity">Popularity</option>
                        <option value="low-high">Price: Low to High</option>
                        <option value="high-low">Price: High to Low</option>
                    </select>
                </li>
            </ul>
        </div>
    </div>
    <div class="row">
        <?php
        // Constants
        $productsPerPage = 3;
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $start = ($page - 1) * $productsPerPage;

        // $sql_all = "SELECT * FROM products";

        if (!isset($_GET['cat'])) {
            $sql_3 = "SELECT * FROM products LIMIT $start, $productsPerPage";
        } else {
            $sql_3 = "SELECT * FROM products WHERE categories='$cat_id' LIMIT $start, $productsPerPage ";
        }


        $result = $conn->query("$sql_3");
        while ($row = $result->fetch_assoc()) {
            $modalId = "productView" . $row['id'];
        ?>
            <!-- PRODUCT-->
            <div class="col-lg-4 col-sm-6">
                <?php
                include('componant/product.php');
                ?>
        <?php
        }
        ?>

        <?php
        if (isset($_GET['cat'])) {
            $countResult = $conn->query("SELECT COUNT(*) as total FROM products WHERE categories='$cat_id'");
        } else {
            $countResult = $conn->query('SELECT COUNT(*) as total FROM products');
        }
        $countRow = $countResult->fetch_assoc();
        // print_r($countRow);
        $totalProducts = $countResult->num_rows > 0 ? $countRow['total'] : 0;
        $totalPages = ceil($totalProducts / $productsPerPage);
        ?>
        <!-- PAGINATION-->
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center justify-content-lg-end">
                <!-- Previous page link -->
                <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
                    <?php $prevPage = ($page > 1) ? ($page - 1) : 1; ?>
                    <?php
                    if (isset($_GET['cat'])) {
                    ?>
                        <a class="page-link" href="?cat=<?= $cat_id ?>&page=<?= $prevPage ?>" aria-label="Previous">
                            <span aria-hidden="true">«</span>
                        </a>
                    <?php
                    } else {
                    ?>
                        <a class="page-link" href="?page=<?= $nextPage ?>" aria-label="Next">
                            <span aria-hidden="true">»</span>
                        </a>
                    <?php
                    }
                    ?>
                </li>
                <!-- Page links -->
                <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                    <li class="page-item <?= $page == $i ? 'active' : '' ?>">
                        <?php
                        if (isset($_GET['cat'])) {
                        ?>
                            <a class="page-link" href="?cat=<?= $cat_id ?>&page=<?= $i ?>"><?= $i ?></a>
                        <?php
                        } else {
                        ?>
                            <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                        <?php
                        }
                        ?>
                    </li>
                <?php endfor; ?>
                <!-- Next page link -->
                <?php $nextPage = ($page < $totalPages) ? ($page + 1) : $totalPages; ?>
                <li class="page-item <?= $page == $totalPages ? 'disabled' : '' ?>">
                    <?php
                    if (isset($_GET['cat'])) {
                    ?>
                        <a class="page-link" href="?cat=<?= $cat_id ?>&page=<?= $nextPage ?>" aria-label="Next">
                            <span aria-hidden="true">»</span>
                        </a>
                    <?php
                    } else {
                    ?>
                        <a class="page-link" href="?page=<?= $nextPage ?>" aria-label="Next">
                            <span aria-hidden="true">»</span>
                        </a>
                    <?php
                    }
                    ?>
                </li>
            </ul>
        </nav>
        </div>