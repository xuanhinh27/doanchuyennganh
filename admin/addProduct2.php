<?php
include '../config/action.php';


?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>

    <title>Sleek - Admin Dashboard Template</title>

    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500|Poppins:400,500,600,700|Roboto:400,500"
          rel="stylesheet"/>
    <link href="https://cdn.materialdesignicons.com/3.0.39/css/materialdesignicons.min.css" rel="stylesheet"/>

    <!-- PLUGINS CSS STYLE -->


    <link href="assets/plugins/toaster/toastr.min.css" rel="stylesheet"/>
    <link href="assets/plugins/nprogress/nprogress.css" rel="stylesheet"/>
    <link href="assets/plugins/flag-icons/css/flag-icon.min.css" rel="stylesheet"/>
    <link href="assets/plugins/jvectormap/jquery-jvectormap-2.0.3.css" rel="stylesheet"/>
    <link href="assets/plugins/ladda/ladda.min.css" rel="stylesheet"/>
    <link href="assets/plugins/select2/css/select2.min.css" rel="stylesheet"/>
    <link href="assets/plugins/daterangepicker/daterangepicker.css" rel="stylesheet"/>

    <!-- SLEEK CSS -->
    <link id="sleek-css" rel="stylesheet" href="assets/css/sleek.css"/>


    <!-- FAVICON -->
    <link href="assets/img/favicon.png" rel="shortcut icon"/>

    <!--
      HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries
    -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="assets/plugins/nprogress/nprogress.js"></script>
</head>


<body class="sidebar-fixed sidebar-dark header-light header-fixed" id="body">
<script>
    NProgress.configure({showSpinner: false});
    NProgress.start();
</script>

<div class="mobile-sticky-body-overlay"></div>

<div class="wrapper">

    <!--
