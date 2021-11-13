<?php
include '../config/action.php';
?>
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



    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>


</head>
<body>


<!-- /TOP HEADER -->

<?php include 'header.php' ?>

<!-- /HEADER -->


<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div id="ServDtlIndustries_slider" class="syncing_slider_wrap">

            <!-- Product main img -->
            <div class="col-md-7">
                <div id="product-main-img">
                    <div class="slider slider-single">
                        <div class="slider_show">
                            <div class="product-preview">
                                <img src="<?= $row['image_product1'] ?>" alt=""  height="500" >
                            </div>

                        </div>
                        <div class="slider_show">
                            <div class="product-preview">
                                <img src="<?= $row['image_product2'] ?>" alt=""  height="500" >
                            </div>
                        </div>
                        <div class="slider_show">
                            <div class="product-preview">
                                <img src="<?= $row['image_product3'] ?>" alt=""  height="500" >
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row" style="padding-top: 10px">
                <div class="col-md-12">
                    <!-- Product thumb imgs -->
                    <div class="slider-nav">
                        <div class="product-preview">
                            <img src="<?= $row['image_product1'] ?>" alt=""  height="120" >
                        </div>


                        <div class="product-preview">
                            <img src="<?= $row['image_product2'] ?>" alt=""  height="120" >
                        </div>



                        <div class="product-preview">
                            <img src="<?= $row['image_product3'] ?>" alt=""  height="120" >
                        </div>

                        <div class="product-preview">
                            <img src="<?= $row['image_product1'] ?>" alt=""  height="120" >
                        </div>


                        <div class="product-preview">
                            <img src="<?= $row['image_product2'] ?>" alt=""  height="120" >
                        </div>



                        <div class="product-preview">
                            <img src="<?= $row['image_product3'] ?>" alt=""  height="120" >
                        </div>

                    </div>

                    <!-- /Product thumb imgs -->
                </div></div>

            </div>


            <!-- /Product main img -->

            </div>




            <!-- Product details -->
            <div class="col-md-5">
                <form action="" method="post">
                    <div class="product-details">
                        <h2 class="product-name"><?= $row['name_product'] ?></h2>
                        <div>
                            <div class="product-rating">

                            </div>
                        </div>
                        <div>

                            <input name="idProduct" value="<?= $row['id_product'] ?>" hidden>
                            <input name="sale" value="<?= $row['sale'] ?>" hidden>


                            <h3 class="product-price" name="sale"
                                value="<?= $row['sale'] ?>"><?= number_format($row['sale']) ?>
                                <del class="product-old-price"><?= number_format($row['price']) ?></del>
                            </h3>
                            <span class="product-available"><?php if ($row['amountProduct'] < 1) {
                                    echo "Đã Hết Hàng";
                                } else {
                                    echo "Còn Lại: " . $row['amountProduct'] . " Sản Phẩm";
                                } ?></span>
                        </div>
                        <p><?= $row['des'] ?></p>


                        <?php $querySizeProduct = 'SELECT * FROM sizeProduct';
                        $stmtSizeProduct = $conn->prepare($querySizeProduct);
                        $stmtSizeProduct->execute();
                        $resultSizeProduct = $stmtSizeProduct->get_result();
                        ?>
                        <div class="product-options">
                            <label>
                                Loại Máy
                                <select class="input-select" name="sizeProduct">
                                    <?php while ($rowSizeProduct = $resultSizeProduct->fetch_assoc()) { ?>
                                        <option value="<?= $rowSizeProduct['id_sizeProduct'] ?>"><?php echo $rowSizeProduct['name_sizeProduct'] ?></option>
                                    <?php } ?>

                                </select>
                            </label>

                            <?php $queryColorProduct = 'SELECT * FROM colorProduct';
                            $stmtColorProduct = $conn->prepare($queryColorProduct);
                            $stmtColorProduct->execute();
                            $resultColorProduct = $stmtColorProduct->get_result();
                            ?>
                            <label>
                                Màu Sắc
                                <select class="input-select" name="colorProduct">
                                    <?php while ($rowColorProduct = $resultColorProduct->fetch_assoc()) { ?>
                                        <option value="<?= $rowColorProduct['id_colorProduct'] ?>"><?php echo $rowColorProduct['name_colorProduct'] ?></option>
                                    <?php } ?>

                                </select>
                            </label>
                        </div>

                        <div class="add-to-cart">
                            <div class="qty-label">
                                Số Lượng
                                <div class="input-number">
                                    <input type="number" value="0" name="qtyProduct" min="1" max="100">
                                    <span class="qty-up">+</span>
                                    <span class="qty-down">-</span>
                                </div>
                            </div>

                            <button class="add-to-cart-btn" name="addCart"><i class="fa fa-shopping-cart"></i>Thêm Vào
                                Giỏ
                            </button>

                </form>
            </div>
        </div>
    </div>

    <!-- /Product details -->

    <!-- Product tab -->
    <div class="col-md-12">
        <div id="product-tab">
            <!-- product tab nav -->
            <ul class="tab-nav">
                <li class="active"><a data-toggle="tab" href="#tab1">Chi Tiết Sản Phẩm</a></li>
            </ul>
            <!-- /product tab nav -->

            <!-- product tab content -->
            <div class="tab-content">
                <!-- tab1  -->
                <div id="tab1" class="tab-pane fade in active">
                    <div class="row">
                        <div class="col-md-12">
                            <p><?= $row['detail'] ?></p>
                        </div>
                    </div>
                    <!-- tab3  -->
                    <div id="tab3" class="tab-pane fade in">
                        <div class="row">
                            <!-- Rating -->
                            <div class="col-md-3">
                                <div id="rating">
                                    <div class="rating-avg">
                                        <span>4.5</span>
                                        <div class="rating-stars">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-o"></i>
                                        </div>
                                    </div>
                                    <ul class="rating">
                                        <li>
                                            <div class="rating-stars">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                            <div class="rating-progress">
                                                <div style="width: 80%;"></div>
                                            </div>
                                            <span class="sum">3</span>
                                        </li>
                                        <li>
                                            <div class="rating-stars">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-o"></i>
                                            </div>
                                            <div class="rating-progress">
                                                <div style="width: 60%;"></div>
                                            </div>
                                            <span class="sum">2</span>
                                        </li>
                                        <li>
                                            <div class="rating-stars">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                            </div>
                                            <div class="rating-progress">
                                                <div></div>
                                            </div>
                                            <span class="sum">0</span>
                                        </li>
                                        <li>
                                            <div class="rating-stars">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                            </div>
                                            <div class="rating-progress">
                                                <div></div>
                                            </div>
                                            <span class="sum">0</span>
                                        </li>
                                        <li>
                                            <div class="rating-stars">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                            </div>
                                            <div class="rating-progress">
                                                <div></div>
                                            </div>
                                            <span class="sum">0</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- /Rating -->

                            <!-- Reviews -->
                            <div class="col-md-8">
                                <div id="reviews">
                                    <ul class="reviews">
                                        <div class="panel panel-info">
                                            <div class="panel-body">
                                                <form class="form-inline" method="post" action="">
                                                        <textarea placeholder="Viết Nhận Xét Ở đây!" name="commentContent"
                                                                  class="pb-cmnt-textarea"
                                                                 required><?php echo $commentContent ?></textarea>

                                                    <div class="btn-group" style="padding-top: 10px">


                                                        <?php if (empty($_SESSION['loged'])) { ?>
                                                            <span class="product-available text-danger">Cần Đăng Nhập Để Comment</span>

                                                        <?php } else {
                                                            ?>
                                                          <?php if ($update_comment == true) { ?>
                                                                <input type="text" name="id_comment"
                                                                       value="<?= $rowComment['id_comment'] ?>" hidden>
                                                              <button class="btn btn-success pull-right"
                                                                      name="updateSubmit" type="submit">Xác Nhận Chỉnh Sửa
                                                              </button>
                                                        <?php } else { ?>
                                                              <button class="btn btn-danger pull-right"
                                                                      name="commentSubmit" type="submit">Nhận Xét
                                                              </button>
                                                        <?php }} ?>

                                                    </div>
                                                </form>
                                            </div>
                                        </div>


                                        <?php while ($rowComment = $resultComment->fetch_assoc()) { ?>
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <form action="" method="post">
                                                        <div class="col-md-2">
                                                            <img src="<?= $rowComment['avatar'] ?>"
                                                                 class="img img-rounded img-fluid" width="80"
                                                                 height="80"/>
                                                            <p class="text-secondary text-center"><?= $rowComment['cur_date'] ?></p>
                                                        </div>
                                                        <div class="col-md-10">
                                                            <p>
                                                                <a class="float-left"
                                                                   href="https://maniruzzaman-akash.blogspot.com/p/contact.html"><strong><?= $rowComment['name'] ?></strong></a>
                                                                <span class="float-right"><i
                                                                            class="text-warning fa fa-star"></i><?= $rowComment['type_user'] ?><i


                                                            </p>
                                                            <div class="clearfix"></div>
                                                            <p><?= $rowComment['content'] ?></p>

                                                            <p>

                                                                <input type="text" name="id_comment"
                                                                       value="<?= $rowComment['id_comment'] ?>" hidden>

                                                                <?php if ($_SESSION['id_user'] == $rowComment['id_user']) { ?>
                                                                    <button name="deleteComment" class="btn btn-warning"
                                                                            onclick="return confirm('Bạn Chắc Chắn Muốn Xóa Comment Này?');">
                                                                        Xóa
                                                                    </button>
                                                                    <button name="editComment" class="btn btn-success">
                                                                        Sửa
                                                                    </button>
                                                                <?php }
                                                                if (empty($_SESSION['loged'])) { ?>
                                                                    <span class="product-available text-danger">Cần Đăng Nhập Để Like</span>
                                                                <?php }
                                                                else { ?>

                                                                    <a class="float-right btn text-white btn-danger"> <i
                                                                                class="fa fa-heart"></i> Thích</a>
                                                                    <?php
                                                                }
                                                                ?>

                                                            </p>


                                                        </div>
                                                    </form>
                                                </div>


                                                <?php } ?>
                                    </ul>
                                    <ul class="reviews-pagination">
                                        <li class="active">1</li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li><a href="#">4</a></li>
                                        <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- /Reviews -->

                        </div>
                    </div>
                    <!-- /tab3  -->

                </div>
                <!-- /tab1  -->



            </div>
            <!-- /product tab content  -->
        </div>
    </div>
    <!-- /product tab -->
