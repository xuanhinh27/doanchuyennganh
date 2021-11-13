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
                                        <img src="<?= $row['avatar']; ?>" alt="user image">
                                    </div>
                                    <div class="card-body">
                                        <h4 class="py-2 text-dark"><?= $row['name']; ?></h4>
                                        <p><?= $row['email']; ?></p>
                                    </div>
                                </div>

                                <hr class="w-100">
                                <div class="contact-info pt-4">
                                    <h5 class="text-dark mb-1">Thông Tin</h5>
                                    <p class="text-dark font-weight-medium pt-4 mb-2">Email:</p>
                                    <p><?= $row['email']; ?></p>
                                    <p class="text-dark font-weight-medium pt-4 mb-2">Số Điện Thoại:</p>
                                    <p><?= $row['phone']; ?></p>
                                    <p class="text-dark font-weight-medium pt-4 mb-2">Địa Chỉ Nhà:</p>
                                    <p><?= $row['address']; ?></p>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 col-xl-9">
                            <div class="profile-content-right py-5">
                                <ul class="nav nav-tabs px-3 px-xl-5 nav-style-border" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="timeline-tab" data-toggle="tab" href="#timeline"
                                           role="tab" aria-controls="timeline" aria-selected="true">Timeline</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile"
                                           role="tab" aria-controls="profile" aria-selected="false">Profile</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="settings-tab" data-toggle="tab" href="#settings"
                                           role="tab" aria-controls="settings" aria-selected="false">Settings</a>
                                    </li>
                                </ul>
                                <div class="tab-content px-3 px-xl-5" id="myTabContent">


                                    <?php $id_user = $row['id_user'];
                                    $queryComment = "SELECT * FROM comments inner join users on comments.id_user = users.id_user where comments.id_user=?";
                                    $stmtComment = $conn->prepare($queryComment);
                                    $stmtComment->bind_param("i", $id_user);
                                    $stmtComment->execute();
                                    $resultComment = $stmtComment->get_result();
                                    ?>
                                    <?php while ($rowComment = $resultComment->fetch_assoc()) { ?>
                                        <div class="media mt-5 profile-timeline-media">
                                            <div class="align-self-start iconbox-45 overflow-hidden mr-3">
                                                <img src="<?= $rowComment['avatar']; ?>"
                                                     alt="Generic placeholder image">
                                            </div>
                                            <div class="media-body">
                                                <h6 class="mt-0 text-dark"><?= $rowComment['name']; ?></h6>
                                                <span><?= $rowComment['type_user']; ?></span>
                                                <span class="float-right"><?= $rowComment['cur_date']; ?></span>
                                                <p><?= $rowComment['content']; ?></p>

                                            </div>
                                        </div>
                                    <?php } ?>


                                    <div class="tab-pane fade" id="profile" role="tabpanel"
                                         aria-labelledby="profile-tab">...
                                    </div>
                                    <div class="tab-pane fade" id="settings" role="tabpanel"
                                         aria-labelledby="settings-tab">...
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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


</body>
</html>
