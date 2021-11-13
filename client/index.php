<?php include '../config/action.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
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


    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
            integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
            integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
            crossorigin="anonymous"></script>
</head>
<body>


<!-- HEADER -->
<?php include 'header.php' ?>

<!-- SECTION -->


<div class="section">
    <!-- container -->
    <div class="container">
        <?php
        $result = $conn->query("SELECT image_slider FROM slide");
        ?>
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">

            <ol class="carousel-indicators">
                <?php $i = 0;
                foreach ($result
                         as $row) {
                    $actives = '';
                    if ($i == 0) {
                        $actives = 'active';
                    }
                    ?>
                    <li data-target="#carouselExampleIndicators" data-slide-to="<?= $i ?>" class="<?= $actives ?>"></li>
                    <?php $i++;
                } ?>
            </ol>

            <div class="carousel-inner">
                <?php $i = 0;
                foreach ($result

                         as $row) {
                    $actives = '';
                    if ($i == 0) {
                        $actives = 'active';
                    }
                    ?>
                    <div class="carousel-item <?= $actives ?>" style="height: 300px">
                        <img class="d-block w-100" src="<?= $row['image_slider'] ?>"
                             alt="First slide">
                    </div>
                    <?php $i++;
                } ?>

            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>


        <!-- row -->
        <div class="row">
            <!-- shop -->
            <?php $query4 = 'SELECT * FROM brand';
            $stmt4 = $conn->prepare($query4);
            $stmt4->execute();
            $result4 = $stmt4->get_result();
            ?>
            <?php while ($row4 = $result4->fetch_assoc()) { ?>

                <div class="col-md-4 col-xs-6">
                    <div class="shop">
                        <div class="shop-img">
                            <img src="<?= $row4['image_brand'] ?>" alt="" height="250">
                        </div>

                        <div class="shop-body">
                            <h3><?= $row4['name_brand'] ?></h3>
                            <a href="../client/store.php?detailsBrand=<?= $row4['id_brand']; ?>" class="cta-btn">Shop
                                now<i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                </div>
            <?php } ?>


            <!-- /shop -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->

<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">

            <!-- section title -->
            <div class="col-md-12">
                <div class="section-title">
                    <h3 class="title">Sản Phẩm Mới</h3>
                </div>
            </div>
            <!-- /section title -->

            <!-- Products tab & slick -->
            <div class="col-md-12">
                <div class="row">
                    <div class="products-tabs">
                        <!-- tab -->
                        <div id="tab1" class="tab-pane active">
                            <div class="products-slick" data-nav="#slick-nav-1">

                                <?php

                                $query = "SELECT * FROM products 
                                            inner join brand on products.id_brand = brand.id_brand
                                            inner join productstatus on products.id_productStatus = productstatus.id_productStatus where type_productName like '%mới%'";
                                $stmt = $conn->prepare($query);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                ?>

                                <?php while ($row = $result->fetch_assoc()) { ?>
                                    <!-- product -->
                                    <div class="product">


                                            <div class="product-img">
                                            <img src="<?= $row['image_product1'] ?>" name="" alt="" height="250">
                                            <div class="product-label">
                                                <span class="new"><?= $row['type_productName'] ?></span>
                                            </div>
                                        </div>
                                        <div class="product-body">
                                            <p class="product-category"><?= $row['type_productName'] ?></p>
                                            <h3 class="product-name"><a
                                                        href="../client/detailProduct.php?detailProduct=<?= $row['id_product']; ?>"><?= $row['name_product'] ?></a>
                                            </h3>
                                            <h4 class="product-price"><?= number_format($row['sale']) ?>
                                                <del class="product-old-price"><?= number_format($row['price']) ?></del>
                                            </h4>
                                            <div class="product-rating">

                                            </div>
                                            <div class="product-btns">
                                                <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span
                                                            class="tooltipp">Yêu THích</span></button>
                                                <i class="fa fa-eye" aria-hidden="true"></i> <?= $row['countView'] ?>

                                            </div>

                                        </div>
                                        <div class="add-to-cart">
                                            <a href="../client/detailProduct.php?detailProduct=<?= $row['id_product']; ?>"><button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i>Mua Ngay</button></a>
                                        </div>
                                    </div>

                                <?php } ?>

                                <!-- /product -->
                            </div>
                            <div id="slick-nav-1" class="products-slick-nav"></div>
                        </div>
                        <!-- /tab -->
                    </div>
                </div>
            </div>
            <!-- Products tab & slick -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->

