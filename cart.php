<?php
$status = "cart";
include("componant/navbar.php");

if(isset($_GET["id"])){
  $id=$_GET["id"];
}
?>
<div class="container">
  <!-- HERO SECTION-->
  <section class="py-5 bg-light">
    <div class="container">
      <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
        <div class="col-lg-6">
          <h1 class="h2 text-uppercase mb-0">Cart</h1>
        </div>
        <div class="col-lg-6 text-lg-right">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-lg-end mb-0 px-0">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Cart</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </section>
  <section class="py-5">
    <h2 class="h5 text-uppercase mb-4">Shopping cart</h2>
    <div class="row">
      <div class="col-lg-8 mb-4 mb-lg-0">
        <!-- CART TABLE-->
        <div class="table-responsive mb-4">
          <table class="table">
            <thead class="bg-light">
              <tr>
                <th class="border-0" scope="col"> <strong class="text-small text-uppercase">Product</strong></th>
                <th class="border-0" scope="col"> <strong class="text-small text-uppercase">Price</strong></th>
                <th class="border-0" scope="col"> <strong class="text-small text-uppercase">Quantity</strong></th>
                <th class="border-0" scope="col"> <strong class="text-small text-uppercase">Total</strong></th>
                <th class="border-0" scope="col"> </th>
              </tr>
            </thead>
            <tbody>
              <?php
              $total = 0;
              if (isset($_SESSION["user_id"])) {
                while ($row = $result->fetch_assoc()) {
                  $product_id = $row["product_id"];
                  $proResult = $conn->query("SELECT * FROM products WHERE id=$product_id");
                  $productRow = $proResult->fetch_assoc();
                  $images = explode(',', $productRow['imge']);
                  $first_image = $images[0];
              ?>
                  <tr>
                    <th class="pl-0 border-0" scope="row">
                      <div class="media align-items-center"><a class="reset-anchor d-block animsition-link" href="detail.php?id=<?= $row['product_id'] ?>"><img src="admin/img/<?= $first_image ?>" alt="..." width="70" /></a>
                        <div class="media-body ml-3"><strong class="h6"><a class="reset-anchor animsition-link" href="detail.php?id=<?= $row['product_id'] ?>">
                              <?= $productRow['name'] ?>
                            </a></strong>
                        </div>
                        <?php 
                            if(isset($_GET["id"])){
                              if($product_id == $id){
                                if (isset($_SESSION["errors"]['largeQuantity'])) {
                                  ?>
                                    <div class="alert alert-warning" role="alert">
                                      <?= $_SESSION['errors']['largeQuantity'] ?>
                                    </div>
                                  <?php
                                  }
                              }
                            }
                            ?>
                      </div>
                    </th>
                    <td class="align-middle border-0">
                      <p class="mb-0 small">$
                        <?= $productRow['price'] ?>
                      </p>
                    </td>
                    <td class="align-middle border-0">
                      <form action="fun/edit_in_cart.php?id=<?= $productRow['id'] ?>" method="post">
                        <div class="border d-flex align-items-center justify-content-between px-3"><span class="small text-uppercase text-gray headings-font-family">Quantity</span>
                          <div class="quantity">
                            <button class="dec-btn p-0"><i class="fas fa-caret-left"></i></button>
                            <input class="form-control form-control-sm border-0 shadow-0 p-0" type="text" value="<?= $row['quantity'] ?>" name="quantity" />
                            <button class="inc-btn p-0"><i class="fas fa-caret-right"></i></button>
                          </div>
                        </div>
                      </form>
                    </td>
                    <td class="align-middle border-0">
                      <p class="mb-0 small">$
                        <?php
                        $pro_total = $productRow['price'] * $row['quantity'];
                        print_r($pro_total);
                        $total += $pro_total;
                        ?>
                      </p>
                    </td>
                    <td class="align-middle border-0"><a class="reset-anchor" href="fun/do-delete-pro-cart.php?id=<?= $product_id ?>"><i class="fas fa-trash-alt small text-muted"></i></a></td>
                  </tr>
              <?php
                }
              }
              ?>
            </tbody>
          </table>
        </div>
        <!-- CART NAV-->
        <div class="bg-light px-4 py-3">
          <div class="row align-items-center text-center">
            <div class="col-md-6 mb-3 mb-md-0 text-md-left"><a class="btn btn-link p-0 text-dark btn-sm" href="shop.php"><i class="fas fa-long-arrow-alt-left mr-2"> </i>Continue shopping</a></div>
            <div class="col-md-6 text-md-right"><a class="btn btn-outline-dark btn-sm" href="checkout.php">Procceed to
                checkout<i class="fas fa-long-arrow-alt-right ml-2"></i></a></div>
          </div>
        </div>
      </div>
      <!-- ORDER TOTAL-->
      <div class="col-lg-4">
        <div class="card border-0 rounded-0 p-lg-4 bg-light">
          <div class="card-body">
            <h5 class="text-uppercase mb-4">Cart total</h5>
            <ul class="list-unstyled mb-0">
              <li class="d-flex align-items-center justify-content-between"><strong class="text-uppercase small font-weight-bold">Subtotal</strong><span class="text-muted small">$<?= $total ?></span></li>
              <li class="border-bottom my-2"></li>
              <li class="d-flex align-items-center justify-content-between mb-4"><strong class="text-uppercase small font-weight-bold">Total</strong><span>$<?= $total ?></span></li>
              <li>
                <form action="">
                  <div class="form-group mb-0">
                    <input class="form-control" type="text" placeholder="Enter your coupon">
                    <button class="btn btn-dark btn-sm btn-block" type="submit"> <i class="fas fa-gift mr-2"></i>Apply
                      coupon</button>
                  </div>
                </form>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<?php
include('componant/footer.php');
?>
