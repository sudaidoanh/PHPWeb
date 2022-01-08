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
    <title>Xem đơn hàng</title>
    <link rel="stylesheet" href="../css/w3.css">
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body class="w3-light-grey">
    <form action="" method="POST" class="w3-container w3-display-topmiddle w3-card-4 w3-light-grey w3-text-blue w3-margin" enctype="multipart/form-data" name="form" style="width: 60%">
        <h2 class="w3-center w3-serif">Xem chi tiết đơn hàng</h2>
        <a href="index.php?show=order" class="w3-display-topright w3-button w3-blue-gray w3 w3-round w3-margin w3-ripple w3-padding">Quay về trang chính</a>
        <div class="w3-row w3-section">
            <div class="w3-col w3-center " style="width: 30%; margin-top: 8px;"><label for="txtId">Mã đơn hàng (Chỉ xem) </label></div>
            <div class="w3-rest"> <p style="text-align: center;"></p>
                <input type="text" readonly value="<?php echo $_GET['id']; ?>"  id="txtId" class="w3-input w3-text-blue">
            </div>
        </div>

        <div class="w3-row w3-section">
            <div class="w3-col w3-center " style="width: 30%; margin-top: 8px;"><label for="txtSodt">Số điện thoại (Chỉ xem) </label></div>
            <div class="w3-rest">
                <input type="text" readonly value="<?php echo $p->getDataRow("select phone from `order` where id='$getId' limit 1"); ?>" id="txtSodt" class="w3-input w3-text-blue">
            </div>
        </div>

        <div class="w3-row w3-section">
            <div class="w3-col w3-center " style="width: 30%; margin-top: 8px;"><label for="txtGia">Tổng tiền (VNĐ) (Chỉ xem)</label></div>
            <div class="w3-rest">
                <input type="text" readonly value="<?php echo number_format($p->getDataRow("select total from `order` where id='$getId' limit 1"), 0, '.',','); ?>" id="txtGia" class="w3-input w3-text-blue">
            </div>
        </div>

        <div class="w3-row w3-section">
            <div class="w3-col w3-center " style="width: 30%; margin-top: 8px;"><label for="txtNgaytao">Ngày tạo đơn (Chỉ xem) </label></div>
            <div class="w3-rest">
                <input type="text" readonly value="<?php echo $p->getDataRow("select purchase_date from `order` where id='$getId' limit 1"); ?>" id="txtNgaytao" class="w3-input w3-text-blue">
            </div>
        </div>

        <div class="w3-row w3-section">
            <div class="w3-col w3-center " style="width: 30%; margin-top: 8px;"><label for="txtDiachi">Địa chỉ giao hàng </label></div>
            <div class="w3-rest">
                <input type="text" value="<?php echo $p->getDataRow("select delivery_address from `order` where id='$getId' limit 1"); ?>" name="txtDiachi" id="txtDiachi" class="w3-input w3-text-blue">
            </div>
        </div>

        <div class="w3-row w3-section">
            <div class="w3-col w3-center " style="width: 30%; margin-top: 8px;"><label for="txtTrangthai">Trạng thái</label></div>
            <div class="w3-rest">
                <input type="text" value="<?php echo $p->getDataRow("select status from `order` where id='$getId' limit 1"); ?>" name="txtTrangthai" id="txtTrangthai" class="w3-input w3-text-blue">
            </div>
        </div>

        <div class="w3-row w3-section">
            <div class="w3-center w3-panel w3-orange "><strong>Các sản phẩm trong đơn hàng này:</strong> </div>
        </div>

        <?php 
            $p->loadChiTiet("select * from order_detail where order_id='$getId'");
        ?>

        <div class="w3-row w3-section">
            <input type="submit" name="btn" value="Xác nhận" class="w3-button w3-round w3-block w3-margin w3-blue w3-ripple w3-padding">
        </div>
    </form>
    <?php
        if(isset($_POST['btn'])) {
            switch($_POST['btn']) {
                case 'Xác nhận': {
                    $diaChi = $_REQUEST['txtDiachi'];
                    $trangThai = $_REQUEST['txtTrangthai'];
                    if($diaChi != '' && $trangThai != '') {
                        if($p->themXoaSua("UPDATE `order` SET `delivery_address` = '$diaChi', `status` = '$trangThai' WHERE `order`.`id` = $getId;")) {
                            echo '<script>
                                alert("Sửa thông tin đơn hàng thành công");
                                window.location.replace(window.location.href);
                            </script>';
                        } 
                        else {
                            echo '<script>
                                alert("Sửa thông tin đơn hàng thất bại");
                            </script>';
                        }
                    }
                    else {
                        echo '<script>
                            alert("Nhập đầy đủ địa chỉ và trạng thái");
                        </script>';
                    }
                }
    
                break;
            }
        }
        
    ?>
</body>
</html>