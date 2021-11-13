<header>
    <!-- TOP HEADER -->
    <div id="top-header">
        <div class="container">

            <?php $querySetting = 'SELECT * FROM infor';
            $stmtSetting = $conn->prepare($querySetting);
            $stmtSetting->execute();
            $resultSetting = $stmtSetting->get_result();
            ?>
            <ul class="header-links pull-left">
                <?php while ($rowSetting = $resultSetting->fetch_assoc()) { ?>
                    <li><a href="#"><i class="fa fa-phone"></i> <?= $rowSetting['infor_phone'] ?></a></li>
                    <li><a href="#"><i class="fa fa-envelope-o"></i><?= $rowSetting['infor_email'] ?></a></li>
                    <li><a href="#"><i class="fa fa-map-marker"></i><?= $rowSetting['infor_address'] ?></a></li>
                <?php } ?>

            </ul>
            <ul class="header-links pull-right">
                <?php if (isset($_SESSION["loged"]) && isset($_SESSION['member'])){ ?>
                <li><a href="../user/"><i class="fa fa-user-o"></i> <?php echo $_SESSION['name'] ?></a>
                <li><a href="../client/logout.php"><i class="fa fa-user-o"></i> Đăng Xuất</a>

                    <?php } elseif (isset($_SESSION["loged"]) && isset($_SESSION['admin'])){
                    ?>

                <li><a href="../admin/index.php"><i class="fa fa-user-o"></i> <?php echo $_SESSION['name'] ?></a>
                <li><a href="../client/logout.php"><i class="fa fa-user-o"></i> Đăng Xuất</a>
                    <?php
                    }


                    else {
                    ?>
                <li><a href="../client/login.php"><i class="fa fa-user-o"></i> Tài Khoản</a>
                    <?php

                    } ?>
                </li>
            </ul>
        </div>
    </div>


    <!-- /TOP HEADER -->

    <!-- MAIN HEADER -->
    <div id="header">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- LOGO -->
                <div class="col-md-3">
                    <div class="header-logo">
                        <?php $querySetting = 'SELECT * FROM infor';
                        $stmtSetting = $conn->prepare($querySetting);
                        $stmtSetting->execute();
                        $resultSetting = $stmtSetting->get_result();
                        ?>
                        <?php while ($rowSetting = $resultSetting->fetch_assoc()) { ?>

                            <a href="../client/" class="logo">
                                <img src="<?= $rowSetting['logo'] ?>" alt="" width="200" height="70">
                            </a>
                        <?php } ?>
                    </div>
                </div>
                <!-- /LOGO -->

                <!-- SEARCH BAR -->
                <div class="col-md-6">
                    <div class="header-search">
                        <form action="" method="post">
                            <select class="input-select">
                                <option value="0">Tất Cả</option>
                            </select>
                            <input class="input" name="searchProduct" placeholder="Nhập Sản Phẩm muốn tìm">
                            <button class="search-btn" type="submit" name="submitSearchProduct">Tìm Kiếm</button>
                        </form>
                    </div>
                </div>
                <!-- /SEARCH BAR -->

                <!-- ACCOUNT -->
                <div class="col-md-3 clearfix">
                    <div class="header-ctn">
                        <!-- Wishlist -->
                        <div>
                            <a href="#">
                                <i class="fa fa-heart-o"></i>
                                <span>Yêu Thích</span>
                                <div class="qty">2</div>
                            </a>
                        </div>
                        <!-- /Wishlist -->


                        <!-- Cart -->
                        <div class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                <i class="fa fa-shopping-cart"></i>
                                <span>Giỏ Hàng</span>
                                <div class="qty">3</div>
                            </a>
                            <div class="cart-dropdown">
                                <?php
                                $total = 0;
                                foreach ($_SESSION['cart'] as $k => $name) {
                                    ?>
                                    <div class="cart-list">
                                        <div class="product-widget">
                                            <div class="product-img">
                                                <img src="<?= $name['image_product1'] ?>" alt="" height="55">
                                            </div>
                                            <div class="product-body">
                                                <h3 class="product-name"><a href="#"><?= $name['name_product'] ?></a>
                                                </h3>
                                                <h4 class="product-price"><span
                                                            class="qty"><?= $name['qtyProduct'] . "x" ?></span><?= number_format($name['sale']) ?>
                                                </h4>
                                                <span class="product-price"><span
                                                            class="qty"><?= "Thành Tiền: " . number_format($name['totalProduct']) ?>
                                                </span>
                                            </div>
                                            <form action="" method="post">
                                                <input name="idProductCart" value="<?= $name['id'] ?>" hidden>
                                                <input name="qtyProductCart" value="<?= $name['qtyProduct'] ?>" hidden>

                                                <button class="delete" name="deleteProductCart"><i
                                                            class="fa fa-close"></i></button>
                                            </form>
                                        </div>

                                    </div>
                                    <?php $total = $total + $name['totalProduct'];
                                    $_SESSION['totalOrder'] = $total;
                                }
                                ?>

                                <div class="cart-summary">
                                    <small><?= "Có " . count($_SESSION['cart']) . " Sản Phẩm Trong Giỏ" ?></small>
                                    <h5><?= "Tổng Tiền: " . number_format($_SESSION['totalOrder'])
                                        ?></h5>
                                </div>
                                <div class="cart-btns">
                                    <a href="#">View Cart</a>
                                    <a href="../client/checkOut.php">Checkout <i
                                                class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <!-- /Cart -->

                        <!-- Menu Toogle -->
                        <div class="menu-toggle">
                            <a href="#">
                                <i class="fa fa-bars"></i>
                                <span>Menu</span>
                            </a>
                        </div>
                        <!-- /Menu Toogle -->
                    </div>
                </div>
                <!-- /ACCOUNT -->
            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </div>
    <!-- /MAIN HEADER -->
</header>
<!-- /HEADER -->
<!-- NAVIGATION -->
<nav id="navigation">
    <!-- container -->
    <div class="container">
        <!-- responsive-nav -->
        <div id="responsive-nav">
            <!-- NAV -->

            <ul class="main-nav nav navbar-nav">
                <li class="active"><a href="../client">Trang Chủ</a></li>
                <?php $query2 = 'SELECT * FROM brand';
                $stmt2 = $conn->prepare($query2);
                $stmt2->execute();
                $result2 = $stmt2->get_result();
                ?>
                <?php while ($row2 = $result2->fetch_assoc()) { ?>
                    <li>
                        <a href="../client/store.php?detailsBrand=<?= $row2['id_brand']; ?>"><?= $row2['name_brand'] ?></a>
                    </li>
                <?php } ?>
                <li><a href="../client/store.php">Tất Cả Sản Phẩm</a></li>
            </ul>

            <!-- /NAV -->
        </div>
        <!-- /responsive-nav -->
    </div>
    <!-- /container -->
</nav>
<!-- /NAVIGATION -->