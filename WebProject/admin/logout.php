<?php
session_start();
if (isset($_SESSION['admin']) && isset($_SESSION['admin_password']) && isset($_SESSION['admin_ho']) && isset($_SESSION['admin_ten'])) {
    unset($_SESSION['admin']);
    unset($_SESSION['admin_password']);
    unset($_SESSION['admin_ho']);
    unset($_SESSION['admin_ten']);
} else {
    header('location:login.php');
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/w3.css">
    <link rel="stylesheet" href="../css/fontawesome.css">
</head>

<body>
    <div class="w3-container">
    <a href="../index.php" class="w3-bar-item w3-button w3-hover-blue w3-hover-text-light-grey">  Trang chủ</a>

        <div class="w3-display-middle">
            <p class="w3-xxlarge w3-wide">Đăng xuất thành công</p>
            <a class="w3-button w3-white w3-round"  href="login.php" style="margin-left: 130px;">
                <i class="fa fa-arrow-left" aria-hidden="true"></i>
                Quay lại trang quản lý
            </a>
        </div>
        
    </div>
    
</body>

</html>