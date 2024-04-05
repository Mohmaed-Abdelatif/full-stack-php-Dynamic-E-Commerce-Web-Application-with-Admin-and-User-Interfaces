<?php
$status = "contact";
include("componant/navbar.php");

?>
<div class="container">
    <!-- HERO SECTION-->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
                <div class="col-lg-6">
                    <h1 class="h2 text-uppercase mb-0">Contact</h1>
                </div>
                <div class="col-lg-6 text-lg-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-lg-end mb-0 px-0">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Contact</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <section class="py-5">
        <form class="comment">
            <div class="form-group">
                <label for="name" style='font-weight: bold;'>Name:</label>
                <input type="text" class='form-control' name='name'>
            </div>
            <div class="form-group">
                <label for="name" style='font-weight: bold;'>Phone:</label>
                <input type="number" class='form-control' name='phone'>
            </div>
            <div class="form-group">
                <label for="name" style='font-weight: bold;'>Email:</label>
                <input type="email" class='form-control' name='email'>
            </div>
            <div class="form-group">
                <label for="desc" style='font-weight: bold;'>Message:</label>
                <textarea style="height: 150px;" class='form-control' name='message'></textarea>
            </div>
            <button type='submit' value="Add Product" class="btn btn-dark">Send</button>
        </form>
        <div class="newData mt-3"></div>
    </section>
</div>
<?php
include('componant/footer.php');
?>