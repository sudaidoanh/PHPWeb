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
                echo '<a href="products.php?id='.$id.'" class="dropdown-item">'.$name.'</a>';
            }
        }
    }    

    public function loadSanPham($sql) {
        
        echo '<div class="col-md-12">
                <div class="filters-content">
                    <div class="row grid">
              ';
        $link = $this->connect();
        $result = mysqli_query($link, $sql);
        mysqli_close($link);
        $i = mysqli_num_rows($result);
        if($i > 0 ) {
            
            while($row = mysqli_fetch_array($result)) {
                $id_product = $row['id_product'];
                $product_name = $row['product_name'];
                $price = $row['price'];
                $khuyenMai = $row['khuyenMai'];
                $desr = $row['description'];
                $company_id = $row['company_id'];
                $image = $row['image'];
                $status = $row['satus'];
                $status1 = ($status == "Còn hàng"? "stocking" : "none");
                $khuyenMai1 = ($khuyenMai != 0? "dev" : "none");
                echo '
                    <div class="col-lg-3 col-md-3 all des '.$khuyenMai1.' '.$status1.'">
                        <div class="product-item" style="height: 300px;">
                        <img src="'.$image.'" alt="">
                        <div class="down-content">  
                            <a href="detail.php?id='.$id_product.'">
                                <h6>'.$product_name.'</h6>
                                <span>Chi tiết</span>
                            </a>
                            <h5>'.number_format($price, 0,'.',',').' VND</h5>
                            <h4>'.number_format($price-$price*$khuyenMai/100, 0,'.',',').' VND</h4>
                            <a class="input" href="cart.php?action=add&id='.$id_product.'">Giỏ hàng</a>
                        </div>
                        </div>
                    </div> ';
            }
        }
        else {
            echo 'Updating data...';
        }
        echo '   
                    </div>
                </div>
            </div>';
    }

    public function getRow($sql) {
        $link = $this->connect();
        $result = $link->query($sql);
        mysqli_close($link);
        $i = $result->num_rows;
        
        return $i;
    }

    public function getCol($sql, $nameCol) {
        $link = $this->connect();
        $result = $link->query($sql);
        mysqli_close($link);
        $i = $result->num_rows;
        if ($i > 0) {
            while($row = mysqli_fetch_array($result)) {
                $col = $row[$nameCol];
            }
        }
        else {
            echo 'Cant select col';
        }
        return $col;
    }

    public function loadKhuyenMai($sql) {
        $link = $this->connect();
        
        $resultS = $link->query($sql);
        mysqli_close($link);
        $j = $resultS->num_rows;
                if($j > 0) {
                    while ($rowS = mysqli_fetch_array($resultS)) {
                        $id_product = $rowS['id_product'];
                        $product_name = $rowS['product_name'];
                        $price = $rowS['price'];
                        $khuyenMai = $rowS['khuyenMai'];
                        $desr = $rowS['description'];
                        $image = $rowS['image'];
                        
                        echo '
                            <div class="col-lg-3 col-md-3">
                                <div class="product-item" style="height: 300px;">
                                <img src="'.$image.'" alt="">
                                <div class="down-content">  
                                <a href="detail.php?id='.$id_product.'">
                                        <h6>'.$product_name.'</h6>
                                        <span>Chi tiết</span>
                                    </a>
                                    <h5>'.number_format($price, 0,'.',',').' VND</h5>
                                    <h4>'.number_format($price-$price*$khuyenMai/100, 0,'.',',').' VND</h4>
                                    <a class="input" href="cart.php?action=add&id='.$id_product.'">Giỏ hàng</a>
                                </div>
                                </div>
                            </div> ';
                    }
                    
                }
        else {
            echo 'Updating data...';
        }
        
    }

    public function loadComboSP($sql) {
        $link = $this->connect();
        $result = $link->query($sql);
        
        $i = $result->num_rows;
        if($i > 0) {
            
            while ($row = mysqli_fetch_array($result)) {
                $id_company = $row['id_company'];
                $name_company = $row['company_name'];
                echo    '
                <div class="row">;
                    <div class="col-md-12">
                        <div class="section-heading">
                            <h2 id="'.$id_company.'" style="text-transform: uppercase;">'.$name_company.'</h2>
                            <a href="products.php?id='.$id_company.'">Tất cả sản phẩm <i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>';

                $resultS = $link->query("Select * from product where company_id = '$id_company' order by price asc limit 5");
                $j = $resultS->num_rows;
                if($j > 0) {
                    while ($rowS = mysqli_fetch_array($resultS)) {
                        $id_product = $rowS['id_product'];
                        $product_name = $rowS['product_name'];
                        $price = $rowS['price'];
                        $khuyenMai = $rowS['khuyenMai'];
                        $desr = $rowS['description'];
                        $image = $rowS['image'];
                        $status = $rowS['satus'];
                        $status1 = ($status == "Còn hàng"? "stocking" : "none");                        
                        $khuyenMai1 = ($khuyenMai != ''? "dev" : "none");
                        echo '
                            <div class="col-lg-3 col-md-3 all des '.$khuyenMai1.' '.$status1.'">
                                <div class="product-item" style="height: 300px;">
                                <img src="'.$image.'" alt="">
                                <div class="down-content">  
                                <a href="detail.php?id='.$id_product.'">
                                        <h6>'.$product_name.'</h6>
                                        <span>Chi tiết</span>
                                    </a>
                                    <h5>'.number_format($price, 0,'.',',').' VND</h5>
                                    <h4>'.number_format($price-$price*$khuyenMai/100, 0,'.',',').' VND</h4>
                                    <a class="input" href="cart.php?action=add&id='.$id_product.'">Giỏ hàng</a>
                                </div>
                                </div>
                            </div> ';
                    }
                    echo '</div>';
                }
                else {
                    echo 'No data in row company';
                }

                
            }
        }
        else {
            echo 'Updating data...';
        }
        mysqli_close($link);
    }

    public function loadChiTietSP($sql) {
        echo '
        <div class="detail-features">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-heading">
                            <h2>Chi tiết sản phẩm</h2>
                            <i class="fa fa-long-arrow-right" aria-hidden="true" style="margin-left: 30px;"></i>';
        $link = $this->connect();
        $result = $link->query($sql);
        
        $i = $result->num_rows;
        if($i > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $id_product = $row['id_product'];
                $product_name = $row['product_name'];
                $price = $row['price'];
                $khuyenMai = $row['khuyenMai'];
                $desr = $row['description'];
                $image = $row['image'];
                $status = $row['satus'];

                $id_company = $row['company_id'];
               

                $resultS = $link->query("Select * from company where id_company = '$id_company' limit 1");
                $j = $resultS->num_rows;
                if($j > 0) {
                    while ($rowS = mysqli_fetch_array($resultS)) {
                        $id_company = $rowS['id_company'];
                        $name_company = $rowS['company_name'];
                        echo '
                        <a href="products.php?id='.$id_company.'">'.$name_company.'</a>
                        ';
                    }
                    
                }
                else {
                    echo 'No data in row company';
                }
                echo '      <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                            <a href="">'.$product_name.'</a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="right-image">
                            <img src="'.$image.'" style="width: 90%;margin-top: 80px;" alt="">
                            <h3>Giá:'.number_format($price, 0,'.',',').' VND</h3>
                            <h3>Giá khuyến mãi: '.number_format($price-$price*$khuyenMai/100, 0,'.',',').' VND.</h3>
                            <a class="btn btn-outline-primary" style="margin-left: 60%; margin-top: 50px" href="cart.php?action=add&id='.$id_product.'">Giỏ hàng</a>
                        </div>
                    </div>
                    <div class="col-md-6">
                    <div class="left-content">
                        <h4>Thông số sản phẩm</h4>
                        <p>'.$desr.'</p>';
            }
        }
        else {
            echo 'Updating data...';
        }
        echo ' </div>
            </div>
        </div>
        </div>
    </div>';
        mysqli_close($link);
    }
    
    public function loadCart($sql, $count) {
        $link = $this->connect();
        $result = $link->query($sql);
        mysqli_close($link);
        $i = $result->num_rows;
        if($i > 0) {
            echo '
            
                <tr style="text-align: center;">';
            while ($row = mysqli_fetch_array($result)) {
                $id_product = $row['id_product'];
                $product_name = $row['product_name'];
                $price = $row['price'];
                $image = $row['image'];

                $id_company = $row['company_id'];
                $soluong = isset($_POST['txtSoluong'.$count.''])? $_POST['txtSoluong'.$count.''] : 1;
                echo '  
                    <th>'.$count.'</th>
                    <th><img src="'.$image.'" style="width: 100%;" alt=""></th>
                    <th><a href="detail.php?id='.$id_product.'">'.$product_name.'</a></th>
                    <th><input class="col-7" type="number" name="txtSoluong'.$count.'" min="0" id="cartsoluong" value="'.$soluong.'"></th>
                    <th><input type="number" name="txtGia'.$count.'" value="'.$price.'" title="'.number_format($price, 0, '.' ,',').' VND" readonly style="width: 100px; text-align: center;"></th>
                    <th><input type="number" name="txtTong" value="'.$price*$soluong.'" title="'.number_format($price*$soluong, 0, '.' ,',').' VND" readonly style="width: 100px; text-align: center;"></th>
                ';
            }
            echo '<th><a href="cart.php?action=delete&id='.$id_product.'"><i class="fa fa-trash"></i></a></th>';
            echo '  </tr>
                ';
            return 1;
        } 
        else {
            return 0;
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
    
    public function them($sql) {
        $link = $this->connect();
        $link->query($sql);
        mysqli_close($link);
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
}
