<form method="POST" action="fun/do-add-admin.php" >
    <div class="form-group">
        <label for="username" style='font-weight: bold;'>Admin UseName:</label>
        <input type="text" class='form-control' name='username'>
        <?php
        if (isset($_SESSION["errors"]['username'])) {
        ?>
            <div class="alert alert-danger" role="alert">
                <?= $_SESSION['errors']['username'] ?>
            </div>
        <?php
        }
        ?>
    </div>
    <div class="form-group">
        <label for="password" style='font-weight: bold;'>Password:</label>
        <input type="password" class='form-control' name='password'>
        <?php
        if (isset($_SESSION["errors"]['password'])) {
        ?>
            <div class="alert alert-danger" role="alert">
                <?= $_SESSION['errors']['password'] ?>
            </div>
        <?php
        }
        ?>
    </div>
    <div class="form-group">
        <label for="email" style='font-weight: bold;'>Email:</label>
        <input type="email" class='form-control' name='email'>
        <?php
        if (isset($_SESSION["errors"]['email'])) {
        ?>
            <div class="alert alert-danger" role="alert">
                <?= $_SESSION['errors']['email'] ?>
            </div>
        <?php
        }
        ?>
    </div>
    <div class="form-group">
        <label for="gender" style='font-weight: bold;'>Gender:</label>
        <select class='form-control' name='gender'>
            <?php
            $genResult = $conn->query("SELECT * FROM gender");
            while ($genRow = $genResult->fetch_assoc()) {
            ?>
                <option value="<?= $genRow['id'] ?>"><?= $genRow['name'] ?></option>
            <?php
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="permtion" style='font-weight: bold;'>Permtion:</label>
        <select class='form-control' name='permtion'>
            <?php
            $prmResult = $conn->query("SELECT * FROM permtion");
            while ($prmRow = $prmResult->fetch_assoc()) {
            ?>
                <option value="<?= $prmRow['id'] ?>"><?= $prmRow['name'] ?></option>
            <?php
            }
            ?>
        </select>
    </div>
    <button type='submit' value="Add Product" class="btn btn-success">Add</button>
</form>
<?php
unset($_SESSION['errors']);
?>