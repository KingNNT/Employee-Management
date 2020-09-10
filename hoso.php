<?php
include("header.php");
?>



        <!-- class containerHoso chỉ để chứa -->

        <div class="containerTailieu containerHoso ">
            <div class="formTTcanhan">
                <form method="POST">
                     <!-- Update Thông tin hồ sơ -->
        <?php
        // Kiểm tra nếu người dùng đã ân nút update thông tin cá nhân
        if (isset($_POST["updateHoso"])) {
            $thanhcong = 0;
        // mã cán bộ dùng để so sánh vs cơ sở dữ liệu
        $macanbo =$_SESSION['macanbo'];

        // lấy thông tin cần update
        $ngaysinhupdate= $_POST["txtngaysinh"];
        $emailupdate= $_POST["txtemail"];
        $sdtupdate= $_POST["txtsdt"];
        $cmndupdate= $_POST["txtcmnd"];
        // nếu các thông tin không đổi thì k update
        if ($ngaysinhupdate == $_SESSION['ngaysinh'] && $emailupdate == $_SESSION['email'] && $sdtupdate == $_SESSION['sdt'] && $cmndupdate == $_SESSION['cmnd'] ) {
            echo "<p style='color:orangered;text-align:center;'>Thông tin không có gì thay đổi!!!</p>";
        }
        else
        {
            // nếu có 1 trong các thông tin bằng rỗng
            if( $ngaysinhupdate == "" ||  $emailupdate == "" || $sdtupdate == "" || $cmndupdate == "")
            {
                echo "<p style='color:orangered;text-align:center;'>Hãy điền đầy đủ thông tin</p>";
            }
            else
            {
        
                $sql="update user 
                    set 
                        ngaysinh = '$ngaysinhupdate',
                        email = '$emailupdate',
                        sdt = '$sdtupdate',
                        cmnd = '$cmndupdate'
                where macanbo='$macanbo'";
                $query=mysqli_query($conn,$sql) ;
                if($query!=0)
                {
                    $_SESSION['ngaysinh']=$ngaysinhupdate;
                    $_SESSION['email']=$emailupdate;
                    $_SESSION['sdt']=$sdtupdate;
                    $_SESSION['cmnd']=$cmndupdate;
                    echo "<p style='color:green;text-align:center;'>Thay đổi thành công</p>";
                }
                else 
                    echo "SQL error!";
            }
        }
        }?>
                   <h3 class="title"><span>Thông tin</span> cá nhân</h3>
                    <p>Họ tên:</p> <input type="text" disabled value='<?php echo $_SESSION['hoten'] ?>' >
                    <p>Mã cán bộ:</p> <input type="text" disabled value='<?php echo $_SESSION['macanbo'] ?> '>
                    <p>Khoa:</p> <input type="text" disabled value='<?php echo $_SESSION['tenkhoa'] ?> '>
                    <p>Chức vụ:</p> <input type="text" disabled value='<?php echo $_SESSION['chucvu'] ?> '>
                    <p>Học vị:</p> <input type="text" disabled value='<?php echo $_SESSION['hocvi'] ?> '>
                    <p>Chuyên ngành:</p> <input type="text" disabled value='<?php echo $_SESSION['chuyennganh'] ?> '>
                    <p>Giới tính:</p>
                    <?php
                        if($_SESSION['gioitinh'] == 'Nam')
                        {
                           echo '<input disabled name="txtGtnam" checked="checked" type="radio"  name="radioGt">Nam
                            <input disabled type="radio" name="radioGt">Nữ';
                        }
                        else 
                        {
                           echo  '<input disabled  type="radio"  name="radioGt">Nam
                            <input disabled name="txtGtnu" checked="checked" type="radio" name="radioGt">Nữ';
                        }
                    ?>
                    <p>Ngày sinh: </p><input name="txtngaysinh" type="text" autocomplete="none"
                        value='<?php 
                        $time=strtotime($_SESSION['ngaysinh']);
                         echo date('d-m-Y',$time) ?>'>
                    <p>Email:</p> <input name="txtemail" type="email" autocomplete="none"  
                        value='<?php echo $_SESSION['email'] ?>'>
                    <p>Số điện thoại:</p> <input name="txtsdt" type="text" autocomplete="none"  
                        value='<?php echo $_SESSION['sdt'] ?>'>
                    <p>Số CMND:</p> <input name="txtcmnd" type="text"  autocomplete="none" 
                        value='<?php echo $_SESSION['cmnd']?>'>
                    <input style="margin: auto;" type="submit" name="updateHoso" class="btnUpdate" value="Cập nhật">
                </form>
            </div>
            <div class="formTTtaikhoan">
                <form method="POST">
                    <!-- Update mật khẩu -->
        <?php
        // Kiểm tra nếu người dùng đã ân nút update thông tin cá nhân
        if (isset($_POST["updateMatkhau"])) {
        // mã cán bộ dùng để so sánh vs cơ sở dữ liệu
        $macanbo =$_SESSION['macanbo'];

        // lấy thông tin cần update
        $matkhauCuupdate= $_POST["txtmatkhaucu"];
        $matkhauMoiupdate= $_POST["txtmatkhaumoi"];
        $matkhauRepeatupdate= $_POST["txtmatkhaurepeat"];
        
            if( $matkhauCuupdate == "" ||  $matkhauMoiupdate == "" || $matkhauRepeatupdate == "")
            {
                echo "<p style='color:orangered;text-align:center;'>Hãy điền đầy đủ thông tin</p>";
            }
            else
            {
                // mật khẩu trong text giống với mật khẩu trong csdl ?
                if ($matkhauCuupdate != $_SESSION['matkhau']) {
                    echo "<p style='color:orangered;text-align:center;'>Mật khẩu hiện tại không chính xác</p>";
                }
                else
                {
                    // mật khẩu lặp lại không giống với mật khẩu mới
                    if ($matkhauMoiupdate != $matkhauRepeatupdate) {
                        echo "<p style='color:orangered;text-align:center;'>Mật khẩu lặp lại không giống với mật khẩu mới</p>";
                    }
                    else
                    {
                        //nếu mật khẩu mới giống với mật khẩu hiện tại
                        if ($matkhauMoiupdate == $_SESSION['matkhau']) {
                            echo "<p style='color:orangered;text-align:center;'>Mật khẩu mới giống với mật khẩu hiện tại</p>";
                        }
                        else
                        {
                            $sql="update user 
                            set 
                                matkhau = '$matkhauMoiupdate'
                            where matkhau='$matkhauCuupdate'
                            and macanbo = '$macanbo'";
                            $query=mysqli_query($conn,$sql) ;
                            if($query!=0)
                            {
                                echo "<p style='color:green;text-align:center;'>Thay đổi mật khẩu thành công</p>";
                                $_SESSION['matkhau']=$matkhauMoiupdate;
                            }
                            else 
                                echo "<script>alert('SQL error!!!');</script>";
                        }
                    }
                }
        
            }
        }
    ?>
                    <h3 class="title"><span>Thông tin</span> tài khoản</h3>
                    <p>Tên tài khoản:</p> <input  type="text" disabled value='<?php echo $_SESSION['macanbo'] ?> '>
                    <p>Mật khẩu cũ: </p><input name="txtmatkhaucu" type="password"  value="">
                    <p>Mật khẩu mới:</p> <input name="txtmatkhaumoi" type="password"  value="" >
                    <p>Nhập lại mật khẩu mới:</p> <input name="txtmatkhaurepeat" type="password"  value="" >
                    <input style="margin: auto;" type="submit" name="updateMatkhau" class="btnUpdate" value="Cập nhật">
                </form>
                
            </div>
        </div>
       
        

<?php 
include("footer.php");
?>




       

    

