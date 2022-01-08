<?php
class database {
    private function connect() {
        $con = new mysqli("localhost", "id18135189_admin", "123456789aA@");
        if(!$con) {
            echo 'Cant connect to database';
            exit();
        }
        else {
            $con->select_db("id18135189_ptudwebtestdata");
            $con->query("SET NAMES UTF8");
            return $con;
        }
    }

    public function loadDanhMuc($sql) {
        $link = $this->connect();
        $result = $link->query($sql);
        mysqli_close($link);
        $i = mysqli_num_rows($result);
        if($i > 0 ) {
            while($row = mysqli_fetch_array($result)) {
                $id = $row['id_company'];
                $name = $row['company_name'];
                echo '<a href="'.$_REQUEST['URL'].'?id='.$id.'" class="dropdown-item">'.$name.'</a>';
            }
        }
    }

    public function loadSanPham($sql) {
        $link = $this->connect();
        $result = $link->query($sql);
        mysqli_close($link);
        $i = $result->num_rows;
        $count = 1;
        if($i > 0 ) {
            echo '<div class="w3-container">
                   
                    <h5>Danh mục sản phẩm
                    <a href="addProduct.php" class="w3-btn w3-blue w3-round w3-right w3-margin"><b>Thêm sản phẩm</b></a> </h5>
                    
                    
                    <table class="w3-table w3-striped w3-bordered w3-border w3-hoverable w3-white">
                        <tr class="w3-hover-none">
                            <th width="35">STT</th>
                            <th width="160">Tên sản phẩm</th>
                            <th width="130">Giá</th>
                            <th width="90">Khuyến mãi</th>
                            <th width="210">Mô tả</th>
                            <th width="90">Trạng thái</th>
                            <th width="40">Sửa</th>
                            <th width="40">Xóa</th>
                        </tr>';
            while($row = mysqli_fetch_array($result)) {
                $id_product = $row['id_product'];
                $product_name = $row['product_name'];
                $price = $row['price'];
                $desr = $row['description'];
                $company_id = $row['company_id'];
                $image = $row['image'];
                $status = $row['satus'];
                $khuyenMai = $row['khuyenMai'];
                echo '<tr>
                        <td>'.$count.'</td>
                        <td>'.$product_name.'</td>
                        <td>'.number_format($price, 0,'.',',').' VND</td>
                        <td>'.$khuyenMai.' %</td>
                        <td><textarea style="overflow:auto; resize:none" rows="5" cols="30" readonly="readonly">'.$desr.'</textarea></td>
                        
                        <td>'.$status.'</td>
                        <td><a href="editProduct.php?id='.$id_product.'"><i class="fa fa-exchange" aria-hidden="true"></i></a></td>
                        <td><a href="deleteProduct.php?id='.$id_product.'"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                    </tr>';
                $count ++;
            }
            echo '</table><br>
            </div>';
        }
        else {
            echo 'Updating data...';
        }
    }
    
        public function loadDonHang($sql) {
        $link = $this->connect();
        $result = $link->query($sql);
        mysqli_close($link);
        $i = $result->num_rows;
        $count = 1;
        if($i > 0 ) {
            echo '<div class="w3-container">
                   
                    <h5>Danh mục đơn hàng                    
                    
                    <table class="w3-table w3-striped w3-bordered w3-border w3-hoverable w3-white">
                        <tr class="w3-hover-none">
                            <th>STT</th>
                            <th>ID đơn hàng</th>
                            <th>Số điẹn thoại</th>
                            <th>Tổng tiền</th>
                            <th>Ngày tạo đơn</th>
                            <th>Trạng thái</th>
                            <th>Địa chỉ giao hàng</th>
                            <th>Xem</th>
                        </tr>';
            while($row = mysqli_fetch_array($result)) {
                $id = $row['id'];
                $phone = $row['phone'];
                $total = $row['total'];
                $day = $row['purchase_date'];
                $diachi = $row['delivery_address'];
                $status = $row['status'];
                echo '<tr>
                        <td>'.$count.'</td>
                        <td>'.$id.'</td>
                        <td>'.$phone.'</td>
                        <td>'.number_format($total, 0,'.',',').' VND</td>
                        <td>'.$day.'</td>
                        <td>'.$status.'</td>
                        <td>'.$diachi.'</td>
                        <td><a href="orderDetail.php?id='.$id.'"><i class="fa fa-exchange" aria-hidden="true"></i></a></td>
                    </tr>';
                $count ++;
            }
            echo '</table><br>
            </div>';
        }
        else {
            echo 'Updating data...';
        }
    }
    
    public function loadChiTiet($sql) {
        $link = $this->connect();
        $result = $link->query($sql);
        mysqli_close($link);
        $i = $result->num_rows;
        $count = 1;
        if($i > 0 ) {
            echo '<div class="w3-container">                   
                    <table class="w3-table w3-striped w3-bordered w3-border w3-hoverable w3-white">
                        <tr class="w3-hover-none">
                            <th>STT</th>
                            <th>ID sản phẩm</th>
                            <th>Tên sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Giá tiền</th>
                            <th>Ngày đặt hàng</th>
                        </tr>';
            while($row = mysqli_fetch_array($result)) {
                $id = $row['product_id'];
                $soluong = $row['quantity'];
                $gia = $row['price'];
                $day = $row['date_created'];
                $getTen = $this->getDataRow("select product_name from product where id_product='$id' limit 1");
                echo '<tr>
                        <td>'.$count.'</td>
                        <td>'.$id.'</td>
                        <td><a href="../detail.php?id='.$id.'">'.$getTen.'</a></td>
                        <td>'.$soluong.'</td>
                        <td>'.number_format($gia, 0,'.',',').' VND</td>
                        <td>'.$day.'</td>
                    </tr>';
                $count ++;
            }
            echo '</table><br>
            </div>';
        }
        else {
            echo 'Updating data...';
        }
    }

    public function getRow($sql) {
        $link = $this->connect();
        $result = $link->query($sql);
        mysqli_close($link);
        $i = $result->num_rows;
        return $i;
    }

    public function getDataRow($sql) {
        $link = $this->connect();
        $result = $link->query($sql);
        mysqli_close($link);
        $i = $result->num_rows;
        $resultS = '';
        if($i > 0) {
            while($row = mysqli_fetch_array($result)) {
                $resultS = $row[0];
            }
        }
        return $resultS;
    }

    public function loadCBCongty($sql, $idCt) {
        $link = $this->connect();
        $result = $link->query($sql);
        mysqli_close($link);
        $i = $result->num_rows;
        if($i > 0) {
            echo '
            <select name="txtCongty" id="select" required class="w3-select w3-text-blue">
                <option value="" disabled selected>Chọn công ty</option>';
            while($row = mysqli_fetch_array($result)) {
                $id = $row['id_company'];
                $ten = $row['company_name'];
                if($id == $idCt) {
                    echo '<option value="'.$id.'" selected="selected">'.$ten.'</option>';
                }
                else {
                    echo '<option value="'.$id.'">'.$ten.'</option>';
                }
            }
            echo '</select>';
        }
    }

    public function themXoaSua($sql) {
        $link = $this->connect();
        if($link->query($sql)) {
            return 1;
        }
        else {
            return 0;
        }
    }

    function uploadfile($name, $tmp_name) {
        if($name != '') {
            $temp = time();
            $filePath = "../images/".$name;
            if (move_uploaded_file($tmp_name, $filePath)) {
                return 1;
            }
            else {
                return 0;
            }
        }
        else {
            return 0;
        }
    }
}

?>