<?php
include '../DataBase/connection.php';
error_reporting(0);
session_start();


//Login//

$_SESSION['errorLogin1'] = "";
$_SESSION['errorLogin2'] = "";

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $sql = "select * from users where email='$email' and pass='$pass'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_array(MYSQLI_ASSOC);
    if (($email !== $row['email'])){
        $_SESSION['errorLogin1']  = "Lỗi: Email Không Tồn Tại ";
    } if (($pass !== $row['pass'])){
        $_SESSION['errorLogin2'] =  "Lỗi: Mật Khậu Không Đúng ";
    }
    elseif ($row['type_user'] == "member" && $email == $row['email'] && $pass == $row['pass']) {
        $_SESSION["loged"] = true;
        $_SESSION["member"] = true;
        header("Location:../client/");
    } elseif ($row['type_user'] == "admin" && $email == $row['email'] && $pass == $row['pass']) {
        $_SESSION["loged"] = true;
        $_SESSION["admin"] = true;
        header("Location:../client/");
    }
    $id_user = $row['id_user'];
    $pass = $row['pass'];
    $name = $row['name'];
    $email = $row['email'];
    $avatar = $row['avatar'];
    $address = $row['address'];
    $phone = $row['phone'];


    if (isset($_SESSION["loged"])) {
        if (mysqli_num_rows($result)) {
            $_SESSION['id_user'] = $id_user;
            $_SESSION['email'] = $email;
            $_SESSION['pass'] = $pass;
            $_SESSION['name'] = $name;
            $_SESSION['avatar'] = $avatar;
            $_SESSION['address'] = $address;
            $_SESSION['phone'] = $phone;

        }
    }
}
//Ket Thuc Login//

//regiter//
$resultStatus = "";

if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $rePass = $_POST['repass'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $avatar = $_FILES['avatar']['name'];
    $registerPath = '../uploads/' . $avatar;

    if ($pass != $rePass) {
        $resultStatus = "Lỗi: Mât Khẩu Không khớp";
        exit();
    } else {
        $sql = $conn->prepare("select email,phone from users where email=? or phone=?");
        $sql->bind_param("ss", $email, $phone);
        $sql->execute();
        $result = $sql->get_result();
        $row = $result->fetch_array(MYSQLI_ASSOC);

        if ($row['phone'] == $phone) {
            $resultStatus = "Lỗi: Trùng Số Điện Thoại";
        } elseif ($row['email'] == $email) {
            $resultStatus = "Lỗi: Đã Có Người Dùng Email Này";
        } else {
            $query = "insert into users(name,email,pass,address,phone,avatar) values (?,?,?,?,?,?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ssssss", $name, $email, $pass, $address, $phone, $registerPath);
            $stmt->execute();
            move_uploaded_file($_FILES['avatar']['tmp_name'], $registerPath);
            $resultStatus = "Đăng Ký thành Công";
        }
    }

}


//Ket Thuc regiter//


//User//

$update = false;
$id_user = "";
$name = "";
$email = "";
$pass = "";
$address = "";
$phone = "";
$avatar = "";

if (isset($_POST['insert'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $avatar = $_FILES['avatar']['name'];
    $path = '../uploads/' . $avatar;
    $sql = "insert into users(name,email,pass,address,phone,avatar) values (?,?,?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $name, $email, $pass, $address, $phone, $path);
    $stmt->execute();
    move_uploaded_file($_FILES['avatar']['tmp_name'], $path);
    header('location:../admin/showAllUser.php');

}


if (isset($_GET['edit'])) {
    $id_user = $_GET['edit'];
    $query = "SELECT * FROM users WHERE id_user=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_user);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $id_user = $row['id_user'];
    $name = $row['name'];
    $email = $row['email'];
    $pass = $row['pass'];
    $address = $row['address'];
    $phone = $row['phone'];
    $avatar = $row['avatar'];

    $update = true;


}

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $oldimage = $_POST['oldimage'];

    if (isset($_FILES['avatar']['name']) && ($_FILES['avatar']['name'] != "")) {
        $newimage = "../uploads/" . $_FILES['avatar']['name'];
        unlink($oldimage);
        move_uploaded_file($_FILES['avatar']['tmp_name'], $newimage);
    } else {
        $newimage = $oldimage;
    }
    $query = "UPDATE users SET name=?,email=?, pass=?, address=?, phone=?, avatar=? WHERE id_user=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssssi", $name, $email, $pass, $address, $phone, $newimage, $id_user);
    $stmt->execute();
}





if (isset($_GET['details'])) {
    $id_user = $_GET['details'];
    $query = "SELECT * FROM users WHERE id_user=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_user);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
}


if (isset($_GET['delete'])) {
    $id_user = $_GET['delete'];
    $query = "DELETE FROM users WHERE id_user=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_user);
    $stmt->execute();
    $result = $stmt->get_result();

    header('location:../admin/showAllUser.php');

}
//Ket Thuc User//


