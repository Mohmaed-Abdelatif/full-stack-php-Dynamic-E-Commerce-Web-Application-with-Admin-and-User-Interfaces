<div class="col-lg-3 order-2 order-lg-1">
    <h5 class="text-uppercase mb-4">categories</h5>

    <ul class="list-unstyled small text-muted pl-lg-4 font-weight-normal">
        <?php
        $result = $conn->query("SELECT * FROM categories");
        ?>
        <li class="mb-2"><a class="reset-anchor" href="?">All</a></li>
        <hr/>
        <?php
        while ($row = $result->fetch_assoc()) {
        ?>
            <!-- <div class="py-2 px-4 bg-dark text-white mb-3"><strong class="small text-uppercase font-weight-bold">Fashion &amp; Acc</strong></div> -->
            <li class="mb-2"><a class="reset-anchor" href="?cat=<?= $row['id'] ?>"><?= $row['name'] ?></a></li>
        <?php
        }
        ?>
    </ul>

    
</div>