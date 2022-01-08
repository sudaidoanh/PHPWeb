<?php
class login {

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

     function DK($user,$pass,$phone,$email,$sex,$date)
     {
          $connect = $this->connect();
          $PASS = md5($pass);
          
          $Name = "SELECT user FROM user WHERE user='$user'";
          $Email = "SELECT email FROM user WHERE email='$email'";
          $Sdt = "SELECT phone FROM user WHERE phone='$phone'";

          $sql2 = ("INSERT INTO user (user, password, phone, email, sex , birth) VALUES ('$user','$PASS', '$phone', '$email', '$sex', '$date')");

          $KTUser= mysqli_query($connect,$Name);
          $KTEmail=mysqli_query($connect,$Email);
          $KTSdt=mysqli_query($connect,$Sdt);

          if (mysqli_num_rows($KTUser)>0) {
               echo  "<script> alert('Tên đăng nhập đã tồn tại ')</script>";
               return 0;
               }
          if (mysqli_num_rows($KTSdt)>0) {
               echo  "<script> alert('Số điện thoại đã tồn tại ')</script>";
               return 0;
          }
          if (mysqli_num_rows($KTEmail)>0) {
               echo  "<script> alert('Tên Email đã tồn tại ')</script>";
               return 0;
          } 
          
          if ($connect->query($sql2)) {
               return 1;
          }
          else {
               return 0;
          }
          
     }
     public function checkLogin($user, $pass) {
          $link = $this->connect();
          $password = mysqli_real_escape_string($link, md5($pass));
          $username = mysqli_real_escape_string($link, preg_replace('/(<^\pL\.\ >+)/u','',$user));
          $sql = sprintf("select id_user, user, password from user where user='%s' and password='%s' limit 1", $username, $password);
          $result = $link->query($sql);
          $i = $result->num_rows;
          if($i == 1) {
               while($row = mysqli_fetch_array($result)) {
               $id = $row['id_user']; 
               $user = $row['user'];
               $password = $row['password'];
               session_start();
               $_SESSION['user_id'] = $id;
               $_SESSION['user'] = $user;
               $_SESSION['user_password'] = $password;
               return 1;
               }
          }
          else {
               return 0;
          }
          
      }

      public function confirmAdminLogin($user, $pass) {
          $link = $this->connect();
          $sql = "select * from user where user='$user' and password='$pass' limit 1";
          $result = $link->query($sql);
          $i = mysqli_num_rows($result);
          if($i != 1) {
              header('location:login.php');
          }
          header('location:index.php');
     }

     public function DoiMatKhau($oldU,$new)
     {
          $link = $this->connect();
          $sql = "UPDATE user SET password = '$new' where user = '$oldU' ";
          $reuslt= $link->query($sql);
          if($sql)
          {
               echo  "<script> alert('Đổi mật khẩu thành công')</script>";
               return 1;
          }
          else {
               echo  "<script> alert('Thông tin sai')</script>";
               return 0;
               
          }
          
     }
}
