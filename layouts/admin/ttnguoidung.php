<?php
include("header.php");
?>
        
    <div class="containerQlnguoidung">
        <div class="container">
            <h2 style="text-transform: uppercase;text-align:center;color:darkorange;font-weight:bold;">Thông tin người dùng</h2>


        <?php 
            if(isset($_GET['updateUser']))
            {
                $macanboUpdate = $_GET['updateUser'];
                $selectUser = "SELECT user.macanbo, matkhau,khoa.makhoa, user.hoten,tenkhoa,chucvu,hocvi,chuyennganh,gioitinh,ngaysinh,email,sdt,cmnd 
                FROM user as user, khoa as khoa 
                WHERE user.makhoa = khoa.makhoa
                and user.macanbo = '$macanboUpdate'";
                $querySelect = mysqli_query($conn,$selectUser);
                $num_rows = mysqli_num_rows($querySelect);
                if($num_rows == 0)
                    echo "<script>truy vấn sai</script>"; 
            //    lấy dữ liệu
                $row = mysqli_fetch_array($querySelect);
                $hotenUser = $row['hoten'];
                $matkhauUser = $row['matkhau'];
                $khoaUser = $row['tenkhoa'];
                $makhoaUser = $row['makhoa'];
                $chucvuUser = $row['chucvu'];
                $hocviUser = $row['hocvi'];
                $chuyennganhUser = $row['chuyennganh'];
                $gioitinhUser = $row['gioitinh'];
                $ngaysinhUser = $row['ngaysinh'];
                $emailUser = $row['email'];
                $sdtUser = $row['sdt'];
                $cmndUser = $row['cmnd'];
                
        ?>

                <form class="formUser" action="" method="POST">
                    <h3 style="text-align: center; text-transform:uppercase; font-weight:bold;color:#2980b9;"><img style="vertical-align:unset;" class="iconImg" src="../img/refresh.png"> Cập nhật thông tin</h3>
                <div class="infoUser">
                    <div class="left">
                        <Strong>Họ tên: </Strong> <input type="text" placeholder="Nhập họ tên" name="hoten" value='<?php echo$hotenUser;?>' autocomplete="none">
                        <Strong>Khoa: </Strong> 
                        <select name="txtKhoa">
                        
                        <?php 
                            //  bỏ đi mã khoa trùng
                            $selectKhoa = "SELECT * FROM  khoa where makhoa !='$makhoaUser'";
                            $queryselectKhoa = mysqli_query($conn, $selectKhoa);
                            $num_rows = mysqli_num_rows($queryselectKhoa);
                            if($num_rows == 0 )
                            {
                                echo 'Sai truy vấn';
                            }
                            else
                            {
                                    // đã bỏ đi mã khoa trùng
                                    echo "<option selected value='$makhoaUser'>$khoaUser</option>";
                                while($row = mysqli_fetch_array($queryselectKhoa))
                                    echo '<option value='.$row['makhoa'].'>' .$row['tenkhoa'].'</option>';
                            }

                        ?>
                        </select>

                        <Strong>Chức vụ: </Strong> 
                        <select name="txtChucvu" id="">
                            <option value="Giảng Viên">Giảng Viên</option>
                        </select>

                        <Strong>Học vị: </Strong> 
                        <select name="txtHocvi" id="">
                            <?php 
                                echo "<option selected value='$hocviUser'>$hocviUser </option>";
                                if($hocviUser == "Thạc Sĩ")
                                    echo  "<option value='Tiến Sĩ'>Tiến Sĩ</option>";
                                else
                                    echo  "<option value='Thạc Sĩ'>Thạc Sĩ</option>";
                            ?>
                        </select>

                        <Strong>Giới tính: </Strong> 
                        <select name="txtGioitinh" id="">
                            <?php 
                                echo "<option selected value='$gioitinhUser'>$gioitinhUser </option>";
                                if($gioitinhUser == "Nam")
                                    echo  "<option value='Nữ'>Nữ</option>";
                                else
                                    echo  "<option value='Nam'>Nam</option>";
                            ?>
                        </select>
                        </div>
                        <div class="right">
                            <Strong>Chuyên ngành: </Strong><input type="text" placeholder="Nhập chuyên ngành" name="chuyennganh" value="<?php echo $chuyennganhUser?>">
                            <Strong>Ngày sinh: </Strong><input type="date" placeholder="Nhập ngày sinh " name="ngaysinh" value="<?php echo $ngaysinhUser?>">
                            <Strong>Email: </Strong><input type="email" placeholder="Nhập email" name="email" value="<?php echo $emailUser?>" autocomplete="none">
                            <Strong>SĐT: </Strong><input type="text" placeholder="Nhập số điện thoại" name="sdt" value="<?php echo $sdtUser?>" autocomplete="none">
                            <Strong>CMND: </Strong><input type="text" placeholder="Nhập CMND" name="cmnd" value="<?php echo $cmndUser?>" autocomplete="none">
                        </div>
                    </div>
                    <input class="btnAdduser" type="submit" value="Cập nhật" name="updateUser">
                    <?php

                    // update thông tin user
                    // lấy dữ liệu từ dòng 22
                    if(isset($_GET['updateUser']))
                    {
                        if(isset($_POST['updateUser']))
                        {
                            $hoten = $_POST['hoten'];
                            $makhoa = $_POST['txtKhoa'];
                            $chucvu = $_POST['txtChucvu'];
                            $hocvi = $_POST['txtHocvi'];
                            $gioitinh = $_POST['txtGioitinh'];
                            $chuyennganh = $_POST['chuyennganh'];
                            $ngaysinh = $_POST['ngaysinh'];
                            $email = $_POST['email'];
                            $sdt = $_POST['sdt'];
                            $cmnd = $_POST['cmnd'];
                            if($hoten ==""  or $makhoa =="" and $hocvi=="" or $chuyennganh =="" or $email == "" or $sdt == "" or $cmnd == ""){
                                echo "<p style='color:orangered;text-align:center;'>THÔNG TIN KHÔNG ĐƯỢC ĐỂ TRỐNG.</p>"; 
                            }
                                
                            else
                            {
                                $sqlUpdate ="UPDATE user set hoten ='$hoten', makhoa='$makhoa', chucvu='$chucvu', hocvi ='$hocvi',
                                gioitinh='$gioitinh', chuyennganh ='$chuyennganh', ngaysinh='$ngaysinh', email='$email', sdt='$sdt', cmnd='$cmnd'
                                WHERE macanbo ='$macanboUpdate'";
                                $queryUpdate = mysqli_query($conn,$sqlUpdate);
                                if($queryUpdate != 0)
                                {
                                   echo "<script> window.history.back()</script>";
                                }
                            }
                        }

                    ?>
                </form>

                <!-- Mật khẩu --------------------------------------------------------- -->
                <div class="containerMatkhau">
                    <div class="container">
                        <h2 style="text-transform: uppercase;text-align:center;color:#2980b9;font-weight:bold;">Mật khẩu người dùng</h2>
                            <form class="formMatkhau" method="POST">
                                <Strong>Mật khẩu: </Strong> <input type="password" placeholder="Nhập mật khẩu" name="matkhau" value='<?php echo$matkhauUser; ?>'>
                                <strong>Mật khẩu mới: </strong> <input type="password" placeholder="Nhập mật khẩu mới" name="matkhaumoi">
                                <strong>Lặp lại mật khẩu mới: </strong><input type="password" placeholder="Nhập lại mật khẩu mới" name="matkhaulaplai">
                                <input style="width: 120px;" class="btnAdduser" type="submit" value="Cập nhật" name="updateMatkhau">
                                <?php   
                    // update mật khẩu
                       if(isset($_POST['updateMatkhau']))
                        {
                            $matkhau = $_POST['matkhau'];
                            $matkhaumoi = $_POST['matkhaumoi'];
                            $matkhaulaplai = $_POST['matkhaulaplai'];
                            if($matkhau =="" or $matkhaumoi =="" or $matkhaulaplai =="" )
                                // load lại các trang khi bị lỗi để không bị xác nhận biểu mẫu lại
                                echo "<p style='color:orangered;text-align:center;'>THÔNG TIN KHÔNG ĐƯỢC BỎ TRỐNG</p>"; 
                            elseif($matkhau == $matkhaumoi)
                                echo "<p style='color:orangered;text-align:center;'>MẬT KHẨU MỚI TRÙNG VỚI MẬT KHẨU HIỆN TẠI</p>"; 
                            elseif($matkhaulaplai != $matkhaumoi)
                                echo "<p style='color:orangered;text-align:center;'>MẬT KHẨU LẶP LẠI KHÔNG ĐÚNG</p>"; 
                            else
                            {
                                $sqlUpdateMatkhau ="UPDATE user set matkhau ='$matkhaumoi' WHERE macanbo ='$macanboUpdate'";
                                $queryUpdateMatkhau = mysqli_query($conn,$sqlUpdateMatkhau);
                                if($queryUpdateMatkhau != 0)
                                {
                                    echo "<script> window.history.back()</script>";
                                }
                            }
                        }
                    }
                   
                ?>
                            </form>
                        </h2>
                    </div>
                </div>

        <?php      
            }
            else
            {
        ?>
        <!-- form thêm người dùng -->
            <form class="formUser" action="" method="POST">
            <h3 style="text-align: center; text-transform:uppercase; font-weight:bold;color:#2980b9;"><img style="vertical-align:unset;" class="iconImg" src="../img/add-user.png"> Thêm người dùng</h3>
                <div class="infoUser">
                    <div class="left">
                        <Strong>Họ tên: </Strong> <input type="text" placeholder="Nhập họ tên" name="hoten" autocomplete="none">
                        <Strong>Mật khẩu: </Strong> <input type="password" placeholder="Nhập mật khẩu" name="matkhau">
                        <Strong>Lặp lại mật khẩu: </Strong> <input type="password" placeholder="Nhập lại mật khẩu " name="matkhaulaplai">
                        <Strong>Khoa: </Strong> 
                        <select name="txtKhoa">
                        
                        <?php 
                            $selectKhoa = "SELECT * FROM  khoa";
                            $queryselectKhoa = mysqli_query($conn, $selectKhoa);
                            $num_rows = mysqli_num_rows($queryselectKhoa);
                            if($num_rows == 0 )
                            {
                                echo 'Sai truy vấn';
                            }
                            else
                            {
                                    echo '<option selected value="">Khoa</option>';
                                while($row = mysqli_fetch_array($queryselectKhoa))
                                    echo '<option value='.$row['makhoa'].'>' .$row['tenkhoa'].'</option>';
                            }

                        ?>
                        </select>

                        <Strong>Chức vụ: </Strong> 
                        <select name="txtChucvu" id="">
                            <option value="Giảng Viên">Giảng Viên</option>
                        </select>

                        <Strong>Học vị: </Strong> 
                        <select name="txtHocvi" id="">
                            <option selected value="">Học vị</option>
                            <option value="Thạc Sĩ">Thạc Sĩ</option>
                            <option value="Tiến Sĩ">Tiến Sĩ</option>
                        </select>
                    </div>
                    <div class="right">
                        <Strong>Giới tính: </Strong> 
                        <select name="txtGioitinh" id="">
                            <option value="Nam">Nam</option>
                            <option value="Nữ">Nữ</option>
                        </select>
                        <Strong>Chuyên ngành: </Strong><input type="text" placeholder="Nhập chuyên ngành" name="chuyennganh" autocomplete="none">
                        <Strong>Ngày sinh: </Strong><input type="date" placeholder="Nhập ngày sinh " name="ngaysinh">
                        <Strong>Email: </Strong><input type="email" placeholder="Nhập email" name="email" autocomplete="none">
                        <Strong>SĐT: </Strong><input type="text" placeholder="Nhập số điện thoại" name="sdt" autocomplete="none">
                        <Strong>CMND: </Strong><input type="text" placeholder="Nhập CMND" name="cmnd" autocomplete="none">
                    </div>
                </div>
                <input class="btnAdduser" type="submit" value="Thêm" name="addUser">
                <!-- thêm người dùng -->
                <?php 
                    if(isset($_POST['addUser']))
                    {
                        $hoten = $_POST['hoten'];
                        $matkhau = $_POST['matkhau'];
                        $matkhaulaplai = $_POST['matkhaulaplai'];
                        $makhoa = $_POST['txtKhoa'];
                        $chucvu = $_POST['txtChucvu'];
                        $hocvi = $_POST['txtHocvi'];
                        $gioitinh = $_POST['txtGioitinh'];
                        $chuyennganh = $_POST['chuyennganh'];
                        $ngaysinh = $_POST['ngaysinh'];
                        $email = $_POST['email'];
                        $sdt = $_POST['sdt'];
                        $cmnd = $_POST['cmnd'];
                        if($hoten=="" or $matkhau =="" or $matkhaulaplai =="" or $makhoa =="" or $hocvi =="" or $chuyennganh =="" or $email == "" or $sdt == "" or $cmnd == "")
                            echo "<p style='color:orangered;text-align:center;'>THÔNG TIN NHẬP CHƯA ĐẦY ĐỦ.</p>"; 
                        elseif($matkhau != $matkhaulaplai)
                            echo "<p style='color:orangered;text-align:center;'>MẬT KHẨU LẶP LẠI KHÔNG ĐÚNG</p>"; 
                        else 
                        {
                            $sqlAdduser = "INSERT INTO user(hoten,matkhau,makhoa,chucvu,hocvi,chuyennganh,gioitinh,ngaysinh,email,sdt,cmnd) 
                            values('$hoten' ,'$matkhau','$makhoa','$chucvu','$hocvi','$chuyennganh','$gioitinh','$ngaysinh','$email','$sdt','$cmnd')";
                            $queryAdduser = mysqli_query($conn,$sqlAdduser);
                            echo "<p style='color:green;text-align:center;'>THÊM NGƯỜI DÙNG THÀNH CÔNG</p>"; 
                        }
                           
                    }
                    ?>
            </form>
    <?php   }   ?>
        </div>
    </div>

<?php
include("footer.php");
?>


                


                    
                    
