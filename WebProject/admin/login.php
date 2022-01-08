<?php
session_start();
include('../class/adminLogin.php');
$p = new adminLogin();
if (isset($_SESSION['admin']) && isset($_SESSION['admin_password']) && isset($_SESSION['admin_ho']) && isset($_SESSION['admin_ten'])) {
    $p->confirmAdminLogin($_SESSION['admin'], $_SESSION['admin_password'], $_SESSION['admin_ho'], $_SESSION['admin_ten']);
    header('location:index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="../css/w3.css">
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <div id="w3-container">
        <h1 class="w3-center w3-panel w3-blue w3-opacity">Admin Login</h1>
        <form class="w3-display-middle" name="form1" method="post" action="">
            <table class="w3-table w3-border w3-large">
                <tr class="w3-blue">
                    <td colspan="2">
                        <div align="center">Login</div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div align="center"><label class="w3-padding w3-text-black" for="txtUser" style="font-size: 20px;">User Name</label></div>
                    </td>
                    <td>
                        <div align="center">
                            <input class="w3-input w3-border w3-sand" type="text" name="txtUser" id="txtUser">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div align="center"> <label class="w3-padding w3-text-black" for="txtPassword" style="font-size: 20px;">Password</label></div>
                    </td>
                    <td>
                        <div align="center">
                            <input class="w3-input w3-border w3-sand" type="password" name="txtPassword" id="txtPassword">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div align="center">
                            <input class="w3-btn w3-blue" type="reset" value="Reset">
                            <input class="w3-btn w3-blue" type="submit" name="btnSubmit" id="btnSubmit" value="Submit">
                        </div>
                    </td>
                </tr>
            </table>
        </form>
    </div>

    <?php
    if(isset($_REQUEST['btnSubmit'])) {
        $user = $_REQUEST['txtUser'];
        $pass = $_REQUEST['txtPassword'];
        if ($user != '' and $pass != '') {
            if ($p->checklogin($user, $pass)==1) {
                echo '<script>
                        alert("Đăng nhập thành công");
                        window.location.replace(window.location.href);
                    </script>';
            } else {
                echo "<script>alert('Tên tài khoản hoặc mật khẩu không đúng');</script>";
            }
        }
        else {
            echo "<script>alert('Nhập đầy đủ tên đăng nhập và mật khẩu');</script>";
        }
    }
    ?>
    ?>
</body>

</html>