<?php
$status = "Products";
include("componant/sidebar.php");
include("componant/navbar.php");

?>



                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Products</h1>
                        
                    </div>


                    <?php
                        if(!isset($_GET['action'])){
                            include('productsPages/all_products.php');
                        }elseif($_GET['action'] === 'add'){
                            include('productsPages/add_product.php');
                        }elseif($_GET['action'] === 'edit'){
                            include('productsPages/edit_product.php');
                        }
                    ?>

                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php 
                include('componant/footer.php')
            ?>