//Update info User //
if (isset($_POST['updateUser'])) {
    $id_user = $_SESSION['id_user'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $oldimage = $_POST['oldimage'];

    if (isset($_FILES['avatar']['name']) && ($_FILES['avatar']['name'] != "")) {
        $newimage = "../uploads/" . $_FILES['avatar']['name'];
        unlink($oldimage);
        move_uploaded_file($_FILES['avatar']['tmp_name'], $newimage);
    } else {
        $newimage = $oldimage;
    }
    $query = "UPDATE users SET name=?,email=?, pass=?, address=?, phone=?, avatar=? WHERE id_user=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssssi", $name, $email, $pass, $address, $phone, $newimage, $id_user);
    $stmt->execute();
    $sql = "select * from users where email='$email' and pass='$pass'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_array(MYSQLI_ASSOC);
    $_SESSION['email'] = $row['email'];
    $_SESSION['pass'] = $row['pass'];
    $_SESSION['name'] = $row['name'];
    $_SESSION['avatar'] = $row['avatar'];
    $_SESSION['address'] = $row['address'];
    $_SESSION['phone'] = $row['phone'];
    header('location:../user/changeUser.php');



}

// Ket THuc Update info User //


// Slider ///

$update_slider = false;
$image_slider = "";
$name_slider = "";




    if (isset($_POST['insertSlider'])) {
    $name_slider = $_POST['name_slider'];
    $image_slider = $_FILES['image_slider']['name'];
    $path_slider = '../uploads/' . $image_slider;
    $sql = "insert into slide(image_slider,name_slider) values (?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $path_slider, $name_slider);
    $stmt->execute();
    $result = $stmt->get_result();
    move_uploaded_file($_FILES['image_slider']['tmp_name'], $path_slider);

    header('location:../admin/slide.php');

}

if (isset($_GET['deleteSlider'])) {
    $id_slider = $_GET['deleteSlider'];
    $query = "DELETE FROM slide WHERE id_slider=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_slider);
    $stmt->execute();
    $result = $stmt->get_result();

    header('location:../admin/slide.php');
}

if (isset($_GET['editSlider'])) {
    $id_slider = $_GET['editSlider'];
    $query = "SELECT * FROM slide WHERE id_slider=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_slider);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $id_slider = $row['id_slider'];
    $image_slider = $row['image_slider'];
    $name_slider = $row['name_slider'];
    $update_slider = true;


}

if (isset($_POST['updateSlider'])) {
    $oldSlider = $_POST['oldSlider'];
    $name_slider = $_POST['name_slider'];

    if (isset($_FILES['image_slider']['name']) && ($_FILES['image_slider']['name'] != "")) {
        $newSlider = "../uploads/" . $_FILES['image_slider']['name'];
        unlink($oldSlider);
        move_uploaded_file($_FILES['image_slider']['tmp_name'], $newSlider);
    } else {
        $newSlider = $oldSlider;
    }
    $query = "UPDATE slide SET image_slider=?, name_slider=? WHERE id_slider=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssi", $newSlider, $name_slider, $id_slider);
    $stmt->execute();
    header('location:../admin/slide.php');


}

// ket thuc slider//


// productStatus //

$update_productStatus = false;
$type_productName = "";


if (isset($_POST['insertProductStatus'])) {
    $type_productName = $_POST['type_productName'];
    $queryCheckVali = 'SELECT * FROM productstatus where type_productName = ?';
    $stmtCheckVali = $conn->prepare($queryCheckVali);
    $stmtCheckVali->bind_param("s", $type_productName);
    $stmtCheckVali->execute();
    $resultCheckVali = $stmtCheckVali->get_result();
    $rowCheckVali = $resultCheckVali->fetch_assoc();

    if ($_POST['type_productName'] == strtolower($rowCheckVali['type_productName']) || strtoupper($rowCheckVali['type_productName'])) {
            echo "<script>alert('Đã Tồn Tại')</script>";
    } else {
            $type_productName = $_POST['type_productName'];
            $sql = "insert into productstatus(type_productName) values (?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $type_productName);
            $stmt->execute();
            header('location:../admin/productStatus.php');
        }
}


if (isset($_GET['deleteProductStatus'])) {
    $id_productStatus = $_GET['deleteProductStatus'];
    $query = "DELETE FROM productstatus WHERE id_productStatus=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_productStatus);
    $stmt->execute();
    $result = $stmt->get_result();

    header('location:../admin/productStatus.php');
}


if (isset($_GET['editProductStatusr'])) {
    $id_productStatus = $_GET['editProductStatusr'];
    $query = "SELECT * FROM productstatus WHERE id_productStatus=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_productStatus);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $id_productStatus = $row['id_productStatus'];
    $type_productName = $row['type_productName'];
    $update_productStatus = true;


}

