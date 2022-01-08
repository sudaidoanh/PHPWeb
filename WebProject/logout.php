<?php
session_start();
if (isset($_SESSION['user']) && isset($_SESSION['user_password'])) {
    unset($_SESSION['user']);
    unset($_SESSION['user_password']);
} else {
    header('location:login.php');
}

?>


<!DOCTYPE HTML>
<html lang="en">

<head>
	<title>Đăng Nhập</title>
	<!-- Meta tag Keywords -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Online Login Form Responsive Widget,Login form widgets, Sign up Web forms , Login signup Responsive web form,Flat Pricing table,Flat Drop downs,Registration Forms,News letter Forms,Elements" />
	
	<script src="./js/dangnhap.js"></script>
	<!-- <link rel="stylesheet" href="./css/style.css" type="text/css" media="all" />  -->
	<link rel="stylesheet" href="./css/font-awesome.css"> 
	<link rel="stylesheet" href="./css/style.css">

	<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Dosis:200,300,400,500,600,700,800&amp;subset=latin-ext" rel="stylesheet">

</head>

<body>

	<!-- main -->
	<div class="center-container">
		<!--header-->
		<div class="header-w3l">
			<a href="index.php">
				<h1 style="font-size: 40px; color:blue"> ULTIMATE <am style="color: red; font-size: 100px;">Laptop</am>
				</h1>
			</a>
		</div>
		<!--//header-->
		<div class="main-content-agile">
			<div class="sub-main-w3">
				<div class="wthree-pro">
					<h1 style="color: white; font-size: 35px;">Đăng xuất thành công!</h1>
				</div>

                
				
			</div>
            <a href="login.php" style="text-align: center; ">
                    
                    <button style="border-radius: 6px; border-color: green;"><p style="color: blue; font-size: 50px"><i class="fa fa-arrow-left"></i>
                    Quay lại trang đăng nhập</p></button>
                </a>
		</div>
		
		<div class="footer" style="margin-top: 100px;">
			<p> COPYRIGHT © 2021 ULTIMATE LAPTOP CO., LTD. - DESIGN: NOTME <a href="index.php" style="color: red;">ULTIMATE LAPTOP</a></p>
		</div>
	</div>
</body>
</html>
