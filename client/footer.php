<!-- FOOTER -->
<footer id="footer">
    <!-- top footer -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-3 col-xs-6">
                    <div class="footer">
                        <h3 class="footer-title">LIÊN HỆ</h3>
                        <p>Hân Hạnh Phục Vụ Qúy Khách Hàng</p>
                        <ul class="footer-links">
                            <?php $querySetting = 'SELECT * FROM infor';
                            $stmtSetting = $conn->prepare($querySetting);
                            $stmtSetting->execute();
                            $resultSetting = $stmtSetting->get_result();
                            ?>
                            <?php while ($rowSetting = $resultSetting->fetch_assoc()) { ?>
                            <li><a href="#"><i class="fa fa-map-marker"></i><?= $rowSetting['infor_address'] ?></a></li>
                            <li><a href="#"><i class="fa fa-phone"></i><?= $rowSetting['infor_phone'] ?></a></li>
                            <li><a href="#"><i class="fa fa-envelope-o"></i><?= $rowSetting['infor_phone'] ?></a></li>
                            <?php } ?>

                        </ul>
                    </div>
                </div>

                <div class="col-md-3 col-xs-6">
                    <div class="footer">
                        <h3 class="footer-title">TOP YÊU THÍCH & GIẢM GIÁ</h3>
                        <ul class="footer-links">
                            <?php

                            $queryCategory = "SELECT * FROM productstatus";
                            $stmtCategory = $conn->prepare($queryCategory);
                            $stmtCategory->execute();
                            $resultCategory = $stmtCategory->get_result();
                            ?>
                            <?php while ($rowCategory = $resultCategory->fetch_assoc()) { ?>
                            <li><a href="../client/store.php?detailsProductStatus=<?= $rowCategory['id_productStatus']; ?>"
                                   value="<?= $rowCategory['id_productStatus']; ?>"
                                   name="testdd24">  <?= $rowCategory['type_productName'] ?> </a></li>
                            <?php } ?>

                        </ul>
                    </div>
                </div>

                <div class="clearfix visible-xs"></div>

                <div class="col-md-3 col-xs-6">
                    <div class="footer">
                        <h3 class="footer-title">THÔNG TIN</h3>
                        <ul class="footer-links">
                            <li><a href="#">Thông Tin</a></li>
                            <li><a href="#">Liên Hệ</a></li>
                            <li><a href="#">Chính Sách</a></li>
                            <li><a href="#">Đổi Trả</a></li>
                            <li><a href="#">Điều Khoản</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-3 col-xs-6">
                    <div class="footer">
                        <h3 class="footer-title">DỊCH VỤ</h3>
                        <ul class="footer-links">
                            <li><a href="#">Tài Khoản</a></li>
                            <li><a href="#">Giỏ Hàng</a></li>
                            <li><a href="#">Trợ Giúp</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /top footer -->

    <!-- bottom footer -->
    <div id="bottom-footer" class="section">
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12 text-center">
                    <ul class="footer-payments">
                        <li><a href="#"><i class="fa fa-cc-visa"></i></a></li>
                        <li><a href="#"><i class="fa fa-credit-card"></i></a></li>
                        <li><a href="#"><i class="fa fa-cc-paypal"></i></a></li>
                        <li><a href="#"><i class="fa fa-cc-mastercard"></i></a></li>
                        <li><a href="#"><i class="fa fa-cc-discover"></i></a></li>
                        <li><a href="#"><i class="fa fa-cc-amex"></i></a></li>
                    </ul>
                    <span class="copyright">
								<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                         <?php $querySetting = 'SELECT * FROM infor';
                         $stmtSetting = $conn->prepare($querySetting);
                         $stmtSetting->execute();
                         $resultSetting = $stmtSetting->get_result();
                         ?>
						<?php while ($rowSetting = $resultSetting->fetch_assoc()) { ?>
                        <?= $rowSetting['copyright'] ?>
                        <?php } ?>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
							</span>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /bottom footer -->
</footer>
<!-- /FOOTER -->