if (isset($_POST['updateProductStatus'])) {
    $type_productName = $_POST['type_productName'];

    $query = "UPDATE productstatus SET type_productName=? WHERE id_productStatus=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $type_productName, $id_productStatus);
    $stmt->execute();
    header('location:../admin/productStatus.php');


}

// Ket Thuc productStatus//


//Size Product //

$update_sizeProduct = false;
$name_sizeProduct = "";




if (isset($_POST['insertSizeProduct'])) {
    $name_sizeProduct = $_POST['name_sizeProduct'];
    $queryCheckVali = 'SELECT * FROM sizeproduct where name_sizeProduct = ?';
    $stmtCheckVali = $conn->prepare($queryCheckVali);
    $stmtCheckVali->bind_param("s", $name_sizeProduct);
    $stmtCheckVali->execute();
    $resultCheckVali = $stmtCheckVali->get_result();
    $rowCheckVali = $resultCheckVali->fetch_assoc();

    if ($_POST['name_sizeProduct'] == strtolower($rowCheckVali['name_sizeProduct']) || strtoupper($rowCheckVali['name_sizeProduct'])) {
        echo "<script>alert('Đã Tồn Tại')</script>";
    } else {
        $name_sizeProduct = $_POST['name_sizeProduct'];
        $sql = "insert into sizeproduct(name_sizeProduct) values (?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $name_sizeProduct);
        $stmt->execute();
        header('location:../admin/sizeProduct.php');
    }
}


if (isset($_POST['insertSizeProduct'])) {


}
if (isset($_GET['deleteSizeProduct'])) {
    $id_sizeProduct = $_GET['deleteSizeProduct'];
    $query = "DELETE FROM sizeproduct WHERE id_sizeProduct=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_sizeProduct);
    $stmt->execute();
    $result = $stmt->get_result();

    header('location:../admin/sizeProduct.php');
}


if (isset($_GET['editSizeProduct'])) {
    $id_sizeProduct = $_GET['editSizeProduct'];
    $query = "SELECT * FROM sizeproduct WHERE id_sizeProduct=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_sizeProduct);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $id_sizeProduct = $row['id_sizeProduct'];
    $name_sizeProduct = $row['name_sizeProduct'];
    $update_sizeProduct = true;

}

if (isset($_POST['updateSizeProduct'])) {
    $name_sizeProduct = $_POST['name_sizeProduct'];

    $query = "UPDATE sizeproduct SET name_sizeProduct=? WHERE id_sizeProduct=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $name_sizeProduct, $id_sizeProduct);
    $stmt->execute();
    header('location:../admin/sizeProduct.php');

}
// Ket Thuc SizeProduct //


//Color Product //

$update_colorProduct = false;
$name_colorProduct = "";


if (isset($_POST['insertColorProduct'])) {
    $name_colorProduct = $_POST['name_colorProduct'];
    $queryCheckVali = 'SELECT * FROM colorProduct where name_colorProduct = ?';
    $stmtCheckVali = $conn->prepare($queryCheckVali);
    $stmtCheckVali->bind_param("s", $name_colorProduct);
    $stmtCheckVali->execute();
    $resultCheckVali = $stmtCheckVali->get_result();
    $rowCheckVali = $resultCheckVali->fetch_assoc();

    if ($_POST['name_colorProduct'] == strtolower($rowCheckVali['name_colorProduct']) || strtoupper($rowCheckVali['name_colorProduct'])) {
        echo "<script>alert('Đã Tồn Tại')</script>";
    } else {
        $name_colorProduct = $_POST['name_colorProduct'];
        $sql = "insert into colorProduct(name_colorProduct) values (?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $name_colorProduct);
        $stmt->execute();
        header('location:../admin/colorProduct.php');
    }
}


if (isset($_GET['deleteColorProduct'])) {
    $id_colorProduct = $_GET['deleteColorProduct'];
    $query = "DELETE FROM colorProduct WHERE id_colorProduct=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_colorProduct);
    $stmt->execute();
    $result = $stmt->get_result();

    header('location:../admin/colorProduct.php');
}


if (isset($_GET['editColorProduct'])) {
    $id_colorProduct = $_GET['editColorProduct'];
    $query = "SELECT * FROM colorProduct WHERE id_colorProduct=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_colorProduct);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $id_colorProduct = $row['id_colorProduct'];
    $name_colorProduct = $row['name_colorProduct'];
    $update_colorProduct = true;


}

if (isset($_POST['updateColorProduct'])) {
    $name_colorProduct = $_POST['name_colorProduct'];

    $query = "UPDATE colorProduct SET name_colorProduct=? WHERE id_colorProduct=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $name_colorProduct, $id_colorProduct);
    $stmt->execute();
    header('location:../admin/colorProduct.php');

}
// Ket Thuc Color Product //


