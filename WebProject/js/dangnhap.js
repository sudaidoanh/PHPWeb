
function ktratenDN(){
    var hoten= document.getElementById("tenDN").value;
    var rehoten=/^[A-z_](\w|\.|_){6,20}$/;
    if(rehoten.test(hoten)==false){
        document.getElementById("check_tenDN").innerHTML="Từ 6-20 kí tự không bao gồm kí tự đặc biệt";
        return false;
    }else{
        document.getElementById("check_tenDN").innerHTML=""; 
        return true;
    }
}

function ktrasdt(){
    var sdt = document.getElementById("sdt").value;
    var check = /^(0[0-9\s.-]{9,13})$/;
    if (check.test(sdt)==false){
        document.getElementById("check_sdt").innerHTML=" 9 đến 13 chữ số";
    }else
    {
        document.getElementById("check_sdt").innerHTML="";
    }

}

function ktramail(){
    var check = /^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$|^[0-9]{10}$/;
    var mail = document.getElementById("mail").value;
    if (check.test(mail) == false){
        document.getElementById("check_mail").innerHTML = "Email không hợp lệ";
        return false;
    } else{
        document.getElementById("check_mail").innerHTML = "";
        return true;
    }
}

function ktraDate(){
    var d= new Date();
    var ngaysinh = document.getElementById("date").value;
     ngaysinh= new Date(ngaysinh);
     if(ngaysinh>d){
         document.getElementById("check_date").innerHTML="Bạn chưa ra đời hả?";
         return false;
     }else{
        document.getElementById("check_date").innerHTML="";
        return true;
     }
}


function ktramk(){
    var remk = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
    var matkhau = document.getElementById("matkhau").value;
    if (remk.test(matkhau) == false){
        document.getElementById("check_mk").innerHTML = "Ít nhất 8 kí tự và có chữ số";
        return false;
    } else{
        document.getElementById("check_mk").innerHTML = "";
        return true;
    }
}

function xacnhanmk(){
    var xacnhanmk = document.getElementById("nhaplaimk").value;
    var matkhau = document.getElementById("matkhau").value;
    if (xacnhanmk == matkhau){
        document.getElementById("check_xn").innerHTML = "";
        return true;
    } else{
        document.getElementById("check_xn").innerHTML = "Mật khẩu không khớp, vui lòng nhập lại";
        return false;
    }
}

function dangxuat(){
    document.getElementById("DN").innerHTML="&nbsp;&nbsp;Đăng Nhập";
    document.getElementById("DangXuat").style.display="none";
    document.getElementById("dki").style.display="";
    document.getElementById("dnhap").style.display="";
    document.getElementById("cancel").style.display="";

}


