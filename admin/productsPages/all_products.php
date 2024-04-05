<div class="card shadow mb-4">
    <a href="?action=add" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" style="font-size: 20px;">
        <i class="fas fa-plus fa-sm text-white-50"></i> Add Product
    </a>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr class="bg-primary text-white">
                        <th>Name</th>
                        <th>Image</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>Brand</th>
                        <th style="width: 150px">Controls</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr class="bg-primary text-white">
                        <th>Name</th>
                        <th>Imge</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>Brand</th>
                        <th style="width: 150px">Controls</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    $productResult = $conn->query("SELECT * FROM products");
                    while ($productRow = $productResult->fetch_assoc()) {
                        $modalId = 'exampleModal_' . $productRow['id'];
                    ?>
                        <tr>
                            <td><?= $productRow['name'] ?></td>
                            <td style="text-align:center;">
                                <?php
                                $images = explode(',', $productRow['imge']);
                                $first_image = $images[0];
                                ?>
                                <img src='img/<?= $first_image ?>' alt="product image" style='height:48px; width:60px;'>
                            </td>
                            <td><?= $productRow['price'] ?></td>
                            <td>
                                <?php
                                $catResult = $conn->query("SELECT * FROM categories WHERE id={$productRow['categories']}");
                                $catRow = $catResult->fetch_assoc();
                                echo $catRow["name"];
                                ?>
                            </td>
                            <td>
                                <?php
                                $brandResult = $conn->query("SELECT * FROM brands WHERE id={$productRow['brand']}");
                                $brandRow = $brandResult->fetch_assoc();
                                echo $brandRow["name"];
                                ?>
                            </td>
                            <td>
                                <a href="?action=edit&id=<?= $productRow['id'] ?>"><button type="button" class="btn btn-primary">Edit</button></a>

                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#<?= $modalId ?>">
                                    Delete
                                </button>

                                <div class="modal fade" id="<?= $modalId ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Are You About Deleting,Can't Be Undone.
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <a href="fun/do-delete-product.php?id=<?= $productRow['id'] ?>"><button type="button" class="btn btn-danger">Delete</button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>