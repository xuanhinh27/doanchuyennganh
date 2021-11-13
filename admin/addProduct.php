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
                            <?php $query = 'SELECT * FROM products 
                                            inner join brand on products.id_brand = brand.id_brand
                                            inner join productstatus on products.id_productStatus = productstatus.id_productStatus
                                            inner join sizeproduct on products.id_sizeProduct = sizeproduct.id_sizeProduct
                                            inner join colorproduct on products.id_colorProduct = colorproduct.id_colorProduct';
                            $stmt = $conn->prepare($query);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            ?>
                            <div class="col-lg-12">
                                <div class="card card-default">
                                    <div class="card-header card-header-border-bottom">
                                        <h2>Quản Lý Sản Phẩm</h2>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-striped" id="showAllUser">
                                            <thead>
                                            <tr>
                                                <th scope="col">Ảnh Sản Phẩm</th>
                                                <th scope="col">Tên Sản Phẩm</th>
                                                <th scope="col">Giá</th>
                                                <th scope="col">Giá Khuyến Mãi</th>
                                                <th scope="col">Số Lượng Còn Lại</th>
                                                <th scope="col">Hãng</th>
                                                <th scope="col">Trạng Thái</th>
                                                <th scope="col">Loại Máy</th>
                                                <th scope="col">Màu Sắc</th>
                                                <th scope="col">Thao Tác</th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php while ($row = $result->fetch_assoc()) { ?>

                                                <tr>
                                                    <td scope="row"><img width="100"
                                                                         src="<?php echo $row['image_product1'] ?>">
                                                    </td>
                                                    <td><?php echo $row['name_product'] ?></td>
                                                    <td><?php echo $row['price'] ?></td>
                                                    <td><?php echo $row['sale'] ?></td>
                                                    <td><?php echo $row['amountProduct'] ?></td>
                                                    <td><?php echo $row['name_brand'] ?></td>
                                                    <td><?php echo $row['type_productName'] ?></td>
                                                    <td><?php echo $row['name_sizeProduct'] ?></td>
                                                    <td><?php echo $row['name_colorProduct'] ?></td>

                                                    <td><a href="../client/detailProduct.php?detailProduct=<?= $row['id_product']; ?>"
                                                           class="badge badge-primary p-2">Chi Tiết</a>
                                                        <a href="../config/action.php?deleteProduct=<?= $row['id_product']; ?>"
                                                           class="badge badge-danger p-2"
                                                           onclick="return confirm('Do you want delete this record?');">Xóa</a>

                                                        <a href="addProduct2.php?editProduct=<?= $row['id_product']; ?>"
                                                           class="badge badge-success p-2">Sửa</a></td>
                                                </tr>
                                            <?php } ?>
                                            </tbody>

                                        </table>
                                    </div>
                                </div>

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
