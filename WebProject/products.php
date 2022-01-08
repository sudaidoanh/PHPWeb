<?php
session_start();
include("./class/connectSQL.php");
$p = new database();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author">
  <link href="./css/font-family.css" rel="stylesheet">

  <title>Ultimate laptop</title>

  <link href="./css/bootstrap.min.css" rel="stylesheet">
  <script src="./js/jquery-3.6.0.min.js"></script>
  <script src="./js/bootstrap.min.js"></script>

  <script src="./js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="./css/fontawesome.css">
  <link rel="stylesheet" href="./css/layout.css">
  <link rel="stylesheet" href="./css/owl.css">

</head>

<body>

  <div id="preloader">
    <div class="jumper">
      <div></div>
      <div></div>
      <div></div>
    </div>
  </div>


  <!-- Header -->
  <header class="">
    <nav class="navbar navbar-expand-lg">
      <div class="container">
        <a class="navbar-brand" href="index.php">
          <h2>Ultimate <em>Laptop</em></h2>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="index.php">Trang chủ</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="products.php">Sản phẩm
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="about.php">Về chúng tôi</a>
            </li>
            <?php
              
              if (isset($_SESSION['user'])) {
                echo '<li class="nav-item">
                      <div class=" dropdown">
                          <a class="nav-link" href="" id="navbardrop" data-toggle="dropdown">'.$_SESSION['user'].' &nbsp;
                      <i class="fa fa-align-justify"></i></a>
                          <div class="dropdown-menu">
                          <a href="infoUser.php" class="dropdown-item">Thông tin cá nhân</a>
                      <a href="doimatkhau.php" class="dropdown-item">Đổi mật khẩu</a>
                      <a href="logout.php"  class="dropdown-item">Đăng xuất</a>
                          </div>
                </div>';
              } 
              else {
                  echo '<li class="nav-item">
                  <a class="nav-link" href="login.php"">Đăng nhập
                      <i class="fa fa-user"></i>
                      </a>
                  </li>';
              }
          ?>
            <li class="nav-item">
            <a class="nav-link" href="cart.php""><span class=" badge badge-light">
                <?php
                    $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : '';
                    if(!$cart) {
                        echo '0';
                    }
                    else {
                        
                        $item = implode(',', array_unique(explode(',', $cart)));
                        $item = explode(',', $item);
                        foreach($item as $items) {
                            $countItem = $p->getRow("SELECT *
                            FROM product
                            WHERE id_product
                            IN ($cart)");
                        }
                        echo $countItem; 
                    }
                ?>
            </span>&nbsp; Giỏ hàng

                <i class="fa fa-cart-arrow-down"></i>
            </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <nav class="navbar navbar-expand-lg">
      <div class="container">
        <div class="nav-item dropdown">
          <a class="nav-link" href="" id="navbardrop" data-toggle="dropdown">Danh mục hãng &nbsp;
            <i class="fa fa-align-justify"></i></a>
          <div class="dropdown-menu">
            <?php
            $p->loadDanhMuc("Select *from company order by company_name asc");
            ?>
          </div>

        </div>

        <div class="col-md-4 col-xs-4 col-sm-4 col-lg-4 ">
          <marquee behavior="" direction="Left" style="color: #f33f3f; font-weight: bold; font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif; font-size: 20px; ">Bring you the best choice </marquee>
        </div>

        <form action="" method="request" class="form-inline">
          <input type="text" name="txtSearch" placeholder="Tìm kiếm" class="form-control mr-lg-2">
          <button class="btn btn-success" type="submit" value="search">Search</button>
        </form>
      </div>
    </nav>
  </header>

  <!-- Page Content -->
  <div class="page-heading products-heading header-text">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="text-content">
            <h4>new arrivals</h4>
            <h2>Utimate Laptop</h2>
          </div>
        </div>
      </div>
    </div>
  </div>


  <div class="products">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="filters">
            <ul>
              <li class="active" data-filter="*">All Products</li>
              <li data-filter=".des">Sản phẩm nổi bật</li>
              <li data-filter=".dev">Flash Deals</li>
              <li data-filter=".stocking">Còn hàng</li>
            </ul>
          </div>
        </div>

        <?php
        if (isset($_GET['txtSearch'])) {
          $search = $_GET['txtSearch'];
          $p->loadSanPham("SELECT * FROM product where product_name like '%$search%'");
        } else {
          $getid_c = isset($_REQUEST['id']) ? $_REQUEST['id']: '';
          $itemPerPage = 15;
          $tongSP = $p->getRow("Select * from product");
          $tongPage = ceil($tongSP / $itemPerPage);

          $getPage = !empty($_REQUEST['page']) ? ($_REQUEST['page'] < $tongPage ? ($_REQUEST['page'] > 0 ? $_REQUEST['page'] : 1) : $tongPage) : 1;

          $offset = ($getPage - 1) * $itemPerPage;

          if ($getid_c > 0) {
            $name_company = $p->getCol("Select * from company where id_company='$getid_c'", "company_name");
            echo '<div>
                <ul>
                    <li>
                      <h2 style="text-transform: uppercase;">Sản phẩm của ' . $name_company . '</h2>
                    </li>
                  </ul>
            </div>';
            $p->loadSanPham("Select * from product where company_id = '$getid_c' order by price asc");
            echo '
                <div class="col-md-12">
                  <ul class="pagination justify-content-center">
                    <li class="page-item"><a class="text-uppercase" href="products.php">Xem tất cả sản phẩm</a></li>
                  </ul>
                </div>';
          } else {
            echo '
              <div>
                  <ul>
                      <li><h2 style="text-transform: uppercase;">Tất cả sản phẩm</h2></li>
                  </ul>
              </div>';
            $p->loadSanPham("SELECT * FROM product ORDER BY price ASC LIMIT " . $itemPerPage . " OFFSET " . $offset . "");
            echo '<div class="col-md-12">
                <ul class="pages">';

            if ($getPage > 3) {
              echo '<li><a href="?page=1"><i class="fa fa-angle-double-left"></i></a></li>';
            }
            for ($i = 1; $i <= $tongPage; $i++) {
              if ($i != $getPage) {
                if ($i > $getPage - 3 && $i < $getPage + 3) {
                  echo '<li><a href="?page=' . $i . '">' . $i . '</a></li>';
                }
              } else {
                echo '<li class="active"><strong>' . $i . '</strong></li>';
              }
            }

            if ($getPage < $tongPage - 2) {
              echo '<li><a href="?page=' . $tongPage . '"><i class="fa fa-angle-double-right"></i></a></li>';
            }

            echo '</ul>
                </div>';
          }
        }

        ?>

      </div>
    </div>
  </div>


  <footer>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="inner-content">
            <p>Copyright &copy; 2021 Ultimate Laptop Co., Ltd.
              - Design: <a rel="nofollow noopener" href="https://www.google.com/" target="_blank">NOTME</a></p>
          </div>
        </div>
      </div>
    </div>
  </footer>


  <script src="./js/layout.js"></script>
  <script src="./js/owl.js"></script>
  <script src="./js/slick.js"></script>
  <script src="./js/isotope.js"></script>
  <script src="./js/accordions.js"></script>


  <script language="text/Javascript">
    cleared[0] = cleared[1] = cleared[2] = 0;

    function clearField(t) {
      if (!cleared[t.id]) { // function makes it static and global
        cleared[t.id] = 1;
        t.value = '';
        t.style.color = '#fff';
      }
    }
  </script>


</body>

</html>