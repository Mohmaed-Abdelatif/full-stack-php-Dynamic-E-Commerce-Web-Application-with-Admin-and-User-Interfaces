<?php
$status = "detail";
include("componant/navbar.php");
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $result = $conn->query("SELECT * FROM products WHERE id=$id");
  $product = $result->fetch_assoc();

  $images = explode(',', $product['imge']);
  $first_image = $images[0];
}

?>
<section class="py-5">
  <div class="container">
    <div class="row mb-5">
      <div class="col-lg-6">
        <!-- PRODUCT SLIDER-->
        <div class="row m-sm-0">
          <div class="col-sm-2 p-sm-0 order-2 order-sm-1 mt-2 mt-sm-0">
            <div class="owl-thumbs d-flex flex-row flex-sm-column" data-slider-id="1">
              <?php
              if (count($images) > 1) {
                for ($i = 1; $i < count($images); $i++) {
              ?>
                  <div class="owl-thumb-item flex-fill mb-2 mr-2 mr-sm-0"><img class="w-100" src="admin/img/<?= $images[$i] ?>" alt="..."></div>
              <?php
                }
              }
              ?>
              <div class="owl-thumb-item flex-fill mb-2"><img class="w-100" src="admin/img/<?= $images[0] ?>" alt="..."></div>
            </div>
          </div>
          <div class="col-sm-10 order-1 order-sm-2">
            <div class="owl-carousel product-slider" data-slider-id="1">
              <?php
              if (count($images) > 1) {
                for ($i = 1; $i < count($images); $i++) {
              ?>
                  <div class="owl-thumb-item flex-fill mb-2 mr-2 mr-sm-0"><img class="w-100" src="admin/img/<?= $images[$i] ?>" alt="..."></div>
                  <a class="d-block" href="admin/img/<?= $images[$i] ?>" data-lightbox="product" title="Product item 1"><img class="img-fluid" src="admin/img/<?= $images[$i] ?>" alt="..."></a>
              <?php
                }
              }
              ?>
              <a class="d-block" href="img/product-detail-4.jpg" data-lightbox="product" title="Product item 4"><img class="img-fluid" src="admin/img/<?= $images[0] ?>" alt="..."></a>
            </div>
          </div>
        </div>
      </div>
      <!-- PRODUCT DETAILS-->
      <div class="col-lg-6">
        <ul class="list-inline mb-2">
          <?php
          $total_rating = $product['rate'];
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
        <h1><?= $product['name'] ?></h1>
        <p class="text-muted lead">$<?= $product['price'] ?></p>
        <p class="text-small mb-4"><?= $product['description'] ?></p>
        <form action="fun/do-add-in-cart.php?id=<?= $product['id'] ?>" method="post">
          <div class="row align-items-stretch mb-4">
            <div class="col-sm-5 pr-sm-0">
              <div class="border d-flex align-items-center justify-content-between py-1 px-3 bg-white border-white"><span class="small text-uppercase text-gray mr-4 no-select">Quantity</span>
                <div class="quantity">
                  <span class="dec-btn p-0"><i class="fas fa-caret-left"></i></span>
                  <input class="form-control border-0 shadow-0 p-0" type="text" value="1" name="quantity">
                  <span class="inc-btn p-0"><i class="fas fa-caret-right"></i></span>
                </div>
              </div>
            </div>
            <button class="col-sm-3 pl-sm-0  btn btn-dark ">Add to cart</button>
          </div>
        </form>
        <?php
        if (isset($_SESSION["errors"]['outOfStock'])) {
        ?>
          <div class="alert alert-warning" role="alert">
            <?= $_SESSION['errors']['outOfStock'] ?>
          </div>
        <?php
        }
        ?>
        <a class="btn btn-link text-dark p-0 mb-4" href="#"><i class="far fa-heart mr-2"></i>Add to wish list</a><br>
        <ul class="list-unstyled small d-inline-block">
          <li class="px-3 py-2 mb-1 bg-white text-muted"><strong class="text-uppercase text-dark">Category:</strong><a class="reset-anchor ml-2" href="#">
              <?php
              $catid = $product['categories'];
              $categoryresult = $conn->query("SELECT * from categories WHERE id=$catid");
              $category = $categoryresult->fetch_assoc();
              print_r($category['name']);
              ?>
            </a></li>
          <li class="px-3 py-2 mb-1 bg-white text-muted"><strong class="text-uppercase text-dark">Brand:</strong><a class="reset-anchor ml-2" href="#">
              <?php
              $brandid = $product['brand'];
              $brandresult = $conn->query("SELECT * from brands WHERE id=$brandid");
              $brand = $brandresult->fetch_assoc();
              print_r($brand['name']);
              ?>
            </a></li>
        </ul>
      </div>
    </div>
    <!-- DETAILS TABS-->
    <ul class="nav nav-tabs border-0" id="myTab" role="tablist">
      <li class="nav-item"><a class="nav-link active" id="description-tab" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true">Description</a></li>
      <li class="nav-item"><a class="nav-link" id="reviews-tab" data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">Reviews</a></li>
      <li class="nav-item"><a class="nav-link" id="make_review-tab" data-toggle="tab" href="#make_review" role="tab" aria-controls="make_review" aria-selected="false">Make Review</a></li>
    </ul>
    <div class="tab-content mb-5" id="myTabContent">
      <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
        <div class="p-4 p-lg-5 bg-white">
          <h6 class="text-uppercase">Product description </h6>
          <p class="text-muted text-small mb-0"><?= $product['description'] ?></p>
        </div>
      </div>
      <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
        <div class="p-4 p-lg-5 bg-white">
          <div class="row">
            <div class="col-lg-8">
              <?php
              $result = $conn->query("SELECT * FROM reviews WHERE product_id=$id");
              while ($row = $result->fetch_assoc()) {
                $user_id = $row["user_id"];
                $user_result = $conn->query("SELECT * FROM users WHERE id=$user_id");
                $user = $user_result->fetch_assoc();
              ?>
                <div class="media mb-3"><img class="rounded-circle" src="<?php echo $user["gender"] == '1' ? "img/maleuser.png" : "img/femaleuser.png" ?>" alt="" width="50">
                  <div class="media-body ml-3">
                    <h6 class="mb-0 text-uppercase"><?= $user['username'] ?></h6>
                    <p class="small text-muted mb-0 text-uppercase"><?= $row['date'] ?></p>
                    <ul class="list-inline mb-1 text-xs">
                      <?php
                      $rating = $row['rating'];
                      $rest = 5 - $rating;
                      for ($i = 0; $i < $rating; $i++) {
                      ?>
                        <li class="list-inline-item m-0"><i class="fas fa-star text-warning"></i></li>
                        <?php
                      }
                      if ($rest > 0) {
                        for ($i = 0; $i < $rest; $i++) {
                        ?>
                          <li class="list-inline-item m-0"><i class="fas fa-star"></i></li>
                      <?php
                        }
                      }
                      ?>
                    </ul>
                    <p class="text-small mb-0 text-muted"><?= $row['review'] ?></p>
                  </div>
                </div>
              <?php
              }
              ?>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane fade show" id="make_review" role="tabpanel" aria-labelledby="make_review-tab">
        <div class="p-4 p-lg-5 bg-white">
          <h6 class="text-uppercase">Your Review </h6>
          <form method="POST" action="fun/do_add_review.php?id=<?= $id ?>">
            <div class="form-group">
              <label for="count" style='font-weight: bold;'>Count Of Starts:</label>
              <ul class="list-inline mb-2">
                <?php
                for ($i = 1; $i <= 5; $i++) {
                ?>
                  <div class="row">
                    <div class="col-auto">
                      <input type="radio" id="star<?= $i ?>" name="rating" value="<?= $i ?>" required />
                      <label for="star<?= $i ?>" title="<?= $i ?> star">
                        <?php
                        for($j = 1; $j <= $i; $j++){
                          ?>
                          <li class="list-inline-item m-0"><i class="fas fa-star text-warning"></i></li>
                          <?php
                        }
                        ?>
                      </label>
                    </div>
                  </div>
                <?php
                }
                ?>
              </ul>
              <?php
              if (isset($_SESSION["errors"]['rating'])) {
              ?>
                <div class="alert alert-danger" role="alert">
                  <?= $_SESSION['errors']['rating'] ?>
                </div>
              <?php
              }
              ?>
            </div>
            <div class="form-group">
              <label for="desc" style='font-weight: bold;'>Describe Your Experience (optional):</label>
              <textarea style="height: 150px;" class='form-control' name='review'></textarea>
            </div>
            <button type='submit' value="Add Product" class="btn btn-success">Add Review</button>
          </form>
        </div>
      </div>
    </div>
    <!-- RELATED PRODUCTS-->
    <h2 class="h5 text-uppercase mb-4">Related products</h2>
    <div class="row">
      <?php
      $sameCategory = $product['categories'];
      $sameBrand = $product['brand'];

      $result = $conn->query("SELECT * FROM products WHERE (categories = $sameCategory OR brand = $sameBrand) AND id != $id");
      while ($row = $result->fetch_assoc()) {
        $modalId = "productView" . $row['id'];
      ?>
        <!-- PRODUCT-->
        <div class="col-lg-3 col-sm-6">
          <?php
          include('componant/product.php');
          ?>
        <?php
      }
        ?>
        </div>
    </div>
</section>
<?php
include('componant/footer.php');
?>