// Brand//

$update_brand = false;
$name_brand = "";
$image_brand = "";


if (isset($_POST['insertBrand'])) {
    $name_brand = $_POST['name_brand'];
    $queryCheckVali = 'SELECT * FROM brand where name_brand = ?';
    $stmtCheckVali = $conn->prepare($queryCheckVali);
    $stmtCheckVali->bind_param("s", $name_brand);
    $stmtCheckVali->execute();
    $resultCheckVali = $stmtCheckVali->get_result();
    $rowCheckVali = $resultCheckVali->fetch_assoc();

    if ($_POST['name_brand'] == strtolower($rowCheckVali['name_brand']) || strtoupper($rowCheckVali['name_brand'])) {
        echo "<script>alert('Đã Tồn Tại')</script>";
    } else {
        $name_brand = $_POST['name_brand'];
        $image_brand = $_FILES['image_brand']['name'];
        $path_brand = '../uploads/' . $image_brand;
        $sql = "insert into brand(name_brand,image_brand) values (?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $name_brand, $path_brand);
        $stmt->execute();
        move_uploaded_file($_FILES['image_brand']['tmp_name'], $path_brand);
        header('location:../admin/brand.php');
    }
}



if (isset($_GET['deleteBrand'])) {
    $id_brand = $_GET['deleteBrand'];
    $query = "DELETE FROM brand WHERE id_brand=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_brand);
    $stmt->execute();
    $result = $stmt->get_result();

    header('location:../admin/brand.php');
}


if (isset($_GET['editBrand'])) {
    $id_brand = $_GET['editBrand'];
    $query = "SELECT * FROM brand WHERE id_brand=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_brand);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $id_brand = $row['id_brand'];
    $name_brand = $row['name_brand'];
    $image_brand = $row['image_brand'];
    $update_brand = true;

}


if (isset($_POST['updateBrand'])) {
    $oldBrand = $_POST['oldBrand'];
    $name_brand = $_POST['name_brand'];

    if (isset($_FILES['image_brand']['name']) && ($_FILES['image_brand']['name'] != "")) {
        $newBrand = "../uploads/" . $_FILES['image_brand']['name'];
        unlink($oldBrand);
        move_uploaded_file($_FILES['image_brand']['tmp_name'], $newBrand);
    } else {
        $newBrand = $oldBrand;
    }
    $query = "UPDATE brand SET name_brand=?, image_brand=? WHERE id_brand=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssi", $name_brand, $newBrand, $id_brand);
    $stmt->execute();
    header('location:../admin/brand.php');


}

// Ket Thuc Brand//


// Product//

$update_product = false;
$name_product = "";
$image_product1 = "";
$image_product2 = "";
$image_product3 = "";
$price = "";
$sale = "";
$des = "";
$detail_product = "";
$amountProduct = "";
$id_brand = "";
$id_productStatus = "";
$id_sizeProduct = "";
$id_colorProduct = "";



if (isset($_POST['insertProduct'])) {
    $name_product = $_POST['name_product'];
    $queryCheckVali = 'SELECT * FROM products where name_product = ?';
    $stmtCheckVali = $conn->prepare($queryCheckVali);
    $stmtCheckVali->bind_param("s", $name_product);
    $stmtCheckVali->execute();
    $resultCheckVali = $stmtCheckVali->get_result();
    $rowCheckVali = $resultCheckVali->fetch_assoc();

    if ($_POST['name_product'] == strtolower($rowCheckVali['name_product']) || strtoupper($rowCheckVali['name_product'])) {
        echo "<script>alert('Đã Tồn Tại')</script>";
    } else {
        $name_product = $_POST['name_product'];
        $image_product1 = $_FILES['image_product1']['name'];
        $image_product2 = $_FILES['image_product2']['name'];
        $image_product3 = $_FILES['image_product3']['name'];
        $price = $_POST['price'];
        $sale = $_POST['sale'];
        $des = $_POST['des'];
        $detail_product = $_POST['detail_product'];
        $amountProduct = $_POST['amountProduct'];
        $path_image_product1 = '../uploads/' . $image_product1;
        $path_image_product2 = '../uploads/' . $image_product2;
        $path_image_product3 = '../uploads/' . $image_product3;
        $id_brand = $_POST['id_brand'];
        $id_productStatus = $_POST['id_productStatus'];
        $id_sizeProduct = $_POST['id_sizeProduct'];
        $id_colorProduct = $_POST['id_colorProduct'];
        $sql = "insert into products(name_product,image_product1,image_product2,image_product3,price,sale,des,detail,amountProduct,id_brand,id_productStatus,id_sizeProduct,id_colorProduct) values (?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssssssssss", $name_product, $path_image_product1, $path_image_product2, $path_image_product3, $price, $sale, $des, $detail_product, $amountProduct, $id_brand, $id_productStatus, $id_sizeProduct, $id_colorProduct);
        $stmt->execute();
        move_uploaded_file($_FILES['image_product1']['tmp_name'], $path_image_product1);
        move_uploaded_file($_FILES['image_product2']['tmp_name'], $path_image_product2);
        move_uploaded_file($_FILES['image_product3']['tmp_name'], $path_image_product3);

        header('location:../admin/addProduct.php');
    }
}


