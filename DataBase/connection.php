<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "nguyenlong2";

$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if (!$conn) {
    die("Chưa kết nối Database" . mysqli_connect_error());

}




    ?>



