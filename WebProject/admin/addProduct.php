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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sản phẩm</title>
    <link rel="stylesheet" href="../css/w3.css">
</head>
<body class="w3-light-grey">
    <form action="" method="POST" class="w3-container w3-display-topmiddle w3-card-4 w3-light-grey w3-text-blue w3-margin" enctype="multipart/form-data" name="form" style="width: 60%">
        <h2 class="w3-center w3-serif">Thêm sản phẩm</h2>
        <a href="index.php" class="w3-display-topright w3-button w3-blue-gray w3 w3-round w3-margin w3-ripple w3-padding">Quay về trang chính</a>

        <div class="w3-row w3-section">
            <div class="w3-col w3-center " style="width: 30%; margin-top: 8px;"><label for="select">Hãng</label></div>
            <div class="w3-rest">
                <?php
                    $p->loadCBCongty("select * from company order by company_name", 0);
                ?>
            </div>
        </div>

        <div class="w3-row w3-section">
            <div class="w3-col w3-center " style="width: 30%; margin-top: 8px;"><label for="txtTensp">Tên sản phẩm</label></div>
            <div class="w3-rest">
                <input type="text" value="" required name="txtTensp" id="txtTensp" class="w3-input w3-text-blue">
            </div>
        </div>

        <div class="w3-row w3-section">
            <div class="w3-col w3-center " style="width: 30%; margin-top: 8px;"><label for="txtGia">Giá (VNĐ)</label></div>
            <div class="w3-rest">
                <input type="number" value="" required name="txtGia" id="txtGia" class="w3-input w3-text-blue">
            </div>
        </div>

        <div class="w3-row w3-section">
            <div class="w3-col w3-center " style="width: 30%; margin-top: 8px;"><label for="txtKhuyenmai">Khuyến mãi (%)</label></div>
            <div class="w3-rest">
                <input type="number" value="" name="txtKhuyenmai" id="txtKhuyenmai" class="w3-input w3-text-blue" min="0" max="100">
            </div>
        </div>

        <div class="w3-row w3-section">
            <div class="w3-col w3-center " style="width: 30%; margin-top: 8px;"><label for="txtNgaynhap">Ngày nhập</label></div>
            <div class="w3-rest">
                <input type="date" value="" required name="txtNgaynhap" id="txtNgaynhap" class="w3-input w3-text-blue" min="0" max="100">
            </div>
        </div>

        <div class="w3-row w3-section">
            <div class="w3-col w3-center " style="width: 30%; margin-top: 8px;"><label for="txtHinh">Hình sản phẩm</label></div>
            <div class="w3-rest">
                <input type="file" accept="image" name="txtHinh" id="txtHinh" onchange="loadFile(event)" class="w3-input w3-text-blue"> 
                <div class="w3-card">
                    <img id="idHinh" class="w3-round w3-hover-opacity" style="width: 100%;" alt="">
                    <script>
                        var loadFile = function(event) {
                            var output = document.getElementById('idHinh');
                            output.src = URL.createObjectURL(event.target.files[0]);
                            output.onload = function() {
                                URL.revokeObjectURL(output.src)
                            }
                        };
                    </script>
                </div>
            </div>
        </div>

        <div class="w3-row w3-section">
            <div class="w3-col w3-center " style="width: 30%; margin-top: 8px;"><label for="txtMota">Mô tả</label></div>
            <div class="w3-rest">
                <textarea type="textarea" required style="overflow:auto; resize:none" rows="5" name="txtMota" id="txtMota" class="w3-input w3-text-blue"></textarea>
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
                <input type="text" value="" required name="txtTrangthai" id="txtTrangthai" class="w3-input w3-text-blue">
            </div>
        </div>
        <div class="w3-row">
            <input type="reset" value="Reset" class="w3-quarter w3-left w3-button w3-round w3-block w3-margin w3-grey w3-ripple w3-padding">
            <input type="submit" name="btn" value="Thêm" class="w3-quarter w3-display-bottommiddle w3-button w3-round w3-block w3-section w3-blue w3-ripple w3-padding">
            <a href="index.php"><input value="Hủy bỏ" class="w3-quarter w3-right w3-button w3-round w3-block w3-margin w3-red w3-ripple w3-padding"></a>
        </div>

    </form>
    <?php
    if(isset($_POST['btn'])) {
        switch($_POST['btn']) {
            case 'Thêm': {
                $name = $_FILES['txtHinh']['name'];
                $type = $_FILES['txtHinh']['type'];
                $tmp_name = $_FILES['txtHinh']['tmp_name'];
                $size = $_FILES['txtHinh']['size'];

                $congTy = $_REQUEST['txtCongty'];
                $tenSP = $_REQUEST['txtTensp'];
                $gia = $_REQUEST['txtGia'];
                $khuyenMai = $_REQUEST['txtKhuyenmai'];
                $mgayNhap = $_REQUEST['txtNgaynhap'];
                $mota = $_REQUEST['txtMota'];
                $trangThai = $_REQUEST['txtTrangthai'];
                $hinhanh = './images/'.$name;
                if($name != '') {
                    if($type == 'image/jpeg' || $type =='image/png') {
                        if($size < (5*1024*1024)) {
                            if($p->uploadfile($name, $tmp_name)) {
                                if($p->themXoaSua("INSERT INTO product (product_name, price, khuyenMai, description, company_id, image, satus) VALUES ('$tenSP', '$gia', '$khuyenMai', '$mota', '$congTy', '$hinhanh', '$trangThai');") == 1){
                                    echo '<script>
                                        alert("Thêm sản phẩm thành công");
                                        window.location.replace("index.php");
                                    </script>';

                                } 
                                else {
                                    echo '<script>
                                        alert("Thêm sản phẩm không thành công");
                                    </script>';
                                }
                            }
                            else {
                                echo '<script>
                                        alert("Thêm file ảnh thất bại");
                                    </script>';
                            }
                        }
                        else {
                            echo '<script>
                                    alert("File lớn hơn 5MB");
                                </script>';
                        }
                    }
                    else {
                        echo '<script>
                            alert("Chỉ cho phép tải lên file ảnh .jpg hoặc .png");
                        </script>';
                    }
                }
                else {
                    echo '<script>
                        alert("Phải thêm hình ảnh");
                    </script>';
                }
                break;
            }
        }
    }
    ?>
</body>
</html>