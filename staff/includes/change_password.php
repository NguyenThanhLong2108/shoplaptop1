<?php
    require_once('./includes/include.php');
    require_once('./includes/conn.php');
    if(isset($_POST['change_pass'])){
        Check_f5($_POST['change_pass']);
    }
?>
<div class="form_box">
    <script>
        const Check_pass = function () {
            let matkhaumoi = document.getElementById('matkhaumoi').value;
            let xacnhanmk = document.getElementById('xacnhanmk').value;
            if(matkhaumoi == xacnhanmk){
                document.getElementById('kiemtramk').style.color = 'green';
                document.getElementById('kiemtramk').innerHTML = 'trùng khớp';
            } else {
                document.getElementById('kiemtramk').style.color = 'red';
                document.getElementById('kiemtramk').innerHTML = 'không trùng khớp';
            }
        }

        const Check_all = function() {
            let matkhaumoi = document.getElementById('matkhaumoi').value;
            let xacnhanmk = document.getElementById('xacnhanmk').value;
            if(matkhaumoi != xacnhanmk){
                alert("Nhập lại mật khẩu phải trùng khớp với mật khẩu");
                return false;
            }
        }
    </script>
    <h2>Sửa sản phẩm</h2>
    <div class="border_bottom"></div>
    <!--/.border_bottom -->
    <form method="post" onsubmit="return Check_all()" enctype="multipart/form-data">
        <table align="center" width="100%">
            <tr>
                <td><b>Mật khẩu cũ:</b></td>
                <td><input type="password" name="matkhaucu" id="matkhaucu" size="60" required/></td>
            </tr>
            <tr>
                <td><b>Mật khẩu mới:</b></td>
                <td><input type="password" name="matkhaumoi" id="matkhaumoi" required /></td>
            </tr>
            <tr>
                <td><b>Nhập lại mật khẩu:</b></td>
                <td>
                    <input type="password" name="xacnhanmk" id="xacnhanmk" onkeyup="Check_pass()" required />
                    <span id="kiemtramk"></span>
                </td>
            </tr>
            <tr>
                <td colspan="3" class="text-center"><input class="btn btn-primary btn-submit" type="submit"
                        name="change_pass" value="Lưu" /></td>
            </tr>
        </table>
    </form>
</div>

<?php 
    if(isset($_POST['change_pass'])){
        $taikhoan = $_SESSION['taikhoan'];
        $matkhaucu = Get_value($_POST['matkhaucu']);
        $matkhaucu = md5($matkhaucu);
        $sql_check = "SELECT * FROM NGUOIDUNG WHERE taikhoan = '$taikhoan' and matkhau = '$matkhaucu'";
        $res_check = Check_db($sql_check);
        if(mysqli_num_rows($res_check) > 0){
            $matkhaumoi = Get_value($_POST['matkhaumoi']);
            $matkhaumoi = md5($matkhaumoi);
            $sql_change_pass = "UPDATE NGUOIDUNG SET matkhau = '$matkhaumoi' WHERE `TAIKHOAN` = '$taikhoan';";
            $res_change_pass = Check_db($sql_change_pass);
            if($res_change_pass){
                echo "<script>alert('Mật khẩu đã được thành công!')</script>";
                echo "<script>window.open(window.location.href,'_self')</script>";
            }
            else{
                echo "<script>alert('Đổi mật khẩu thất bại!')</script>";
            }
        }
        else{
            echo "<script>alert('Mật khẩu cũ không trùng khớp')</script>";

        }

        
    }
?>