if (isset($_GET['deleteProduct'])) {
    $id_product = $_GET['deleteProduct'];
    $query = "DELETE FROM products WHERE id_product=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_product);
    $stmt->execute();
    $result = $stmt->get_result();

    header('location:../admin/addProduct.php');

}






if (isset($_GET['editProduct'])) {
    $id_product = $_GET['editProduct'];
    $query = "SELECT * FROM products WHERE id_product=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_product);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $id_product = $row['id_product'];
    $name_product = $row['name_product'];
    $image_product1 = $row['image_product1'];
    $image_product2 = $row['image_product2'];
    $image_product3 = $row['image_product3'];
    $price = $row['price'];
    $sale = $row['sale'];
    $des = $row['des'];
    $detail_product = $row['detail'];
    $amountProduct = $row['amountProduct'];
    $id_brand = $row['id_brand'];
    $id_productStatus = $row['id_productStatus'];
    $id_sizeProduct = $row['id_sizeProduct'];
    $id_colorProduct = $row['id_colorProduct'];
    $update_product = true;

}


if (isset($_POST['updateProduct'])) {
    $name_product = $_POST['name_product'];
    $oldImageProduct1 = $_POST['oldImageProduct1'];
    $oldImageProduct2 = $_POST['oldImageProduct2'];
    $oldImageProduct3 = $_POST['oldImageProduct3'];
    $price = $_POST['price'];
    $sale = $_POST['sale'];
    $des = $_POST['des'];
    $detail_product = $_POST['detail_product'];
    $amountProduct = $_POST['amountProduct'];
    $id_brand = $_POST['id_brand'];
    $id_productStatus = $_POST['id_productStatus'];
    $id_sizeProduct = $_POST['id_sizeProduct'];
    $id_colorProduct = $_POST['id_colorProduct'];

    if (isset($_FILES['image_product1']['name']) && ($_FILES['image_product1']['name'] != "")) {
        $newImageProduct1 = "../uploads/" . $_FILES['image_product1']['name'];
        unlink($oldImageProduct1);
        move_uploaded_file($_FILES['image_product1']['tmp_name'], $newImageProduct1);
    } else {
        $newImageProduct1 = $oldImageProduct1;
    }

    if (isset($_FILES['image_product2']['name']) && ($_FILES['image_product2']['name'] != "")) {
        $newImageProduct2 = "../uploads/" . $_FILES['image_product2']['name'];
        unlink($oldImageProduct2);
        move_uploaded_file($_FILES['image_product2']['tmp_name'], $newImageProduct2);
    } else {
        $newImageProduct2 = $oldImageProduct2;
    }

    if (isset($_FILES['image_product3']['name']) && ($_FILES['image_product3']['name'] != "")) {
        $newImageProduct3 = "../uploads/" . $_FILES['image_product3']['name'];
        unlink($oldImageProduct3);
        move_uploaded_file($_FILES['image_product3']['tmp_name'], $newImageProduct3);
    } else {
        $newImageProduct3 = $oldImageProduct3;
    }

    $query = "UPDATE products SET name_product=?,image_product1=?,image_product2=?,image_product3=?,price=?,sale=?,des=?,detail=?,amountProduct=?,id_brand=?,id_productStatus=?, id_sizeProduct=?,id_colorProduct=? WHERE id_product=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssssssiiiii", $name_product, $newImageProduct1, $newImageProduct2, $newImageProduct3, $price, $sale, $des, $detail_product, $amountProduct, $id_brand, $id_productStatus, $id_sizeProduct, $id_colorProduct, $id_product);
    $stmt->execute();
    header('location:../admin/addProduct.php');


}


if (isset($_GET['detailProduct'])) {
    $id_product = $_GET['detailProduct'];
    $query = "SELECT * FROM products WHERE id_product=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_product);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();


    if (isset($_GET['detailProduct'])) {
        $queryComment = "SELECT * FROM comments inner join users on comments.id_user = users.id_user inner join products on comments.id_product = products.id_product where products.id_product=$id_product";
        $stmtComment = $conn->prepare($queryComment);
        $stmtComment->bind_param("i", $id_product);
        $stmtComment->execute();
        $resultComment = $stmtComment->get_result();
    }


}


/// // Ket Thuc Product//


// Dem View //

