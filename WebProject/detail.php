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
    <header class="" >
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="index.php">
                    <h2>Ultimate <em>Laptop</em></h2>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                    aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php">Trang chủ
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="products.php">Sản phẩm</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Về chúng tôi</a>
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
            <div class="container" >
                <div class="nav-item dropdown">
                    <a class="nav-link" href="" id="navbardrop" data-toggle="dropdown">Danh mục hãng &nbsp; 
                        <i class="fa fa-align-justify"></i></a>
                    <div class="dropdown-menu">
                        <?php
                            $p->loadDanhMuc("select * from company order by company_name asc");
                        ?>
                    </div>

                </div>

                <div class="col-md-4 col-xs-4 col-sm-4 col-lg-4 ">
                    <marquee behavior="" direction="Left" style="color: #f33f3f; font-weight: bold; font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif; font-size: 20px; ">Bring you the best choice </marquee>
                </div>

                <form action="products.php" method="request" class="form-inline">
                    <input type="text"  name="txtSearch" placeholder="Tìm kiếm" class="form-control mr-lg-2">
                    <button class="btn btn-success" type="submit" value="search">Search</button>
                </form>
            </div>
        </nav>
    </header>

    <?php
        $getId = $_REQUEST['id'];
        $p->loadChiTietSP("select * from product where id_product='$getId' limit 1");
    ?>

    <div class="best-features">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-heading">
                        <h2>Laptop chất lượng với <b>Utimate Laptop</b></h2>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="left-content">
                        <h4>Bạn đang tìm kiếm 1 chiếc laptop chất lượng phù hợp với nhu cầu sử dụng?</h4>
                        <h6><b>Địa chỉ:</b> 12 Nguyễn Văn Bảo, phường 4, quận Gò Vấp, thành phố Hồ Chí Minh</h6>
                        <h6><b>Email:</b> <a href="mailto:ultimate-laptop@gmail.com" class="fa fa-mail-forward"> &nbsp; ultimate-laptop@gmail.com</a> </h6>
                        <h6><b>Hotline:</b> 190019xx </h6>

                        <a href="" class="filled-button">Về chúng tôi</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="middle-content">
                        <h3>Hệ thống tổng đài miễn phí: <p>(Làm việc từ 9h-18h)</p></h3>
                        <p>- Gọi mua hàng: <b>1900100x</b></p>
                        <p>- Chăm sóc khách hàng: <b>1900190x</b></p>
                        <ul class="featured-list">
                            <li><a href="#">Chính sách bảo hành</a></li>
                            <li><a href="#">Chính sách vận chuyển</a></li>
                            <li><a href="#">Chính sách thanh toán</a></li>
                            <li><a href="#">Chính sách bảo mật</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="right-image">
                        <img src="./images/feature-image.jpg" alt="">
                    </div>
                </div>
            </div>
            
        </div>
    </div>


    <div class="call-to-action">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="inner-content">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="./images/dathongbaobocongthuong.png" height="150px" width="310" alt="">
                            </div>
                            <div class="col-md-4">
                                <iframe width="504" height="283" src="https://www.youtube.com/embed/J2X5mJ3HDYE" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                            <div class="col-md-4">
                                <a href="#1" class="filled-button">Về đầu trang
                                    <i class="fa fa-chevron-circle-up"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="inner-content">
                        <p>Copyright &copy; 2021 Ultimate Laptop Co., Ltd.
                            - Design: <a rel="nofollow noopener" href="" target="_blank">NOTME</a></p>
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
            if (!cleared[t.id]) {                      // function makes it static and global
                cleared[t.id] = 1;
                t.value = '';
                t.style.color = '#fff';
            }
        }
    </script>

</body>
</html>