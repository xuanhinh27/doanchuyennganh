<?php include '../config/action.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>Electro - HTML Ecommerce Template</title>

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="../css/bootstrap.min.css"/>

    <!-- Slick -->
    <link type="text/css" rel="stylesheet" href="../css/slick.css"/>
    <link type="text/css" rel="stylesheet" href="../css/slick-theme.css"/>

    <!-- nouislider -->
    <link type="text/css" rel="stylesheet" href="../css/nouislider.min.css"/>

    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="../css/font-awesome.min.css">

    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="../css/style.css"/>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>
<!-- HEADER -->

<?php include 'header.php' ?>


<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- ASIDE -->
            <div id="aside" class="col-md-3">
                <!-- aside Widget -->
                <div class="aside">
                    <h3 class="aside-title">LỌC THEO TRẠNG THÁI</h3>
                    <div class="checkbox-filter">

                        <div class="input-checkbox">
                            <label for="category-1">
                                <span></span>
                                <i class="fa fa-check" aria-hidden="true"></i>

                                <a href="../client/store.php"> Tất Cả Sản Phẩm</a>
                                <small>(<?= "$rowCountProduct[0]"; ?>)</small>
                            </label>
                        </div>
                        <?php

                        $queryProductStatus = "SELECT * FROM productstatus";
                        $stmtProductStatus = $conn->prepare($queryProductStatus);
                        $stmtProductStatus->execute();
                        $resultProductStatus = $stmtProductStatus->get_result();
                        ?>
                        <form action="" method="post">
                            <?php while ($rowProductStatus = $resultProductStatus->fetch_assoc()) { ?>

                                <div class="input-checkbox">

                                    <label for="<?= $rowProductStatus['id_productStatus'] ?>">
                                        <span></span>
                                        <i class="fa fa-check" aria-hidden="true"></i>

                                        <a href="../client/store.php?detailsProductStatus=<?= $rowProductStatus['id_productStatus']; ?>"
                                           value="<?= $rowProductStatus['id_productStatus']; ?>"
                                           name="testdd24">  <?= $rowProductStatus['type_productName'];?> </a>
                                    </label>


                                </div>
                            <?php } ?>
                        </form>
                    </div>

                </div>
                <!-- /aside Widget -->

                <!-- aside Widget -->
                <div class="aside">
                    <h3 class="aside-title">LỌC GIÁ SẢN PHẨM</h3>
                    <div class="price-filter">
                        <div id="price-slider"></div>
                        <form action="" method="post">
                            <div class="input-number">
                                <input id="price-min" type="number" name="findByPriceMin">
                                <span class="qty-up">+</span>
                                <span class="qty-down">-</span>
                            </div>
                            <span>-</span>
                            <div class="input-number">
                                <input id="price-max" type="number" name="findByPriceMax">
                                <span class="qty-up">+</span>
                                <span class="qty-down">-</span>
                            </div>
                            <div style="padding-top: 10px"><input type="submit" name="submitFindPrice" class="btn btn-danger"></div>

                        </form>
                    </div>
                </div>
                <!-- /aside Widget -->

                <!-- aside Widget -->
                <div class="aside">
                    <h3 class="aside-title">HÃNG</h3>
                    <div class="checkbox-filter">
                        <div class="input-checkbox">
                            <label for="brand-1">
                                <span></span>
                                <i class="fa fa-check" aria-hidden="true"></i>
                                <a href="../client/store.php"> Tất Cả Sản Phẩm</a>
                                <small>(578)</small>
                            </label>
                        </div>
                        <?php $queryBrand = 'SELECT * FROM brand';
                        $stmtBrand = $conn->prepare($queryBrand);
                        $stmtBrand->execute();
                        $resultBrand = $stmtBrand->get_result();
                        ?>
                        <?php while ($rowBrand = $resultBrand->fetch_assoc()) { ?>
                            <div class="input-checkbox">
                                <label for="<?= $rowBrand['id_brand']; ?>">
                                    <span></span>
                                    <i class="fa fa-check" aria-hidden="true"></i>
                                    <a href="../client/store.php?detailsBrand=<?= $rowBrand['id_brand']; ?>"> <?= $rowBrand['name_brand'] ?></a>
                                    <small>(125)</small>
                                </label>
                            </div>
                        <?php } ?>

                    </div>
                </div>
                <!-- /aside Widget -->

                <!-- aside Widget -->
                <div class="aside">
                    <h3 class="aside-title">TOP GIẢM GIÁ</h3>
                    <div class="product-widget">
                        <?php
                        $queryProduct = "SELECT * FROM products 
                                            inner join brand on products.id_brand = brand.id_brand
                                            inner join productstatus on products.id_productStatus = productstatus.id_productStatus where type_productName like '%giảm%'";
                        $stmtProduct = $conn->prepare($queryProduct);
                        $stmtProduct->execute();
                        $resultProduct = $stmtProduct->get_result();
                        ?>


                        <?php while ($rowProduct = $resultProduct->fetch_assoc()) { ?>

                            <div class="product-widget">
                                <div class="product-img">
                                    <img src="<?= $rowProduct['image_product1'] ?>" alt="" height="50">
                                </div>
                                <div class="product-body">
                                    <p class="product-category"><?= $rowProduct['type_productName'] ?></p>
                                    <h3 class="product-name"><a
                                            href="../client/detailProduct.php?detailProduct=<?= $rowProduct['id_product']; ?>"><?= $rowProduct['name_product'] ?></a>
                                    </h3>
                                    <h4 class="product-price"><?= number_format($rowProduct['sale']) ?>
                                        <del class="product-old-price"><?= number_format($rowProduct['price']) ?></del>
                                    </h4>
                                </div>
                            </div>
                        <?php } ?>

                    </div>


                </div>
                <!-- /aside Widget -->
            </div>
            <!-- /ASIDE -->

            <!-- STORE -->
            <div id="store" class="col-md-9">
                <!-- store top filter -->
                <div class="store-filter clearfix">
                    <div class="store-sort">
                        <form action="" method="post">

                        <label>
                            Sắp Xếp:
                            <select class="input-select" name="clickPro">
                                <option name="findPrice" value="desc">Giá Cao</option>
                                <option name="findPrice" value="asc">Giá Thấp</option>
                            </select>
                            <button class="btn btn-danger" name="findPrice">Lọc</button>
                        </label>
                        <label>
                        </form>

                        Hiển Thị:
                            <select class="input-select">
                                <option value="0">20</option>
                                <option value="1">50</option>
                            </select>
                        </label>
                    </div>
                    <ul class="store-grid">
                        <li class="active"><i class="fa fa-th"></i></li>
                        <li><a href="#"><i class="fa fa-th-list"></i></a></li>
                    </ul>
                </div>
                <!-- /store top filter -->

                <!-- store products -->

                <div class="row">
                    <!-- product -->


                    <?php
                    $valueSearch = $_SESSION['valueSearch'];
                        $query = "SELECT * FROM products inner join brand on products.id_brand = brand.id_brand
                            inner join productstatus on products.id_productStatus = productstatus.id_productStatus
                    WHERE name_product like '%$valueSearch%' or name_brand like '%$valueSearch%' or type_productName like '%$valueSearch%' order by sale $giatri ";
                        $stmt = $conn->prepare($query);
                        $stmt->execute();
                        $result = $stmt->get_result();

                    while ($row = $result->fetch_assoc()) { ?>


                        <div class="col-md-4 col-xs-6">
                            <div class="product">
                                <div class="product-img">
                                    <img src="<?= $row['image_product1'] ?>" alt="" height="250">
                                    <div class="product-label">
                                        <span class="new"><?= $row['type_productName'] ?></span>
                                    </div>
                                </div>
                                <div class="product-body">
                                    <p class="product-category"><?= $row['type_productName']; ?></p>
                                    <p class="product-category"><?= $row['name_brand'] ?></p>
                                    <h3 class="product-name"><a
                                            href="../client/detailProduct.php?detailProduct=<?= $row['id_product']; ?>"><?= $row['name_product'] ?></a>
                                    </h3>
                                    <h4 class="product-price"><?= number_format($row['price']) ?>
                                        <del class="product-old-price"><?= number_format($row['sale']) ?></del>
                                    </h4>
                                    <div class="product-rating">
                                    </div>
                                    <div class="product-btns">
                                        <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span
                                                class="tooltipp">Yêu Thích</span></button>
                                        <i class="fa fa-eye" aria-hidden="true"></i> <?= $row['countView'] ?>

                                    </div>
                                </div>
                                <div class="add-to-cart">
                                    <a href="../client/detailProduct.php?detailProduct=<?= $row['id_product']; ?>"><button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i>Mua Ngay</button></a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <!-- /product -->
                </div>
            </div>
            <!-- /store products -->

            <!-- store bottom filter -->
            <?php include "../client/pagination.php" ?>

            <!-- /store bottom filter -->
        </div>
        <!-- /STORE -->
    </div>
    <!-- /row -->
</div>
<!-- /container -->
</div>
<!-- /SECTION -->
<!-- Section -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <?php

            $queryCare = "SELECT * FROM products 
                                            inner join brand on products.id_brand = brand.id_brand
                                            inner join productstatus on products.id_productStatus = productstatus.id_productStatus order by countView desc limit 7";
            $stmtCare = $conn->prepare($queryCare);
            $stmtCare->execute();
            $resultCare = $stmtCare->get_result();
            ?>
            <div class="col-md-12">
                <div class="section-title text-center">
                    <h3 class="title">SẢN PHẨM QUAN TÂM</h3>
                </div>
            </div>
            <?php while ($rowCare = $resultCare->fetch_assoc()) { ?>
                <!-- product -->
                <div class="col-md-3 col-xs-6">
                    <div class="product">
                        <div class="product-img">

                            <img src="<?= $rowCare['image_product1'] ?>" alt="" height="250">
                            <div class="product-label">
                                <span class="sale">-30%</span>
                            </div>
                        </div>
                        <div class="product-body">
                            <p class="product-category"><?= $rowCare['type_productName']; ?></p>
                            <h3 class="product-name"><a
                                    href="../client/detailProduct.php?detailProduct=<?= $rowCare['id_product']; ?>"><?= $rowCare['name_product'] ?></a></h3>
                            <h4 class="product-price"><?= number_format($rowCare['sale']); ?>
                                <del class="product-old-price"><?= number_format($rowCare['price']); ?></del>
                            </h4>
                            <div class="product-rating">
                            </div>
                            <div class="product-btns">
                                <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span
                                        class="tooltipp">Yêu Thích</span></button>
                                <i class="fa fa-eye" aria-hidden="true"></i> <?= $rowCare['countView'] ?>
                                <div class="add-to-cart">
                                    <a href="../client/detailProduct.php?detailProduct=<?= $rowCare['id_product']; ?>"><button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i>Mua Ngay</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <!-- /product -->



        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /Section -->

<?php include 'footer.php' ?>

<!-- jQuery Plugins -->
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/slick.min.js"></script>
<script src="../js/nouislider.min.js"></script>
<script src="../js/jquery.zoom.min.js"></script>
<script src="../js/main.js"></script>

</body>
</html>