if (isset($_GET['detailProduct'])) {
    $id_product = $_GET['detailProduct'];
    $query = "UPDATE products SET countView=countView+1 where id_product=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_product);
    $stmt->execute();
}
//Ket Thuc Dem View //


// Select Product By Brand, tim theo trang thai, hien tat ca san pham, phan trang//


$item_per_page = !empty($_GET['per_page'])?$_GET['per_page']:4;
$current_page = !empty($_GET['page'])?$_GET['page']:1;
$numOffset = ($current_page-1) * $item_per_page;

$queryPageination = "SELECT * FROM products";
$totalRecords = mysqli_query($conn, $queryPageination);
$totalRecords = mysqli_num_rows($totalRecords);
$totalPages = ceil($totalRecords/$item_per_page);

if (isset($_GET['back_page'])){
    $current_page = 1;
} elseif (isset($_GET['up_page'])){
    $current_page = $totalPages;

}

if (isset($_GET['detailsBrand'])) {
    $id_brand = $_GET['detailsBrand'];
    $query = "SELECT * FROM products inner join brand on products.id_brand = brand.id_brand 
                            inner join productstatus on products.id_productStatus = productstatus.id_productStatus
WHERE brand.id_brand=? limit " .$item_per_page. " offset $numOffset";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_brand);
    $stmt->execute();
    $result = $stmt->get_result();


} elseif (isset($_GET['detailsProductStatus'])) {

    $id_productStatus = $_GET['detailsProductStatus'];
    $query = "SELECT * FROM products inner join brand on products.id_brand = brand.id_brand 
                            inner join productstatus on products.id_productStatus = productstatus.id_productStatus
WHERE productstatus.id_productStatus=? order by sale desc limit " .$item_per_page. " offset $numOffset";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_productStatus);
    $stmt->execute();
    $result = $stmt->get_result();

} else {
    $query = "SELECT * FROM products 
                                            inner join brand on products.id_brand = brand.id_brand
                                            inner join productstatus on products.id_productStatus = productstatus.id_productStatus order by sale asc limit " .$item_per_page. " offset $numOffset";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();

}

if (isset($_POST['submitFindPrice'])) {
    $findByPriceMin = $_POST['findByPriceMin'];
    $findByPriceMax = $_POST['findByPriceMax'];
    $query = "SELECT * FROM products inner join brand on products.id_brand = brand.id_brand
                          inner join productstatus on products.id_productStatus = productstatus.id_productStatus
WHERE price between '$findByPriceMin' and '$findByPriceMax'";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $findByPriceMin, $findByPriceMax);
    $stmt->execute();
    $result = $stmt->get_result();
}


// Ket THuc Select Product By Brand, category, price //


// Setting //


$update_setting = false;
$logo = "";
$infor_address = "";
$infor_email = "";
$infor_phone = "";
$copyright = "";


if (isset($_POST['insertSetting'])) {
    $infor_address = $_POST['infor_address'];
    $infor_email = $_POST['infor_email'];
    $infor_phone = $_POST['infor_phone'];
    $copyright = $_POST['copyright'];
    $logo = $_FILES['logo']['name'];
    $path_logo = '../uploads/' . $logo;
    $sql = "insert into infor(logo,infor_address,infor_email,infor_phone,copyright) values (?,?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $path_logo, $infor_address, $infor_email, $infor_phone, $copyright);
    $stmt->execute();
    move_uploaded_file($_FILES['logo']['tmp_name'], $path_logo);
    header('location:../admin/setting.php');

}

if (isset($_GET['deleteSetting'])) {
    $id_infor = $_GET['deleteSetting'];
    $query = "DELETE FROM infor WHERE id_infor=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_infor);
    $stmt->execute();
    $result = $stmt->get_result();

    header('location:../admin/setting.php');
}


if (isset($_GET['editSetting'])) {
    $id_infor = $_GET['editSetting'];
    $query = "SELECT * FROM infor WHERE id_infor=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_infor);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $id_slider = $row['id_slider'];
    $logo = $row['logo'];
    $infor_address = $row['infor_address'];
    $infor_email = $row['infor_email'];
    $infor_phone = $row['infor_phone'];
    $copyright = $row['copyright'];
    $update_setting = true;


}

if (isset($_POST['updateSetting'])) {
    $oldLogo = $_POST['oldLogo'];
    $infor_address = $_POST['infor_address'];
    $infor_email = $_POST['infor_email'];
    $infor_phone = $_POST['infor_phone'];
    $copyright = $_POST['copyright'];

    if (isset($_FILES['logo']['name']) && ($_FILES['logo']['name'] != "")) {
        $newLogo = "../uploads/" . $_FILES['logo']['name'];
        unlink($oldLogo);
        move_uploaded_file($_FILES['logo']['tmp_name'], $newLogo);
    } else {
        $newLogo = $oldLogo;
    }
    $query = "UPDATE infor SET logo=?, infor_address=?,infor_email=?,infor_phone=?,copyright=? WHERE id_infor=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssi", $newLogo, $infor_address, $infor_email, $infor_phone, $copyright, $id_infor);
    $stmt->execute();
    header('location:../admin/setting.php');


}

