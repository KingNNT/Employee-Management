<?php
include("header.php");
?>
    <div class="containerQlnguoidung">
        <div class="containerfluid">
            <h2 class="title">Quản lí Người dùng</h2>
            <form style="margin-bottom:20px;text-align:center;" action="" method="GET" >
                <input class="searchForm" style="width:320px;" type="text" placeholder="Tìm theo tên giáo viên, mã cán bộ, tên khoa..." name="tukhoatimkiem">
                <input class="btnUpload" type="submit" value="Tìm" name="timkiem">
            </form>

    <?php 
        $selectUser = "SELECT user.macanbo, matkhau, user.hoten,tenkhoa,chucvu,hocvi,chuyennganh,gioitinh,ngaysinh,email,sdt,cmnd 
        FROM user as user, khoa as khoa 
        WHERE user.makhoa = khoa.makhoa
        order by hoten";
        $querySelect = mysqli_query($conn,$selectUser);
        $num_rows = mysqli_num_rows($querySelect);
        if($num_rows == 0)
            echo "<script>truy vấn sai</script>"; 
        else
        {
            if(isset($_GET['timkiem']))
            {
                $timkiem = $_GET['tukhoatimkiem'];
                // $tenkhoa = $_SESSION['tenkhoa'];
                $hienDanhsach =false;
                // nếu không có từ khóa tìm kiếm thì in ra không có dữ liệu
                if($timkiem != "")
                {
                    // truy vấn tìm
                    $timUser = "SELECT user.macanbo, matkhau, user.hoten,tenkhoa,chucvu,hocvi,chuyennganh,gioitinh,ngaysinh,email,sdt,cmnd 
                    FROM user as user, khoa as khoa 
                    WHERE user.makhoa = khoa.makhoa
                    and (khoa.tenkhoa like '%$timkiem%' or user.macanbo like '%$timkiem%' or user.hoten like '%$timkiem%')
                    order by tenkhoa";
                    $queryTim = mysqli_query($conn,$timUser);
                    $num_rows = mysqli_num_rows($queryTim);
                    $timthay =false;
                    if($num_rows == 0)
                        echo "<script>truy vấn sai</script>"; 
                    else
                    {
                        $timthay = true;
    ?>         
                        <a style="float: right;" href="ttnguoidung.php" class="btnUpload"><img class='iconImg' src='../img/add-user.png'>Thêm người dùng </a>
                        <div class="table-responsive-lg">
                            <table class="table table-striped table-hover ">
                                <thead>
                                    <tr style="text-align: center;align-items: center;">
                                        <th scope="col">Mã cán bộ</th>
                                        <th scope="col">Họ tên</th>
                                        <th scope="col">Khoa</th>
                                        <th scope="col">Chức vụ</th>
                                        <th scope="col">Học vị</th>
                                        <th scope="col">Chuyên ngành</th>
                                        <th scope="col">Ngày sinh</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">SDT</th>
                                        <th scope="col">Sửa</th>
                                        <th scope="col">Xóa</th>
                                    </tr>
                                </thead>
                                <tbody>
             
    <?php
                        while($row = mysqli_fetch_array($queryTim))
                        {
                            $macanbo = $row['macanbo'];
                            // chuyển string thành thời gian để định dạng
                            $time=strtotime($row['ngaysinh']);
                            echo "<tr>";
                                echo "<td style='color:green;'>" .$row['macanbo']." </td>";
                                echo "<td style='color:blue;'>" .$row['hoten']." </td>";
                                echo "<td style='color:blue;'>" .$row['tenkhoa']." </td>";
                                echo "<td style='color:blue;'>" .$row['chucvu']." </td>";
                                echo "<td style='color:blue;'>" .$row['hocvi']." </td>";
                                echo "<td style='color:blue;'>" .$row['chuyennganh']." </td>";
                                // dùng date() để định dạng
                                echo "<td>" .date('d-m-Y',$time) ."</td>";
                                echo "<td>" .$row['email']." </td>";
                                echo "<td>" .$row['sdt']." </td>";
                                echo "<td><a title='Sửa thông tin' href='ttnguoidung.php?updateUser=$macanbo'><img class='iconImg' src='../img/refresh.png'></a></td>";
                                echo "<td><a title='Xóa'
                                    onClick=\"javascript: return confirm('Bạn có muốn xóa người dùng này?')\" href='?delUser=$macanbo'> <img class='iconImg' src='../img/delete.png'></a></td>";
                            echo '</tr>';
                        }
                    }
                    if($timthay == false )
                    {
                        echo "<h1 style='display:flex;justify-content:center;align-items:center;color:navy;'>Không tìm thấy giáo viên này</h1>";
                    }
                }
                else
                {
                    // trở lại trang ban đầu
                    echo "<script> 
                            // alert('Không có từ khóa tìm kiếm');
                            window.location.href='qlnguoidung.php';
                        </script>";
                }
            }
            else 
            {
    ?>
                <a style="float: right;" href="ttnguoidung.php" class="btnUpload"><img class='iconImg' src='../img/add-user.png'> Thêm người dùng</a>
                <div class="table-responsive-lg">
                            <table class="table table-striped table-hover ">
                                <thead>
                                    <tr style="text-align: center;align-items: center;">
                                        <th scope="col">Mã cán bộ</th>
                                        <th scope="col">Họ tên</th>
                                        <th scope="col">Khoa</th>
                                        <th scope="col">Chức vụ</th>
                                        <th scope="col">Học vị</th>
                                        <th scope="col">Chuyên ngành</th>
                                        <th scope="col">Ngày sinh</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">SDT</th>
                                        <th scope="col">Sửa</th>
                                        <th scope="col">Xóa</th>
                                    </tr>
                                </thead>
                                <tbody>
                
    <?php
                while($row = mysqli_fetch_array($querySelect))
                {
                    $macanbo = $row['macanbo'];
                    // chuyển string thành thời gian để định dạng
                    $time=strtotime($row['ngaysinh']);
                    echo "<tr>";
                        echo "<td style='color:green;'>" .$row['macanbo']." </td>";
                        echo "<td style='color:blue;'>" .$row['hoten']." </td>";
                        echo "<td style='color:blue;'>" .$row['tenkhoa']." </td>";
                        echo "<td style='color:blue;'>" .$row['chucvu']." </td>";
                        echo "<td style='color:blue;'>" .$row['hocvi']." </td>";
                        echo "<td style='color:blue;'>" .$row['chuyennganh']." </td>";
                        // dùng date() để định dạng
                        echo "<td>" .date('d-m-Y',$time) ."</td>";
                        echo "<td>" .$row['email']." </td>";
                        echo "<td>" .$row['sdt']." </td>";
                        echo "<td><a title='Sửa thông tin' href='ttnguoidung.php?updateUser=$macanbo'><img class='iconImg' src='../img/refresh.png'></a></td>";
                        echo "<td><a title='Xóa'
                            onClick=\"javascript: return confirm('Bạn có muốn xóa người dùng này?')\" href='?delUser=$macanbo'> <img class='iconImg' src='../img/delete.png'></a></td>";
                    echo '</tr>';
                }
            }
        } 
    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


<?php
include("footer.php");
?>



                <!-- Xóa người dùng -->
            <?php
 
            if (isset($_GET['delUser'])) {
                $deleteUser =  $_GET['delUser'];
                $del_query = "DELETE FROM user WHERE macanbo='$deleteUser' AND macanbo != '1' ";
                $run_del_query = mysqli_query($conn, $del_query) or die (mysqli_error($conn));
                if (mysqli_affected_rows($conn) > 0) {
                    echo "<script>
                    window.location.href='qlnguoidung.php';</script>";
                }
                else {
                    echo "<script>alert('KHÔNG THỂ XÓA ADMIN');window.location.href='qlnguoidung.php';</script>";   
                }
                }
            ?>  