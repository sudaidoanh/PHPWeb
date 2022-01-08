<?php
session_start();
if (isset($_SESSION['admin']) && isset($_SESSION['admin_password']) && isset($_SESSION['admin_ho']) && isset($_SESSION['admin_ten'])) {
    include('../class/adminLogin.php');
    $q = new adminLogin();
    $q->confirmAdminLogin($_SESSION['admin'], $_SESSION['admin_password'], $_SESSION['admin_ho'], $_SESSION['admin_ten']);
} else {
    header('location:login.php');
}
include('../class/adminConnectSQL.php');
$p = new database();
if(isset($_REQUEST['id'])) {
    $getId = $_REQUEST['id'];
}
else {
    header('location:index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xóa sản phẩm</title>
    <link rel="stylesheet" href="../css/w3.css">
</head>
<body class="w3-light-grey">
    <form action="" method="POST" class="w3-container w3-display-topmiddle w3-card-4 w3-light-grey w3-text-blue w3-margin" enctype="multipart/form-data" name="form" style="width: 40%">
        <h2 class="w3-center w3-serif">Xóa sản phẩm</h2>
        <a href="index.php" class="w3-display-topright w3-button w3-blue-gray w3 w3-round w3-margin w3-ripple w3-padding">Quay về trang chính</a>

        <div class="w3-row w3-section">
            <div class="w3-col w3-center " style="width: 30%; margin-top: 8px;"><label for="select">Hãng</label></div>
            <div class="w3-rest">
                
                <input type="text" readonly="readonly" value="<?php 
                $getId_ct = $p->getDataRow("select company_id from product where id_product='$getId' limit 1");
                echo $p->getDataRow("select company_name from company where id_company ='$getId_ct' limit 1"); ?>" name="txtTensp" id="txtTensp" class="w3-input w3-text-blue">
            </div>
        </div>

        <div class="w3-row w3-section">
            <div class="w3-col w3-center " style="width: 30%; margin-top: 8px;"><label for="txtTensp">Tên sản phẩm</label></div>
            <div class="w3-rest">
                <input type="text" readonly="readonly" value="<?php echo $p->getDataRow("select product_name from product where id_product='$getId' limit 1"); ?>" name="txtTensp" id="txtTensp" class="w3-input w3-text-blue">
            </div>
        </div>

        <div class="w3-row w3-section">
            <div class="w3-col w3-center " style="width: 30%; margin-top: 8px;"><label for="txtGia">Giá (VNĐ)</label></div>
            <div class="w3-rest">
                <input type="text" readonly="readonly" value="<?php echo number_format($p->getDataRow("select price from product where id_product='$getId' limit 1"),0,'.',',');  ?>" name="txtGia" id="txtGia" class="w3-input w3-text-blue">
            </div>
        </div>

        <div class="w3-row w3-section">
            <div class="w3-col w3-center " style="width: 30%; margin-top: 8px;"><label for="txtKhuyenmai">Khuyến mãi (%)</label></div>
            <div class="w3-rest">
                <input type="text" readonly="readonly" value="<?php echo $p->getDataRow("select khuyenMai from product where id_product='$getId' limit 1"); ?>" name="txtKhuyenmai" id="txtKhuyenmai" class="w3-input w3-text-blue" min="0" max="100">
            </div>
        </div>

        <div class="w3-row w3-section">
            <div class="w3-col w3-center " style="width: 30%; margin-top: 8px;">Hình sản phẩm</div>
            <div class="w3-rest"> 
                <div class="w3-card">
                    <img src="<?php echo '../'. $p->getDataRow("select image from product where id_product='$getId' limit 1"); ?>" class="w3-round w3-hover-opacity" style="width: 100%;" alt="">
                </div>
            </div>
        </div>

        <div class="w3-row w3-section">
            <div class="w3-col w3-center " style="width: 30%; margin-top: 8px;"><label for="txtMota">Mô tả</label></div>
            <div class="w3-rest">
                <textarea type="textarea" readonly="readonly" style="overflow:auto; resize:none" rows="5" name="txtMota" id="txtMota" class="w3-input w3-text-blue"><?php echo $p->getDataRow("select description from product where id_product='$getId' limit 1"); ?></textarea>
            </div>
        </div>

        <div class="w3-row w3-section">
            <div class="w3-col w3-center " style="width: 30%; margin-top: 8px;"><label for="txtTrangthai">Trạng thái</label></div>
            <div class="w3-rest">
                <!-- <select name="txtTrangthai" id="txtTrangthai" class="w3-select w3-text-blue">
                    <option disabled selected>Chọn trạng thái</option>
                    <option value="1">Còn hàng</option>
                    <option value="2">Hết hàng</option>
                </select> -->
                <input type="text" readonly="readonly" value="<?php echo $p->getDataRow("select satus from product where id_product='$getId' limit 1"); ?>" name="txtTrangthai" id="txtTrangthai" class="w3-input w3-text-blue">
            </div>
        </div>
        <div class="w3-row w3-section w3-center">
            <h1 class="w3-black" style="text-transform: uppercase;">Xác nhận xóa?</h1>
        </div>
        <div class="w3-row">
            <input type="submit" name="btn" value="Xóa" class="w3-half w3-button w3-round w3-block w3-margin w3-red w3-ripple w3-padding">
            <a href="index.php"><input value="Hủy bỏ" class="w3-third w3-right w3-button w3-round w3-block w3-margin w3-blue w3-ripple w3-padding"></a>
        </div>

    </form>
    <?php
    if(isset($_POST['btn'])){
        
        switch($_POST['btn']) {
            case 'Xóa': {
                $hinh = $p->getDataRow("select image from product where id_product='$getId' limit 1");
                $hinh = "../".$hinh;
                if(unlink($hinh)) {
                    if($p->themXoaSua("delete from product where id_product='$getId limit 1'")) {
                        echo '<script>
                            alert("Xóa sản phẩm thành công");
                            window.location.replace("index.php");
                        </script>';
                    }
                    else {
                        echo '<script>
                            alert("Xóa sản phẩm không thành công");
                        </script>';
                    }

                }
                else {
                    echo '<script>
                        alert("Không thể xóa file trên server");
                    </script>';
                }

                break;
            }
        }
    }
    ?>
</body>
</html>