// Ket thuc Setting //


// count product//


$queryCountProduct = "select count('id_product') from products";
$resultCountProduct = mysqli_query($conn, $queryCountProduct);
$rowCountProduct = mysqli_fetch_array($resultCountProduct);


//if (true) {
//    $id_category = $_GET['detailsCategory'];
//    $queryCountProductCate = "select count('id_category') from products  inner join category on products.id_category = category.id_category
//WHERE category.id_category=?";
//    $stmtCountProductCate = $conn->prepare($queryCountProductCate);
//    $stmtCountProductCate->bind_param("i", $id_category);
//    $stmtCountProductCate->execute();
//    $resultCountProductCate = $stmtCountProductCate->get_result();
//    $rowCountProductCate = mysqli_fetch_array($resultCountProductCate);
//}


// ket thuc count product//

// chuc nang tim kiem //
if (isset($_POST['submitSearchProduct'])) {
    $_SESSION['valueSearch'] = trim($_POST['searchProduct']);
    header('location:../client/search.php');
}


if (isset($_POST['findPrice'])) {
    $giatri = $_POST['clickPro'];
    if (isset($_GET['detailsProductStatus'])){
        $query = "SELECT * FROM products inner join brand on products.id_brand = brand.id_brand
                            inner join productstatus on products.id_productStatus = productstatus.id_productStatus
             where products.id_productStatus = $_GET[detailsProductStatus] by sale $giatri";
    } elseif (isset($_GET['detailsBrand'])){
        $query = "SELECT * FROM products inner join brand on products.id_brand = brand.id_brand
                            inner join productstatus on products.id_productStatus = productstatus.id_productStatus
             where products.id_brand = $_GET[detailsBrand] order by sale $giatri ";
    }
    else {
        $query = "SELECT * FROM products inner join brand on products.id_brand = brand.id_brand
                            inner join productstatus on products.id_productStatus = productstatus.id_productStatus
              order by sale $giatri";
    }
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
}


//if (isset($_REQUEST['submitSearchProduct'])) {
//
//    $searchProduct = addslashes($_GET['searchProduct']);
//    if (empty($searchProduct)) {
//        $resultStatus = "Vui Lòng Điền";
//    } else {
//        $query = "SELECT * FROM products inner join brand on products.id_brand = brand.id_brand
//                          inner join productstatus on products.id_productStatus = productstatus.id_productStatus
//WHERE name_product like '%$searchProduct%'";
//
//        $stmt = $conn->prepare($query);
//        $stmt->bind_param("s", $searchProduct);
//        $stmt->execute();
//        $result = $stmt->get_result();
//
//    }
//}

// ket thuc chuc nang tim kiem //




// comment //
$update_comment = false;
$commentContent = "";

if (isset($_POST['commentSubmit'])) {
    $resultStatus = "";
    if (isset($_SESSION["loged"])) {
        $commentContent = $_POST['commentContent'];
        $date = date("Y-m-d");
        $id_product = $_GET['detailProduct'];
        $sql = "insert into comments(content,cur_date,id_product,id_user) values (?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssii", $commentContent, $date, $id_product, $_SESSION['id_user']);
        $stmt->execute();
        header("Refresh:0");
    } else {
        echo "<script>alert('Cần Đăng Nhập Mới Được Comment')</script>";
    }

}
if (isset($_POST['deleteComment'])) {
    $id_comment = $_POST['id_comment'];
    $query = "DELETE FROM comments WHERE id_comment=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_comment);
    $stmt->execute();
    $result = $stmt->get_result();
    header("Refresh:0");

}

if (isset($_GET['detailComment'])) {
    $id_product = $_GET['detailComment'];
    $query = "SELECT * FROM comments WHERE id_product=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_product);
    $stmt->execute();
    $result = $stmt->get_result();
}

if (isset($_POST['editComment'])) {
    $id_comment = $_POST['id_comment'];
    $queryComment = "SELECT * FROM comments WHERE id_comment=?";
    $stmtComment = $conn->prepare($queryComment);
    $stmtComment->bind_param("i", $id_comment);
    $stmtComment->execute();
    $resultComment = $stmtComment->get_result();
    $rowComment = $resultComment->fetch_assoc();
    $id_comment = $rowComment['id_comment'];
    $commentContent = $rowComment['content'];
    $update_comment = true;

}
if (isset($_POST['updateSubmit'])) {
    $id_comment = $_POST['id_comment'];
    $commentContent = $_POST['commentContent'];
    $queryComment = "UPDATE comments SET content=? WHERE id_comment=?";
    $stmtComment = $conn->prepare($queryComment);
    $stmtComment->bind_param("si", $commentContent, $id_comment);
    $stmtComment->execute();
    header("Refresh:0");

}


