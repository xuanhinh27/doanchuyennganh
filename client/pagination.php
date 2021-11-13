<?php
include '../config/action.php';

?>


<div class="store-filter clearfix">
    <span class="store-qty">Hiển thị <?= $item_per_page ?> - <?= $totalRecords?> sản phẩm</span>
    <ul class="store-pagination">
        <li><a href="?back_page" ><i class="fa fa-angle-left"></i></a></li>
        <?php for ($num = 1; $num <= $totalPages; $num++) {
            if ($num != $current_page) {
                if ($num > $current_page - 4 && $num < $current_page + 4) { ?>
                    <li class="active"> <a style="color: white" href="?per_page=<?= $item_per_page ?>&page=<?= $num ?>"><?= $num ?></a>
                </li>
            <?php } } else { ?>
                <li class=""><?= $num ?></li>
            <?php }
        } ?>

        <li><a href="?up_page"><i class="fa fa-angle-right"></i></a></li>

    </ul>
</div>