====================================
——— LEFT SIDEBAR WITH FOOTER
=====================================
-->
    <?php include_once './nav.php' ?>


    <div class="page-wrapper">
        <!-- Header -->
        <?php include_once './header.php' ?>


        <div class="content-wrapper">
            <div class="content">
                <!-- Top Statistics -->


                <div class="row">

                    <div class="col-lg-12">
                        <div class="card card-default">
                            <div class="card-header card-header-border-bottom">
                                <h2>Thêm/Sửa Tài Khoản</h2>
                            </div>

                            <div class="card-body">
                                <form action="" enctype="multipart/form-data" method="post">

                                    <div class="form-row">

                                        <div class="col-md-6 mb-6">
                                            <label for="validationServer01">Tên Sản Phẩm</label>
                                            <input type="text" class="form-control" name="name_product"
                                                   placeholder="Nhập Tên Sản Phẩm"
                                                   value="<?= $name_product; ?>" required="">
                                            <div class="valid-feedback">
                                            </div>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label for="validationServerUsername">Giá</label>
                                            <input type="text" class="form-control" name="price"
                                                   placeholder="Nhập Giá" value="<?= $price; ?>"
                                                   aria-describedby="inputGroupPrepend3" required="">
                                            <div class="invalid-feedback">
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="validationServer05">Giá Khuyến Mại</label>
                                            <input type="text" class="form-control" name="sale" value="<?= $sale; ?>"
                                                   placeholder="Nhập Giá Khuyến Mãi" required="">
                                            <div class="invalid-feedback">
                                            </div>
                                        </div>


                                    </div>

                                    <div class="form-row">
                                        <div class="col-md-4 mb-4">
                                            <label for="validationServer05">Chọn Ảnh</label>
                                            <input type="file" name="image_product1" class="custom-file">
                                            <div class="invalid-feedback">
                                            </div>
                                        </div>

                                        <div class="col-md-4 mb-4">
                                            <label for="validationServer05">Chọn Ảnh</label>
                                            <input type="file" name="image_product2" class="custom-file">
                                            <div class="invalid-feedback">
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-4">
                                            <label for="validationServer05">Chọn Ảnh</label>
                                            <input type="file" name="image_product3" class="custom-file">
                                            <div class="invalid-feedback">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="col-md-4 mb-4">
                                            <input type="hidden" name="oldImageProduct1"
                                                   value="<?= $image_product1; ?>">
                                            <img src="<?= $image_product1; ?>" width="120" class="img-thumbnail">

                                            <div class="invalid-feedback">
                                            </div>
                                        </div>

                                        <div class="col-md-4 mb-4">
                                            <input type="hidden" name="oldImageProduct2"
                                                   value="<?= $image_product2; ?>">
                                            <img src="<?= $image_product2; ?>" width="120" class="img-thumbnail">

                                            <div class="invalid-feedback">
                                            </div>
                                        </div>

                                        <div class="col-md-4 mb-4">
                                            <input type="hidden" name="oldImageProduct3"
                                                   value="<?= $image_product3; ?>">
                                            <img src="<?= $image_product3; ?>" width="120" class="img-thumbnail">

                                            <div class="invalid-feedback">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="col-md-12 mb-12">
                                            <label for="validationServer05">Mô Tả Ngắn</label>
                                            <input type="text" class="form-control" name="des" value="<?= $des; ?>"
                                                   placeholder="Nhập Mô Tả Ngắn" required="">
                                            <div class="invalid-feedback">
                                            </div>
                                        </div>

                                    </div>


                                    <div class="form-row">


                                        <div class="col-md-4 mb-4">
                                            <?php $query = 'SELECT * FROM brand';
                                            $stmt = $conn->prepare($query);
                                            $stmt->execute();
                                            $result = $stmt->get_result();
                                            ?>
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect3">Hãng</label>
                                                <select class="form-control" name="id_brand"
                                                        id="exampleFormControlSelect3">
                                                    <?php while ($row = $result->fetch_assoc()) { ?>
                                                        <option value="<?= $row['id_brand'] ?>"><?php echo $row['name_brand'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="invalid-feedback">
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-4">
                                            <?php $query = 'SELECT * FROM productstatus';
                                            $stmt = $conn->prepare($query);
                                            $stmt->execute();
                                            $result = $stmt->get_result();
                                            ?>
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect3">Trạng Thái</label>
                                                <select class="form-control" name="id_productStatus"
                                                        id="exampleFormControlSelect3">
                                                    <?php while ($row = $result->fetch_assoc()) { ?>
                                                        <option value="<?= $row['id_productStatus'] ?>"><?php echo $row['type_productName'] ?></option>
                                                    <?php } ?>

                                                </select>
                                            </div>
                                            <div class="invalid-feedback">
                                            </div>
                                        </div>

                                        <div class="col-md-4 mb-4">
                                            <?php $query = 'SELECT * FROM sizeProduct';
                                            $stmt = $conn->prepare($query);
                                            $stmt->execute();
                                            $result = $stmt->get_result();
                                            ?>
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect3">Loại Máy</label>
                                                <select class="form-control" name="id_sizeProduct"
                                                        id="exampleFormControlSelect3">
                                                    <?php while ($row = $result->fetch_assoc()) { ?>
                                                        <option value="<?= $row['id_sizeProduct'] ?>"><?php echo $row['name_sizeProduct'] ?></option>
                                                    <?php } ?>

                                                </select>
                                            </div>
                                            <div class="invalid-feedback">
                                            </div>
                                        </div>

                                        <div class="col-md-4 mb-4">
                                            <?php $query = 'SELECT * FROM colorProduct';
                                            $stmt = $conn->prepare($query);
                                            $stmt->execute();
                                            $result = $stmt->get_result();
                                            ?>
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect3">Màu Sắc</label>
                                                <select class="form-control" name="id_colorProduct"
                                                        id="exampleFormControlSelect3">
                                                    <?php while ($row = $result->fetch_assoc()) { ?>
                                                        <option value="<?= $row['id_colorProduct'] ?>"><?php echo $row['name_colorProduct'] ?></option>
                                                    <?php } ?>

                                                </select>
                                            </div>
                                            <div class="invalid-feedback">
                                            </div>
                                        </div>

                                        <div class="col-md-4 mb-4">
                                            <label for="">Số Lượng Sản Phẩm</label>
                                            <input type="text" class="form-control" name="amountProduct" value="<?= $amountProduct; ?>"
                                                   placeholder="Nhập Số Lượng Sản Phẩm" required="">
                                            <div class="invalid-feedback">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-row">
                                        <div class="col-md-12 mb-12">
                                            <label for="validationServer05">Viết Nội Dung</label>
                                            <textarea name="detail_product" id="content" value=""
                                                      placeholder="Đây là nội dung..." class="noidung" rows="10"
                                                      cols="80"><?php echo $detail_product ?></textarea>
                                            <div class="invalid-feedback">
                                            </div>
                                        </div>

                                    </div>

                                    <?php if ($update_product == true) { ?>
                                        <input type="submit" name="updateProduct" class="btn btn-success btn-block"
                                               value="Xác Nhận Cập Nhật">
                                    <?php } else { ?>
                                        <input type="submit" name="insertProduct" class="btn btn-primary btn-block"
                                               value="Thêm Sản Phẩm">
                                    <?php } ?>
                                </form>

                            </div>
                        </div>



                    </div>

                    <footer class="footer mt-auto">
                        <div class="copyright bg-white">
                            <p>
                                &copy; <span id="copy-year">2019</span> Copyright Sleek Dashboard Bootstrap Template by
                                <a
                                    class="text-primary"
                                    href="http://www.iamabdus.com/"
                                    target="_blank"
                                >Abdus</a
                                >.
                            </p>
                        </div>
                        <script>
                            var d = new Date();
                            var year = d.getFullYear();
                            document.getElementById("copy-year").innerHTML = year;
                        </script>
                    </footer>

                </div>
            </div>
        </div>


        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDCn8TFXGg17HAUcNpkwtxxyT9Io9B_NcM"
                defer></script>
        <script src="assets/plugins/jquery/jquery.min.js"></script>
        <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/plugins/toaster/toastr.min.js"></script>
        <script src="assets/plugins/slimscrollbar/jquery.slimscroll.min.js"></script>
        <script src="assets/plugins/charts/Chart.min.js"></script>
        <script src="assets/plugins/ladda/spin.min.js"></script>
        <script src="assets/plugins/ladda/ladda.min.js"></script>
        <script src="assets/plugins/jquery-mask-input/jquery.mask.min.js"></script>
        <script src="assets/plugins/select2/js/select2.min.js"></script>
        <script src="assets/plugins/jvectormap/jquery-jvectormap-2.0.3.min.js"></script>
        <script src="assets/plugins/jvectormap/jquery-jvectormap-world-mill.js"></script>
        <script src="assets/plugins/daterangepicker/moment.min.js"></script>
        <script src="assets/plugins/daterangepicker/daterangepicker.js"></script>
        <script src="assets/plugins/jekyll-search.min.js"></script>
        <script src="assets/js/sleek.js"></script>
        <script src="assets/js/chart.js"></script>
        <script src="assets/js/date-range.js"></script>
        <script src="assets/js/map.js"></script>
        <script src="assets/js/custom.js"></script>


        <script>
            $(document).ready(function () {

                $('#showAllUser').dataTable({});
            });
        </script>


        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.22/datatables.min.css"/>

        <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.22/datatables.min.js"></script>

        <script src="//cdn.ckeditor.com/4.15.0/full/ckeditor.js"></script>

        <script type="text/javascript">
            CKEDITOR.replace('content', {
                    width: "1050px",
                    height: "300px"
                }
            );</script>

</body>
</html>
