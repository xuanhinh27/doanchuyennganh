<?php
include '../config/action.php';

$total = 0;
foreach ($_SESSION['cart'] as $k => $name) {
    echo "chỉ số $k; giá trị $name[qtyProduct] " . "$name[sizeProduct] " . "$name[totalProduct] " . "<br>";

    $total = $total + $name['totalProduct'];

}


$_SESSION["cart"] = $total;
echo $total;



?>

