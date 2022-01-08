<?php
class adminLogin {

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

    public function checkLogin($user, $pass) {
        $link = $this->connect();
        $password = mysqli_real_escape_string($link, md5($pass));
        $username = mysqli_real_escape_string($link, preg_replace('/(<^\pL\.\ >+)/u','',$user));
        $sql = sprintf("select admin_username, password, ho, ten from admin where admin_username='%s' and password='%s' limit 1", $username, $password);
        $result = $link->query($sql);
        $i = $result->num_rows;
        if($i == 1) {
            while($row = mysqli_fetch_array($result)) {
                $admin = $row['admin_username'];
                $password = $row['password'];
                $ho = $row['ho'];
                $ten = $row['ten'];
                $_SESSION['admin'] = $admin;
                $_SESSION['admin_password'] = $password;
                $_SESSION['admin_ho'] = $ho;
                $_SESSION['admin_ten'] = $ten;
                return 1;
            }
            
        }
        else {
            return 0;
        }

        
    }

    public function confirmAdminLogin($admin, $pass, $ho, $ten) {
        $link = $this->connect();
        $sql = "select admin_username, password, ho, ten from admin where admin_username='$admin' and password='$pass' and ho='$ho' and ten='$ten'";
        $result = $link->query($sql);
        $i = $result->num_rows;
        if($i != 1) {
            header('location:login.php');
        }
        return 1;
    }
}

?>