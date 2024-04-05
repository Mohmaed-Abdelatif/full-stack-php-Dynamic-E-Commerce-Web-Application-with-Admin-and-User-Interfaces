<div class="card shadow mb-4">

    <a href="?action=add" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" style="font-size: 20px;">
        <i class="fas fa-plus fa-sm text-white-50"></i> Add Admin
    </a>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr class="bg-primary text-white">
                        <th>UserName</th>
                        <th>Email</th>
                        <th>Gender</th>
                        <th>permission</th>
                        <th style="width: 150px">Controls</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr class="bg-primary text-white">
                        <th>UserName</th>
                        <th>Email</th>
                        <th>Gender</th>
                        <th>permission</th>
                        <th style="width: 150px">Controls</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    $adminResult = $conn->query("SELECT * FROM admins");
                    while ($adminRow = $adminResult->fetch_assoc()) {
                        $modalId = 'exampleModal_' . $adminRow['id'];
                    ?>
                        <tr>
                            <td><?= $adminRow['username'] ?></td>
                            <td><?= $adminRow['email'] ?></td>
                            <td>
                                <?php
                                $genResult = $conn->query("SELECT * FROM gender WHERE id={$adminRow['gender']} ");
                                $genRow = $genResult->fetch_assoc();
                                echo $genRow["name"];
                                ?>
                            </td>
                            <td>
                                <?php
                                $prmResult = $conn->query("SELECT * FROM permtion WHERE id={$adminRow['permtion']}");
                                $prmRow = $prmResult->fetch_assoc();
                                echo $prmRow["name"];
                                ?>
                            </td>
                            <td>
                                <?php
                                if (!($_SESSION['priv'] === "200" && $adminRow['permtion'] === '1'|| $_SESSION['id'] == $adminRow['id'])) {
                                ?>
                                    <a href="?action=edit&id=<?= $adminRow['id'] ?>"><button type="button" class="btn btn-primary">Edit</button></a>

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
                                                    <a href="fun/do-delete-admin.php?id=<?= $adminRow['id'] ?>"><button type="button" class="btn btn-danger">Delete</button></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
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