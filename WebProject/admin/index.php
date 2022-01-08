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
    <title>Quản lý</title>
    <link rel="stylesheet" href="../css/w3.css">
    <link rel="stylesheet" href="../css/fontawesome.css">
    <link rel="stylesheet" href="../css/admin.css">

</head>

<body class="w3-light-grey">

    <!-- Top container -->
    <div class="w3-bar w3-top w3-black w3-large" style="z-index:4">
        <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" onclick="w3_open();"><i class="fa fa-bars"></i>  Menu</button>
        <a href="../index.php" class="w3-bar-item w3-button w3-hover-blue w3-hover-text-light-grey">  Trang chủ</a>
        <a href="logout.php" class="w3-bar-item w3-btn w3-black w3-hover-blue w3-right">Đăng xuất</a>
    </div>

    <!-- Sidebar/menu -->
    <nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar"><br>
        <div class="w3-container w3-row">
            <div class="w3-col s4">
                <img src="../images/team_01.jpg" class="w3-circle w3-margin-right" style="width:46px; height: 46px;">
            </div>

            <div class="w3-col s8 w3-bar">
                <span>Welcome, <strong><?php echo $_SESSION['admin_ho'].' '.$_SESSION['admin_ten']; ?></strong></span><br>
                <a href="#" class="w3-bar-item w3-button"><i class="fa fa-envelope"></i></a>
                <a href="#" class="w3-bar-item w3-button"><i class="fa fa-user"></i></a>
                <a href="#" class="w3-bar-item w3-button"><i class="fa fa-cog"></i></a>
            </div>
        </div>

        <hr>

        <div class="w3-container">
            <h5>Dashboard</h5>
        </div>

        <div class="w3-bar-block">
            <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Close Menu</a>
            <a href="?show=product" class="w3-bar-item w3-button w3-padding"><i class="fa fa-users fa-fw"></i>  Danh sách sản phẩm</a>
            <a href="?show=user" class="w3-bar-item w3-button w3-padding"><i class="fa fa-eye fa-fw"></i>  Quản lý thành viên</a>
            <a href="?show=order" class="w3-bar-item w3-button w3-padding"><i class="fa fa-diamond fa-fw"></i>  Xem đơn hàng</a>
        </div>
    </nav>


    <!-- Overlay effect when opening sidebar on small screens -->
    <div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

    <!-- !PAGE CONTENT! -->
    <div class="w3-main" style="margin-left:300px;margin-top:43px;">

        <!-- Header -->
        <header class="w3-container" style="padding-top:22px">
            <h5><b><i class="fa fa-dashboard"></i> My Dashboard</b></h5>
        </header>
            <?php
            $show = isset($_GET['show']) ? $_GET['show'] : 'product';
            $itemPerPage = !empty($_REQUEST['itemperpage']) ?  ($_REQUEST['itemperpage'] < 0 ? 20 : $_REQUEST['itemperpage'] ): 20;


                switch($show) {
                    case 'product': {
                        $tongSP = $p->getRow("Select * from product");
                        $tongPage = ceil($tongSP / $itemPerPage);
                        $getPage = !empty($_REQUEST['page']) ? ($_REQUEST['page'] < $tongPage ? ($_REQUEST['page'] > 0 ? $_REQUEST['page'] : 1) : $tongPage) : 1;
                        $offset = ($getPage - 1) * $itemPerPage;
                        $p->loadSanPham("SELECT * FROM product ORDER BY price ASC LIMIT " . $itemPerPage . " OFFSET " . $offset . "");
                        
                        echo '
                            <div class="w3-bar w3-center">
                                <div class="w3-bar">';

                        if ($getPage > 3) {
                            echo '<a href="?show=product&page=1&itemperpage='.$itemPerPage.'" class="w3-bar-item w3-button"><i class="fa fa-angle-double-left"></i></a>';
                        }

                        for ($i = 1; $i <= $tongPage; $i++) {
                            if ($i != $getPage) {
                                if ($i > $getPage - 3 && $i < $getPage + 3) {
                                echo '<a href="?show=product&page=' . $i . '&itemperpage='.$itemPerPage.'" class="w3-bar-item w3-button">' . $i . '</a>';
                                }
                            } 
                            else {
                                echo '<button class="w3-bar-item w3-button w3-green">' . $i . '</button>';
                            }
                        }

                        if ($getPage < $tongPage - 2) {
                            echo '<a href="?show=product&page=' . $tongPage . '&itemperpage='.$itemPerPage.'" class="w3-bar-item w3-button"><i class="fa fa-angle-double-right"></i></a>';
                        }

                        echo '
                                </div>
                            </div>';
                        break;
                    }
                    case 'order': {
                        $tongSP = $p->getRow("Select * from `order`");
                        $tongPage = ceil($tongSP / $itemPerPage);
                        $getPage = !empty($_REQUEST['page']) ? ($_REQUEST['page'] < $tongPage ? ($_REQUEST['page'] > 0 ? $_REQUEST['page'] : 1) : $tongPage) : 1;
                        $offset = ($getPage - 1) * $itemPerPage;                        
                        $p->loadDonHang("SELECT * FROM `order` ORDER BY id ASC LIMIT " . $itemPerPage . " OFFSET " . $offset . "");
                        echo '
                            <div class="w3-bar w3-center">
                                <div class="w3-bar">';

                        if ($getPage > 3) {
                            echo '<a href="?show=order&page=1&itemperpage='.$itemPerPage.'" class="w3-bar-item w3-button"><i class="fa fa-angle-double-left"></i></a>';
                        }

                        for ($i = 1; $i <= $tongPage; $i++) {
                            if ($i != $getPage) {
                                if ($i > $getPage - 3 && $i < $getPage + 3) {
                                echo '<a href="?show=order&page=' . $i . '&itemperpage='.$itemPerPage.'" class="w3-bar-item w3-button">' . $i . '</a>';
                                }
                            } 
                            else {
                                echo '<button class="w3-bar-item w3-button w3-green">' . $i . '</button>';
                            }
                        }

                        if ($getPage < $tongPage - 2) {
                            echo '<a href="?show=order&page=' . $tongPage . '&itemperpage='.$itemPerPage.'" class="w3-bar-item w3-button"><i class="fa fa-angle-double-right"></i></a>';
                        }

                        echo '
                                </div>
                            </div>';
                        break;
                    }
                }
            ?>
        <hr>

        <hr>


        <!-- Footer -->
        <footer class="w3-container w3-padding-16 w3-light-grey">
            <p>Copyright &copy; 2021 Ultimate Laptop Co., Ltd. - Design: 
            <a class="w3-blue" rel="nofollow noopener" style="text-decoration: none;" href="">NOTME</a></p>
        </footer>

        <!-- End page content -->
    </div>


    <script>
        // Get the Sidebar
        var mySidebar = document.getElementById("mySidebar");

        // Get the DIV with overlay effect
        var overlayBg = document.getElementById("myOverlay");

        // Toggle between showing and hiding the sidebar, and add overlay effect
        function w3_open() {
            if (mySidebar.style.display === 'block') {
                mySidebar.style.display = 'none';
                overlayBg.style.display = "none";
            } else {
                mySidebar.style.display = 'block';
                overlayBg.style.display = "block";
            }
        }

        // Close the sidebar with the close button
        function w3_close() {
            mySidebar.style.display = "none";
            overlayBg.style.display = "none";
        }
    </script>
</body>

</html>