<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/stylesignup.css">
    <title>Tạo tài khoản</title>
</head>
<body>
    <?php
        include("./includes/connection.php");
        // Kiểm tra nếu người dùng đã ân nút đăng nhập thì mới xử lý
        if (isset($_POST["submit"])) {
        // lấy thông tin người dùng
        $macanbo=mysqli_real_escape_string($conn, $_POST["user"]);
        $matkhau=mysqli_real_escape_string($conn, $_POST["pass"]);
        $email=mysqli_real_escape_string($conn, $_POST["email"]);
        // $matkhau=md5($matkhau);
        if($macanbo == "" || $matkhau == "" || $email == "")
        {
            echo "Hãy điền đầy đủ thông tin!";
        }
        else
        {
            
            $sql="insert into user(macanbo,matkhau,email) values(
            '$macanbo' ,'$matkhau','$email')";
            $query=mysqli_query($conn,$sql) ;
            if($query!=0)
            {
                // echo "<script> document.querySelector('.thongbao').innerHTML='Đăng kí thành công';
                // </script>";
                echo "<br> <h2 style='text-align: center;color :green;top:20px;'>Đăng kí thành công <br>
                <a href='login.php'>Chuyển tới trang đăng nhập</a>
                            </h2>";
            }
            else 
                echo "Đăng kí thất bại";
        }
        
        }
    

    ?>
    <div class="wraper">
       <div class="form-top">
           <div class="right">
               <img src="./img/vlute_icon96.png" alt="">
           </div>
       </div>
       <div class="form-bottom">
           <h2>Đăng kí</h2>
            <form method ="POST" >
                <div class="input-box">
                    <input type="text" name="user" required autocomplete="none">
                    <label for="">Username</label>
                </div>
                <div class="input-box" >
                    <input type="password" name="pass" required>
                    <label for="">Password</label>
                </div>
                <div class="input-box" >
                    <input type="email" name="email" required>
                    <label for="">Email</label>
                </div>
                <!-- <input type="button" value="Đăng nhập"> -->
                <input type="submit" name="submit" class="login login-submit" value="Đăng kí">
                <div class="thongbao"></div>
            </form>
       </div>
    </div>
</body>
</html>