<!-- HOT DEAL SECTION -->
<div id="hot-deal" class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <div class="hot-deal">
                    <ul class="hot-deal-countdown">
                        <li>
                            <div>
                                <h3>02</h3>
                                <span>Days</span>
                            </div>
                        </li>
                        <li>
                            <div>
                                <h3>10</h3>
                                <span>Hours</span>
                            </div>
                        </li>
                        <li>
                            <div>
                                <h3>34</h3>
                                <span>Mins</span>
                            </div>
                        </li>
                        <li>
                            <div>
                                <h3>60</h3>
                                <span>Secs</span>
                            </div>
                        </li>
                    </ul>
                    <h2 class="text-uppercase">hot deal this week</h2>
                    <p>New Collection Up to 50% OFF</p>
                    <a class="primary-btn cta-btn" href="#">Shop now</a>
                </div>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /HOT DEAL SECTION -->

<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">

            <!-- section title -->
            <div class="col-md-12">
                <div class="section-title">
                    <h3 class="title">Top Giảm Giá</h3>

                </div>
            </div>
            <!-- /section title -->

            <!-- Products tab & slick -->
            <div class="col-md-12">
                <div class="row">
                    <div class="products-tabs">
                        <!-- tab -->
                        <div id="tab2" class="tab-pane fade in active">
                            <div class="products-slick" data-nav="#slick-nav-2">

                                <?php

                                $query = "SELECT * FROM products 
                                            inner join brand on products.id_brand = brand.id_brand
                                            inner join productstatus on products.id_productStatus = productstatus.id_productStatus where type_productName like '%giảm%'";
                                $stmt = $conn->prepare($query);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                ?>

                                <?php while ($row = $result->fetch_assoc()) { ?>
                                    <!-- product -->
                                    <div class="product">


                                        <div class="product-img">
                                            <img src="<?= $row['image_product1'] ?>" alt="" height="250">
                                            <div class="product-label">
                                                <span class="sale"><?= $row['type_productName'] ?></span>
                                            </div>
                                        </div>
                                        <div class="product-body">
                                            <p class="product-category"><?= $row['type_productName']; ?> </p>
                                            <h3 class="product-name"><a
                                                        href="../client/detailProduct.php?detailProduct=<?= $row['id_product']; ?>"><?= $row['name_product'] ?></a>
                                            </h3>
                                            <h4 class="product-price"><?= number_format($row['sale']) ?>
                                                <del class="product-old-price"><?= number_format($row['price']) ?></del>
                                            </h4>
                                            <div class="product-rating">

                                            </div>
                                            <div class="product-btns">
                                                <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span
                                                            class="tooltipp">Yêu THích</span></button>
                                                <i class="fa fa-eye" aria-hidden="true"></i> <?= $row['countView'] ?>

                                            </div>

                                        </div>
                                        <div class="add-to-cart">
                                            <a href="../client/detailProduct.php?detailProduct=<?= $row['id_product']; ?>"><button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i>Mua Ngay</button></a>
                                        </div>
                                    </div>
                                <?php } ?>
                                <!-- /product -->
                            </div>
                            <div id="slick-nav-2" class="products-slick-nav"></div>
                        </div>
                        <!-- /tab -->
                    </div>
                </div>
            </div>
            <!-- /Products tab & slick -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->

