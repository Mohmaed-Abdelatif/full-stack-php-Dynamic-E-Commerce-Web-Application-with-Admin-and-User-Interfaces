<?php
$status = "Admins";
include("componant/sidebar.php");


if ($_SESSION['priv'] > "100") {
    include("componant/navbar.php");
?>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Admins</h1>

        </div>


        <?php
        if (!isset($_GET['action'])) {
            include('adminsPages/all_admins.php');
        } elseif ($_GET['action'] === 'add') {
            include('adminsPages/add_admin.php');
        } elseif ($_GET['action'] === 'edit') {
            include('adminsPages/edit_admin.php');
        }
        ?>

    </div>
    <!-- /.container-fluid -->
    </div>
    <!-- End of Main Content -->

    <!-- Footer -->
    <?php  
        include('componant/footer.php');
    ?>
    <?php
}else { 
    header("location:dashbord.php");
}



?>