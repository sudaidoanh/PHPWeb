<?php
include('./class/login.php');
$p = new login();
session_start();
if (isset($_SESSION['user']) && isset($_SESSION['user_password'])) {
    $p->checkLogin($_SESSION['user'], $_SESSION['user_password']);
} else {
    header('location:login.php');
}
?>

<!DOCTYPE HTML>
<html lang="en">

<head>
    <title>Ultimate Laptop</title>
    <!-- Meta tag Keywords -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Online Login Form Responsive Widget,Login form widgets, Sign up Web forms , Login signup Responsive web form,Flat Pricing table,Flat Drop downs,Registration Forms,News letter Forms,Elements" />
    <script type="application/x-javascript">
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- Meta tag Keywords -->
    <!-- css files -->
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/fontawesome.css">
    <link rel="stylesheet" href="./css/owl.css">
    <link href="./css/font-family.css" rel="stylesheet">

    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <script src="./js/jquery-3.6.0.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/dangnhap.js"></script>

    <!-- //css files -->
    <!-- online-fonts -->
    <link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Dosis:200,300,400,500,600,700,800&amp;subset=latin-ext" rel="stylesheet">
    <!-- //online-fonts -->

</head>

<body>



    <!-- main -->
    <div class="center-container">
        <!--header-->
        <div class="header-w3l" style="text-align: center;">
            <a href="index.php" style="text-decoration: none;">
                <h2>ULTIMATE <am style="color: red; font-size:30px">Laptop</am>
                </h2>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div>
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content" style="color: aliceblue; background-color: #363535; margin-top:-150px">
                        <form action="" method="POST">
                            <div class="modal-header">
                                <h3 class="modal-title">Đổi mật khẩu</h3>
                            </div>

                            <div class="modal-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-1"></div>
                                        <div class="col-5">
                                            <label for="txtusernameDK">
                                                <p>Nhập tên đăng nhập/user name: </p>
                                            </label>
                                        </div>
                                        <div class="col-5">
                                            <input type="text" class="form-control" name="txtUser" pattern="^[A-z_](\w|\.|_){6,20}$" title="Bạn đã nhập sai định dạng" id="tenDN" onblur="ktratenDN()">
                                            <p><span id="check_tenDN"></span></p>
                                        </div>

                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-1"></div>
                                        <div class="col-5">
                                            <label for="txtemailDK">
                                                <p>Nhập email: </p>
                                            </label>
                                        </div>
                                        <div class="col-5">
                                            <input type="email" class="form-control" name="txtEmail" pattern="^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$|^[0-9]{10}$" title="Bạn đã nhập sai định dạng" id="mail" onblur="ktramail()">
                                            <p><span id="check_mail"></span></p>

                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-1"></div>
                                        <div class="col-5">
                                            <label for="txtpasswordDK">
                                                <p>Nhập mật khẩu cũ: </p>
                                            </label>
                                        </div>
                                        <div class="col-5">
                                            <input type="password" class="form-control" name="txtPass" pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$" title="Bạn đã nhập sai định dạng" id="matkhau" onblur="ktramk()">

                                            <p><span id="check_mk"></span></p>


                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-1"></div>
                                        <div class="col-5">
                                            <label for="txtcheckpasswordDK">
                                                <p>Nhập mật khẩu mới: </p>
                                            </label>
                                        </div>
                                        <div class="col-5">
                                            <input type="password" class="form-control" name="newpass" id="nhaplaimk" />
                                            <p><span id="check_xn"></span></p>

                                        </div>
                                    </div>
                                </div>


                            </div>
                            <div class="modal-footer">
                                <!-- <button type="button" style="float: left" class="btn btn-info" value="đăng nhập" name=""> <a href="pageDN.php" style="text-decoration: none; color:aliceblue"> Đăng nhập</a></button> -->
                                <button type="submit" class="btn btn-info" name="DOI" value="đăng ký">Đổi mật khẩu </button>
                                <?php
                                $oldPass = $_SESSION['user_password'];
                                $oldUser = $_SESSION['user'];

                                if (isset($_POST['DOI'])) {
                                    $user = $_REQUEST['txtUser'];
                                    $MK = md5($_REQUEST['txtPass']);
                                    $new = md5($_REQUEST['newpass']);

                                    if ($user != '' and $MK != '') {

                                        if ($oldPass != $MK or $oldUser != $user) {
                                            echo  "<script> alert('Tên đăng nhập hoặc mật khẩu cũ không chính xác')</script>";
                                        } elseif ($p->DoiMatKhau($oldUser, $new)) {
                                            unset($_SESSION['oldUser']);
                                            unset($_SESSION['oldPass']);
                                        }
                                    } else {
                                        echo  "<script> alert('vui lòng điền vào chỗ trống')</script>";
                                    }
                                }

                                ?>
                                <button type="reset" class="btn btn-info"> Reset </button>


                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--//main-->
    <!--footer-->
    <div class="footer" style="text-align: center; margin-top:-160px">
        <p> COPYRIGHT © 2021 ULTIMATE LAPTOP CO., LTD. - DESIGN: NOTME <a href="index.php" style="color: red;">ULTIMATE LAPTOP</a></p>
    </div>
    <!--//footer-->
    </div>
</body>

</html>