// ket thuc commnet//


// gio hang //


$update_orderProduct = false;
$orderStatus = "";

if (isset($_POST['deleteOrderProduct'])) {
    $id_orderProduct = $_POST['id_orderProduct'];
    $query = "DELETE FROM orderproduct WHERE id_orderProduct=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_orderProduct);
    $stmt->execute();
    $result = $stmt->get_result();
    header("Refresh:0");

}



if (isset($_POST['editOrderProduct'])) {
    $id_orderProduct = $_POST['id_orderProduct'];
    $queryOrder = "SELECT * FROM orderproduct WHERE id_orderProduct=?";
    $stmtOrder = $conn->prepare($queryOrder);
    $stmtOrder->bind_param("i", $id_orderProduct);
    $stmtOrder->execute();
    $resultOrder = $stmtOrder->get_result();
    $rowOrder = $resultOrder->fetch_assoc();
    $id_orderProduct = $rowOrder['id_orderProduct'];
    $orderStatus = $rowOrder['orderStatus'];
    $update_orderProduct = true;

}
if (isset($_POST['updateOrderProduct'])) {
    $id_orderProduct = $_POST['id_orderProduct'];
    $orderStatus = $_POST['orderStatus'];
    $queryComment = "UPDATE orderproduct SET orderStatus=? WHERE id_orderProduct=?";
    $stmtComment = $conn->prepare($queryComment);
    $stmtComment->bind_param("si", $orderStatus, $id_orderProduct);
    $stmtComment->execute();
    header("Refresh:0");

}




if (isset($_POST['addCart'])) {
    if (empty($_SESSION['loged'])) {

        echo "<script>alert('Cần Đăng Nhập Để Thêm Vào Giỏ')</script>";
    } else {

        $id_product = $_POST['idProduct'];
        $queryCart = "SELECT * FROM products WHERE id_product=?";
        $stmtCart = $conn->prepare($queryCart);
        $stmtCart->bind_param("i", $id_product);
        $stmtCart->execute();
        $resultCart = $stmtCart->get_result();
        $rowCart = $resultCart->fetch_assoc();
        $_SESSION['cart'][$_POST['idProduct']] = array(
            'id' => $_POST['idProduct'],
            'name_product' => $rowCart['name_product'],
            'image_product1' => $rowCart['image_product1'],
            'qtyProduct' => $_POST['qtyProduct'],
            'sizeProduct' => $_POST['sizeProduct'],
            'colorProduct' => $_POST['colorProduct'],
            'sale' => $_POST['sale'],
            'totalProduct' => $_POST['qtyProduct'] * $_POST['sale'],
        );
        $queryCart2 = "UPDATE products SET amountProduct=amountProduct - $_POST[qtyProduct] where id_product=?";
        $stmtCart2 = $conn->prepare($queryCart2);
        $stmtCart2->bind_param("i", $id_product);
        $stmtCart2->execute();
        header("Refresh:0");
}}

if (isset($_POST['deleteProductCart'])){

    $idProductCart = $_POST['idProductCart'];
    unset($_SESSION['totalOrder']);
    unset($_SESSION['cart'][$idProductCart]);
    header("Refresh:0");
}

if (isset($_POST['deleteProductCart'])){
    $idProductCart = $_POST['idProductCart'];
    $qtyProductCart = $_POST['qtyProductCart'];
    $queryCart2 = "UPDATE products SET amountProduct=amountProduct + $qtyProductCart  where id_product=?";
    $stmtCart2 = $conn->prepare($queryCart2);
    $stmtCart2->bind_param("i", $idProductCart);
    $stmtCart2->execute();
}



if (isset($_POST['acceptBuy'])) {
    $id_product = $_GET['detailProduct'];
    $sql = "insert into orderproduct(id_product,name_product,image_product,qtyProduct,sizeProduct,colorProduct,sale,totalProduct,id_user,avatar,email,phone,address) values (?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $stmt = $conn->prepare($sql);
    foreach ($_SESSION['cart'] as $k => $name) {
        $stmt->bind_param("sssssssssssss", $name['id'], $name['name_product'], $name['image_product1'], $name['qtyProduct'], $name['sizeProduct'], $name['colorProduct'], $name['sale'], $name['totalProduct'], $_SESSION['id_user'], $_SESSION['avatar'], $_SESSION['email'], $_SESSION['phone'], $_SESSION['address']);
        $stmt->execute();
    }
    unset($_SESSION['cart']);
    $_SESSION['totalOrder'] = 0;
    header("Refresh:0");
    echo "<script>alert('Đặt Hàng Thành Công')</script>";
}


// ket thuc gio hang //

?>