<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-4 col-xs-6">
                <div class="section-title">
                    <h4 class="title">Top giảm giá</h4>
                    <div class="section-nav">
                        <div id="slick-nav-3" class="products-slick-nav"></div>
                    </div>
                </div>

                <div class="products-widget-slick" data-nav="#slick-nav-3">
                    <div>
                        <?php

                        $query = "SELECT * FROM products 
                                            inner join brand on products.id_brand = brand.id_brand
                                            inner join productstatus on products.id_productStatus = productstatus.id_productStatus where type_productName like '%giảm%'";
                        $stmt = $conn->prepare($query);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        ?>
                        <!-- product widget -->
                        <?php while ($row = $result->fetch_assoc()) { ?>

                        <div class="product-widget">
                            <div class="product-img">
                                <img src="<?= $row['image_product1'] ?>" alt="" height="50">
                                <div class="product-label">
                                    <span class="new"></span>
                                </div>
                            </div>
                            <div class="product-body">
                                <p class="product-category"><?= $row['type_productName']; ?></p>
                                <h3 class="product-name"><a
                                            href="../client/detailProduct.php?detailProduct=<?= $row['id_product']; ?>"><?= $row['name_product'] ?></a></h3>
                                <h4 class="product-price"><?= number_format($row['sale']) ?>
                                    <del class="product-old-price"><?= number_format($row['price']) ?></del>
                                </h4>
                            </div>
                        </div>
                        <?php } ?>

                        <!-- /product widget -->

                    </div>
                </div>
            </div>

            <div class="col-md-4 col-xs-6">
                <?php

                $query = "SELECT * FROM products 
                                            inner join brand on products.id_brand = brand.id_brand
                                            inner join productstatus on products.id_productStatus = productstatus.id_productStatus where type_productName like '%yêu%'";
                $stmt = $conn->prepare($query);
                $stmt->execute();
                $result = $stmt->get_result();
                ?>
                <div class="section-title">
                    <h4 class="title">Top Yêu Thích</h4>
                    <div class="section-nav">
                        <div id="slick-nav-4" class="products-slick-nav"></div>
                    </div>
                </div>

                <div class="products-widget-slick" data-nav="#slick-nav-4">
                    <div>
                        <!-- product widget -->
                        <?php while ($row = $result->fetch_assoc()) { ?>

                        <div class="product-widget">
                            <div class="product-img">
                                <img src="<?= $row['image_product1'] ?>" alt="" height="50">
                            </div>
                            <div class="product-body">
                                <p class="product-category"><?= $row['type_productName']; ?></p>
                                <h3 class="product-name"><a
                                            href="../client/detailProduct.php?detailProduct=<?= $row['id_product']; ?>"><?= $row['name_product'] ?></a></h3>
                                <h4 class="product-price"><?= number_format($row['sale']) ?>
                                    <del class="product-old-price"><?= number_format($row['price']) ?></del>
                                </h4>
                            </div>
                        </div>
                        <?php } ?>
                        <!-- /product widget -->


                    </div>
                </div>
            </div>

            <div class="clearfix visible-sm visible-xs"></div>
            <?php

            $query = "SELECT * FROM products 
                                            inner join brand on products.id_brand = brand.id_brand
                                            inner join productstatus on products.id_productStatus = productstatus.id_productStatus order by countView desc limit 5";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $result = $stmt->get_result();
            ?>
            <div class="col-md-4 col-xs-6">
                <div class="section-title">
                    <h4 class="title">Sản Phẩm Quan Tâm</h4>
                    <div class="section-nav">
                        <div id="slick-nav-5" class="products-slick-nav"></div>
                    </div>
                </div>

                <div class="products-widget-slick" data-nav="#slick-nav-5">
                    <div>
                        <!-- product widget -->
                        <?php while ($row = $result->fetch_assoc()) { ?>

                        <div class="product-widget">
                            <div class="product-img">
                                <img src="<?= $row['image_product1'] ?>" alt="" height="50">
                            </div>
                            <div class="product-body">
                                <p class="product-category"><?= $row['type_productName']; ?></p>
                                <h3 class="product-name"><a
                                            href="../client/detailProduct.php?detailProduct=<?= $row['id_product']; ?>"><?= $row['name_product'] ?></a></h3>
                                <h4 class="product-price"><?= number_format($row['sale']) ?>
                                    <del class="product-old-price"><?= number_format($row['price']) ?></del>
                                </h4>
                            </div>
                        </div>
                        <?php } ?>
                        <!-- /product widget -->


                    </div>
                </div>
            </div>

        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->


<!-- FOOTER -->
<?php include 'footer.php' ?>


<!-- jQuery Plugins -->
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/slick.min.js"></script>
<script src="../js/nouislider.min.js"></script>
<script src="../js/jquery.zoom.min.js"></script>
<script src="../js/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

</body>
</html>
