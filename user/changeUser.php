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
                <div class="bg-white border rounded">
                    <div class="row no-gutters">
                        <div class="col-lg-4 col-xl-3">
                            <div class="profile-content-left pt-5 pb-3 px-3 px-xl-5">
                                <div class="card text-center widget-profile px-0 border-0">
                                    <div class="card-img mx-auto rounded-circle">
                                        <img src="<?= $_SESSION['avatar']; ?>" alt="user image">
                                    </div>
                                    <div class="card-body">
                                        <h4 class="py-2 text-dark"><?= $_SESSION['name']; ?></h4>
                                        <p><?= $_SESSION['email']; ?></p>
                                    </div>
                                </div>

                                <hr class="w-100">
                                <div class="contact-info pt-4">
                                    <h5 class="text-dark mb-1">Thông Tin</h5>
                                    <p class="text-dark font-weight-medium pt-4 mb-2">Email:</p>
                                    <p><?= $_SESSION['email']; ?></p>
                                    <p class="text-dark font-weight-medium pt-4 mb-2">Số Điện Thoại:</p>
                                    <p><?= $_SESSION['phone']; ?></p>
                                    <p class="text-dark font-weight-medium pt-4 mb-2">Địa Chỉ Nhà:</p>
                                    <p><?= $_SESSION['address']; ?></p>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 col-xl-9">
                            <div class="profile-content-right py-5">
                                <ul class="nav nav-tabs px-3 px-xl-5 nav-style-border" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="timeline-tab" data-toggle="tab" href="#time_line" role="tab" aria-controls="timeline" aria-selected="true">Đổi Thông Tin</a>
                                    </li>

                                </ul>
                                <div class="tab-content px-3 px-xl-5" id="time_line">


                                    <div class="content-wrapper">
                                        <div class="content">
                                            <!-- Top Statistics -->
                                            <div class="row">

                                                <div class="col-lg-12">
                                                    <div class="card card-default">
                                                        <div class="card-header card-header-border-bottom">
                                                            <h2>Đổi Thông Tin Tài Khoản<?= $_SESSION['id_user'] ?></h2>
                                                        </div>

                                                        <div class="card-body">
                                                            <form action="" enctype="multipart/form-data" method="post">

                                                                <div class="form-row">
                                                                    <div class="col-md-3 mb-3">
                                                                        <label for="validationServer01">Tên</label>
                                                                        <input type="text" class="form-control" name="name" placeholder="Nhập Tên"
                                                                               value="<?= $_SESSION['name']; ?>" required="">
                                                                        <div class="valid-feedback">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-3 mb-3">
                                                                        <label for="validationServerUsername">Email</label>
                                                                        <input type="email" class="form-control" name="email"
                                                                               placeholder="Nhập Email" value="<?= $_SESSION['email']; ?>"
                                                                               aria-describedby="inputGroupPrepend3" required="">
                                                                        <div class="invalid-feedback">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 mb-3">
                                                                        <label for="validationServer05">Mật Khẩu</label>
                                                                        <input type="text" class="form-control" name="pass" value="<?= $_SESSION['pass']; ?>"
                                                                               placeholder="Nhập Mật Khẩu" required="">
                                                                        <div class="invalid-feedback">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 mb-3">
                                                                        <label for="validationServer04">Số Điện Thoại</label>
                                                                        <input type="tel" class="form-control" name="phone" value="<?= $_SESSION['phone']; ?>"
                                                                               placeholder="Nhập Số Điện Thoại" required="">
                                                                        <div class="invalid-feedback">
                                                                        </div>
                                                                    </div>

                                                                </div>


                                                                <div class="form-row">

                                                                    <div class="col-md-6 mb-6">
                                                                        <label for="validationServer01">Địa Chỉ</label>
                                                                        <input type="text" class="form-control" name="address"
                                                                               placeholder="Nhập Địa Chỉ"
                                                                               value="<?= $_SESSION['address']; ?>" required="">
                                                                        <div class="valid-feedback">
                                                                        </div>
                                                                    </div>


                                                                    <div class="col-md-3 mb-3">
                                                                        <label for="validationServer05">Chọn Ảnh</label>
                                                                        <input type="file" name="avatar" class="custom-file">
                                                                        <div class="invalid-feedback">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 mb-3">
                                                                        <input type="hidden" name="oldimage" value="<?= $_SESSION['avatar']; ?>">
                                                                        <img src="<?= $_SESSION['avatar']; ?>" width="120" class="img-thumbnail">

                                                                        <div class="invalid-feedback">
                                                                        </div>
                                                                    </div>

                                                                </div>


                                                                <input type="submit" name="updateUser" class="btn btn-success btn-block"
                                                                       value="Đổi Thông Tin">

                                                            </form>

                                                        </div>
                                                    </div>


                                                </div>
                                            </div>


                                        </div>
                                    </div>

                </div></div>




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


</body>
</html>
