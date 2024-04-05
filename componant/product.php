    <div class="product text-center">
        <div class="mb-3 position-relative">
            <?php
            $images = explode(',', $row['imge']);
            $first_image = $images[0];
            ?>
            <div class="badge text-white badge-"></div><a class="d-block" href="detail.php?id=<?= $row['id'] ?>"><img class="img-fluid w-100" src="admin/img/<?= $first_image ?>" alt="..." style="height: 200px"></a>
            <div class="product-overlay">
                <ul class="mb-0 list-inline">
                    <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-outline-dark" href="#"><i class="far fa-heart"></i></a></li>
                    <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-dark" href="fun/do-add-in-cart.php?id=<?= $row['id'] ?>">Add to cart</a></li>
                    <li class="list-inline-item mr-0"><a class="btn btn-sm btn-outline-dark" href="#<?= $modalId ?>" data-toggle="modal"><i class="fas fa-expand"></i></a></li>
                </ul>
            </div>
        </div>
        <h6> <a class="reset-anchor" href="detail.php?id=<?= $row['id'] ?>"><?= $row['name'] ?></a></h6>
        <p class="small text-muted">$<?= $row['price'] ?></p>
    </div>
    </div>

    <!--  Modal -->
    <div class="modal fade" id="<?= $modalId ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="row align-items-stretch">
                        <div class="col-lg-6 p-lg-0"><a class="product-view d-block h-100  bg-cover bg-center" style="background: url(admin/img/<?= $first_image ?>)" href="admin/img/<?= $first_image ?>" data-lightbox="<?= $modalId ?>" title="<?= $row['name'] ?>"></a>
                            <?php
                            if (count($images) > 1) {
                                for ($i = 1; $i < count($images); $i++) {
                            ?>
                                    <a class="d-none" href="admin/img/<?= $images[$i] ?>" title="<?= $row['name'] ?>" data-lightbox="<?= $modalId ?>"></a>
                            <?php
                                }
                            }
                            ?>
                        </div>
                        <div class="col-lg-6">
                            <button class="close p-4" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <div class="p-5 my-md-4">
                                <ul class="list-inline mb-2">
                                    <?php
                                    $total_rating = $row['rate'];
                                    $total_rest = 5 - $total_rating;
                                    for ($i = 0; $i < $total_rating; $i++) {
                                    ?>
                                        <li class="list-inline-item m-0"><i class="fas fa-star text-warning"></i></li>
                                        <?php
                                    }
                                    if ($total_rest > 0) {
                                        for ($i = 0; $i < $total_rest; $i++) {
                                        ?>
                                            <li class="list-inline-item m-0"><i class="fas fa-star"></i></li>
                                    <?php
                                        }
                                    }
                                    ?>
                                </ul>
                                <h2 class="h4"><?= $row['name'] ?></h2>
                                <p class="text-muted"><?= $row['price'] ?></p>
                                <p class="text-small mb-4"><?= $row['description'] ?></p>
                                <form action="fun/do-add-in-cart.php?id=<?= $row['id'] ?>" method="post">

                                    <div class="row align-items-stretch mb-4">
                                        <div class="col-sm-7 pr-sm-0">
                                            <div class="border d-flex align-items-center justify-content-between py-1 px-3"><span class="small text-uppercase text-gray mr-4 no-select">Quantity</span>
                                                <div class="quantity">
                                                    <span class="dec-btn p-0"><i class="fas fa-caret-left"></i></span>
                                                    <input id="quantity-input" class="form-control border-0 shadow-0 p-0" type="text" value="1" name="quantity">
                                                    <span class="inc-btn p-0"><i class="fas fa-caret-right"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="col-sm-5 pl-sm-0 btn btn-dark ">Add to cart</button>
                                    </div>
                                </form>

                                <a class="btn btn-link text-dark p-0" href="#"><i class="far fa-heart mr-2"></i>Add to wish list</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>