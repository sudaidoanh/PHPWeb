<?php
include('./class/login.php');
$p = new login();
session_start();
if (isset($_SESSION['user']) && isset($_SESSION['user_password'])) {
    $p->checkLogin($_SESSION['user'], $_SESSION['user_password']);
}else
{
header('location:login.php');
}
include('./class/connectSQL.php');
$q = new database();
?>

<!DOCTYPE HTML>
<html lang="en">

<head>
    <title>Đăng kí</title>
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
    <!-- <link rel="stylesheet" href="css/font-awesome.css"> Font-Awesome-Icons-CSS -->
    <link rel="stylesheet" href="./css/fontawesome.css">
    <!-- <link rel="stylesheet" href="./css/layout.css">  -->
    <link rel="stylesheet" href="./css/owl.css">
    <link rel="stylesheet" href="./css/TTCN.php">

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
                <h1>ULTIMATE <am style="color: red; font-size:30px">Laptop</am>
                </h1>

            </a>
        </div>
        <div class="header-w3l" style="text-align: center;">

        <div class="modal-dialog modal-lg modal-dialog-centered" >
                <div class="modal-content" style="color: aliceblue; background-color: #363535; margin-top: -150px">
                    <form action="" method="POST">
                        <div class="modal-header">
                            <h3 class="modal-title" style="text-align: center;">Thông tin cá nhân</h3>
                        </div>

                        <div class="modal-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-1"></div>
                                    <div class="col-5">
                                        <label for="tenDN">
                                            <p>Tên đăng nhập: </p>
                                        </label>
                                    </div>
                                    <div class="col-5">
                                        <!-- <input type="text" class="form-control" name="txtUser" pattern="^[A-z_](\w|\.|_){6,20}$" title="Bạn đã nhập sai định dạng" id="tenDN" onblur="ktratenDN()">
                                        <p><span id="check_tenDN"></span></p> -->
                                        <?php 
                                            $ten=$_SESSION['user'];
                                            echo $ten ;
                                        ?>
                                    </div>

                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-1"></div>
                                    <div class="col-5">
                                        <label for="sdt">
                                            <p>Số điện thoại: </p>
                                        </label>
                                    </div>
                                    <div class="col-5">
                                       <?php 
                                       $ten=$_SESSION['user'];
                                        if($ten){
                                            $Sdt = "SELECT phone FROM user WHERE user='$ten'";
                                            echo $q->getDataRow($Sdt) ;
                                        }
                                       ?>
                                        
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-1"></div>
                                    <div class="col-5">
                                        <label for="mail">
                                            <p>Email: </p>
                                        </label>
                                    </div>
                                    <div class="col-5">
                                    <?php 
                                       $ten=$_SESSION['user'];
                                        if($ten){
                                            $Email = "SELECT email FROM user WHERE user='$ten'";
                                            echo $q->getDataRow($Email) ;
                                        }
                                       ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-1"></div>
                                    <div class="col-5">
                                        <label for="selectSex">
                                            <p>Giới tính: </p>
                                        </label>
                                    </div>
                                    <div class="col-5">
                                    <?php 
                                       $ten=$_SESSION['user'];
                                        if($ten){
                                            $Sex = "SELECT sex FROM user WHERE user='$ten'";
                                            echo $q->getDataRow($Sex) ;
                                        }
                                    ?>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-1"></div>
                                    <div class="col-5">
                                        <label for="date">
                                            <p>Ngày sinh: </p>
                                        </label>
                                    </div>
                                    <div class="col-5">
                                    <?php 
                                       $ten=$_SESSION['user'];
                                        if($ten){
                                            $Date = "SELECT birth FROM user WHERE user='$ten'";
                                            echo $q->getDataRow($Date) ;
                                        }
                                    ?>
                                    </div>
                                </div>
                            </div>

                         

                          

                        </div>
                        <div class="modal-footer">
                            <button type="button" style="float: left" class="btn btn-info" value="đăng nhập" name=""> <a href="index.php" style="text-decoration: none; color:aliceblue"> Trang chủ</a></button>
                          
                        </div>
                    </form>
                </div>
            </div>
        </div>

       
 
 
 </div>
</body>

</html>