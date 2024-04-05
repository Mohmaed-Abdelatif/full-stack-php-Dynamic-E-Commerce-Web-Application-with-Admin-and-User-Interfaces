<?php
$status = "Messeges";
include("componant/sidebar.php");
include("componant/navbar.php");

?>



<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Messeges</h1>

    </div>
    <div class="card shadow mb-4">


        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="bg-primary text-white">
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>View</th>
                            <th style="width: 160px">Controls</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr class="bg-primary text-white">
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>View</th>
                            <th style="width: 160px">Controls</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $messegeResult = $conn->query("SELECT * FROM message ORDER BY id DESC");
                        while ($messegeRow = $messegeResult->fetch_assoc()) {

                        ?>
                            <tr class="<?php echo $messegeRow['view'] === '1' ? "":"bg-dark" ?>">
                                <td><?= $messegeRow['name']  ?></td>
                                <td><?= $messegeRow['phone'] ?></td>
                                <td><?= $messegeRow['email'] ?></td>
                                <td class='view'><?php echo $messegeRow['view'] === '1' ? "Seen" : "NotSeen" ?></td>
                                <td>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary modalbtn" data-toggle="modal" data-target="#exampleModal<?= $messegeRow['id'] ?>" data-id="<?= $messegeRow['id']?>">
                                        View Message
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal<?= $messegeRow['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Message From <?= $messegeRow['email'] ?></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                <?= $messegeRow['message'] ?>
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

</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->

<!-- Footer -->
<?php
include('componant/footer.php')
?>