<?php 
    require_once('./includes/include.php');
    require_once('./includes/conn.php');
    $taikhoan = $_SESSION['taikhoan'];
    // if(isset($_POST['update_user'])){
    //     Check_f5($_POST['update_user']);
    // }
?>

<div class="form_box">
    <script>
        const check_number_phone = function () {
            let phone = document.getElementById('sdt').value;
            if(!isNaN(phone)){
                document.getElementById('kiemtrasdt').innerHTML = '';
            } else {
                document.getElementById('kiemtrasdt').style.color = 'red';
                document.getElementById('kiemtrasdt').innerHTML = 'Phải là số';
            }
        }

        const Check_all = function () {
            let phone = document.getElementById('sdt').value;
            if(isNaN(phone)){
                alert("Số điện thoại bắt buộc phải là số!");
                return false;
            }
        }
    </script>
    <h2>Sửa thông tin tài khoản</h2>
    <div class="border_bottom"></div>
    <form onsubmit="return Check_all()" method="post" enctype="multipart/form-data">
        <table align="center" width="100%">
            <tr>
                <td valign="top"><b>Tài khoản:</b></td>
                <td><input type="text" name="taikhoan" id="taikhoan" value="<?php echo $taikhoan ?>" disabled/></td>
            </tr>
            <tr>
                <td valign="top"><b>Họ và tên:</b></td>
                <td><input type="text" name="tennd" id="tennd" size = 60 required /></td>
            </tr>
            <tr>
                <td valign="top"><b>Giới tính:</b></td>
                <td>
                    <b>Nam </b><input type="radio" name="gioitinh" id="gioitinh" value="1">
                    <b>Nữ </b><input type="radio" name="gioitinh" id="gioitinh" value="0">
                </td>
            </tr>
            <tr>
                <td valign="top"><b>Địa chỉ: </b></td>
                <td><input type="text" name="diachi" id="diachi" required/></td>
            </tr>

            <tr>
                <td valign="top"><b>Số điện thoại:</b></td>
                <td>
                    <input type="text" name="sdt" id="sdt" onkeyup="check_number_phone()" required/>
                    <span id="kiemtrasdt"></span>
                </td>
            </tr>

            <tr>
                <td valign="top"><b>Email:</b></td>
                <td><input type="email" name="email" id="email" required/></td>
            </tr>
            <tr>
                <td valign="top"><b>Ngày sinh:</b></td>
                <td><input type="date" name="ngaysinh" id="ngaysinh" required></td>
            </tr>
            <tr>
                <td colspan="9" class="text-center"> 
                    <input type="submit" class="btn-submit" name="update_user" value="sửa tài khoản">
                </td>
            </tr>
        </table>
    </form>
</div>

<?php 
    if(isset($_POST['update_user'])){
        $tennd = $_POST['tennd'];
        $gioitinh = $_POST['gioitinh'];
        $diachi = $_POST['diachi'];
        $sdt = $_POST['sdt'];
        $email = $_POST['email'];
        $ngaysinh = $_POST['ngaysinh'];
        $sql_update_user = "UPDATE NGUOIDUNG SET TENND = '$tennd', GIOITINH = $gioitinh, DIACHI = '$diachi', SDT = '$sdt', EMAIL = '$email', NGAYSINH = '$ngaysinh' 
                            WHERE `nguoidung`.`TAIKHOAN` = '$taikhoan';";
        $res_update_user = Check_db($sql_update_user);
        if($res_update_user){
            echo "<script>alert('Thông tin đã được chỉnh sửa thành công!')</script>";
            echo "<script>window.open(window.location.href,'_self')</script>";
        }
    }
?> 