</div>
<!-- /row -->
</div>
<!-- /container -->
</div
<!-- /SECTION -->

<!-- Section -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">

            <div class="col-md-12">
                <div class="section-title text-center">
                    <h3 class="title">SẢN PHẨM LIÊN QUAN</h3>
                </div>
            </div>


            <?php

            $query = "SELECT * FROM products 
                                            inner join brand on products.id_brand = brand.id_brand
                                            inner join productstatus on products.id_productStatus = productstatus.id_productStatus where products.id_brand=$row[id_brand] and id_product!=$row[id_product]";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $result = $stmt->get_result();
            ?>
            <?php while ($row = $result->fetch_assoc()) { ?>

                <!-- product -->
                <div class="col-md-3 col-xs-6">
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
                                        href="../client/detailProduct.php?detailProduct=<?= $row['id_product']; ?>"><?= $row['name_product']; ?> </a>
                            </h3>
                            <h4 class="product-price"><?= number_format($row['sale']) ?>
                                <del class="product-old-price"><?= number_format($row['price']) ?></del>
                            </h4>
                            <div class="product-rating">
                            </div>
                            <div class="product-btns">
                                <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span>
                                </button>

                            </div>

                        </div>

                        <div class="add-to-cart">
                            <a href="../client/detailProduct.php?detailProduct=<?= $row['id_product']; ?>">
                                <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i>Mua Ngay</button>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /product -->
            <?php } ?>


        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /Section -->


<?php include 'footer.php' ?>

<style> .pb-cmnt-container {
        font-family: Lato;
        margin-top: 100px;
    }

    .pb-cmnt-textarea {
        resize: none;
        padding: 20px;
        height: 130px;
        width: 100%;
        border: 1px solid #a3231f;
    }</style>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
<!-- jQuery Plugins -->
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/slick.min.js"></script>
<script src="../js/nouislider.min.js"></script>
<script src="../js/jquery.zoom.min.js"></script>
<script src="../js/main.js"></script>

<script>
    $('#ServDtlIndustries_slider .slider-single').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: false,
        asNavFor: '#ServDtlIndustries_slider .slider-nav',
        speed: 400,
        cssEase: 'cubic-bezier(0.77, 0, 0.18, 1)'
    });

    $('#ServDtlIndustries_slider .slider-nav').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        asNavFor: '#ServDtlIndustries_slider .slider-single',
        dots: false,
        arrows: false,
        centerMode: true,
        speed: 400,
        focusOnSelect: true,
        centerPadding: '0px',
        loop: true,
        autoplay: true,
    });</script>
</body>
</html>
