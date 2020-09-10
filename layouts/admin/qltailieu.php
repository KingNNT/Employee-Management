<?php
include("header.php");
?>

    <div class="containerQlnguoidung">
        <div class="containerfluid">
            <h2 class="title">Quản lí Tài liệu</h2>
            <form style="margin-bottom:20px;text-align:center;" action="" method="GET" >
                <input class="searchForm" style="width:320px;" type="text" placeholder="Tìm theo tên giáo viên, tên môn, tên khoa..." name="tukhoatimkiem" value="<?php !empty($_SESSION['tukhoatimkiem']) ? $_SESSION['tukhoatimkiem'] :"" ?>">
                <input class="btnUpload" type="submit" value="Tìm" name="timkiem">
            </form>


            <?php 
                $selectTailieu = "SELECT user.macanbo,user.hoten, khoa.tenkhoa,mon.tenmon,loaitailieu,tenfile, upload.ngaydang,upload.id
                FROM uploads as upload, user as user,khoa as khoa,mon as mon 
                WHERE upload.makhoa = khoa.makhoa 
                and upload.macanbo =user.macanbo
                and upload.mamon = mon.mamon
                ORDER by ngaydang DESC";
                $querySelect = mysqli_query($conn,$selectTailieu);
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
                            $timTailieu = "SELECT user.macanbo,user.hoten, khoa.tenkhoa,mon.tenmon,loaitailieu,tenfile, upload.ngaydang,upload.id
                            FROM uploads as upload, user as user,khoa as khoa,mon as mon 
                            WHERE upload.makhoa = khoa.makhoa 
                            and upload.macanbo =user.macanbo
                            and upload.mamon = mon.mamon
                            and (khoa.tenkhoa like '%$timkiem%' or user.macanbo like '%$timkiem%' or user.hoten like '%$timkiem%' or mon.tenmon like '%$timkiem%' or upload.loaitailieu like '%$timkiem%')
                            ORDER by ngaydang DESC";
                            $queryTim = mysqli_query($conn,$timTailieu);
                            $num_rows = mysqli_num_rows($queryTim);
                            $timthay =false;
                            if($num_rows == 0)
                                echo "<script>truy vấn sai</script>"; 
                            else
                            {
                                $timthay = true;
            ?>         
                                <div class="table-responsive-lg">
                                    <table class="table table-striped table-hover ">
                                        <thead>
                                            <tr style="text-align: center;align-items: center;">
                                                <th scope="col">Họ tên</th>
                                                <th scope="col">Tên môn</th>
                                                <th scope="col">Loại tài liệu</th>
                                                <th scope="col">Khoa</th>
                                                <th scope="col">Tên file</th>
                                                <th scope="col">Ngày đăng</th>
                                                <th scope="col">Xóa</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                    
            <?php
                                while($row = mysqli_fetch_array($queryTim))
                                {
                                    $macanbo = $row['macanbo'];
                                    $idupload = $row['id'];
                                    $tenfile = $row['tenfile'];
                                    // chuyển string thành thời gian để định dạng
                                    $time=strtotime($row['ngaydang']);
                                    echo "<tr>";
                                        echo "<td><a title='Xem thông tin' href='ttnguoidung.php?updateUser=$macanbo'>" .$row['hoten']. "</a></td>";
                                        echo "<td style='color:orangered;'>" .$row['tenmon']." </td>";
                                        echo "<td style='color:blue;'>" .$row['loaitailieu']." </td>";
                                        echo "<td style='color:blue;'>" .$row['tenkhoa']." </td>";
                                        echo "<td style='color:blue;'><a title='Tải xuống' href='../files/$tenfile'>" .$row['tenfile']." </a></td>";
                                        // dùng date() để định dạng
                                        echo "<td>" .date('d-m-Y H:i:s',$time) ."</td>";
                                        // echo "<td><a title='Sửa tài liệu' href='ttnguoidung.php?updateUser=$macanbo'><img class='iconImg' src='../img/refresh.png'></a></td>";
                                        echo "<td><a title='Xóa'
                                            onClick=\"javascript: return confirm('Bạn có muốn xóa tài liệu này không?')\" href='?delTailieu=$idupload'> <img class='iconImg' src='../img/delete.png'></a></td>";
                                    echo '</tr>';
                                }
                            }
                            if($timthay == false )
                                echo "<h1 style='display:flex;justify-content:center;align-items:center;color:navy;'>Không tìm thấy tài liệu này</h1>";
                        }
                        else
                        {
                            // trở lại trang ban đầu

                            echo "<script> 
                                    // alert('Không có từ khóa tìm kiếm');
                                    window.location.href='qltailieu.php';
                                </script>";
                        }
                    }
                    else 
                    {
            ?>
                        <div class="table-responsive-lg">
                                    <table class="table table-striped table-hover ">
                                        <thead>
                                            <tr style="text-align: center;align-items: center;">
                                                <th scope="col">Họ tên</th>
                                                <th scope="col">Tên môn</th>
                                                <th scope="col">Loại tài liệu</th>
                                                <th scope="col">Khoa</th>
                                                <th scope="col">Tên file</th>
                                                <th scope="col">Ngày đăng</th>
                                                <th scope="col">Xóa</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                        
            <?php
                        while($row = mysqli_fetch_array($querySelect))
                        {
                            $macanbo = $row['macanbo'];
                            $idupload = $row['id'];
                            $tenfile = $row['tenfile'];
                            // chuyển string thành thời gian để định dạng
                            $time=strtotime($row['ngaydang']);
                            echo "<tr>";
                                echo "<td><a title='Xem thông tin' href='ttnguoidung.php?updateUser=$macanbo'>" .$row['hoten']. "</a></td>";
                                echo "<td style='color:orangered;'>" .$row['tenmon']." </td>";
                                echo "<td style='color:blue;'>" .$row['loaitailieu']." </td>";
                                echo "<td style='color:blue;'>" .$row['tenkhoa']." </td>";
                                echo "<td style='color:blue;'><a title='Tải xuống' href='../files/$tenfile'>" .$row['tenfile']." </a></td>";
                                // dùng date() để định dạng
                                echo "<td>" .date('d-m-Y H:i:s',$time) ."</td>";
                                // echo "<td><a title='Sửa tài liệu' href='ttnguoidung.php?updateUser=$macanbo'><img class='iconImg' src='../img/refresh.png'></a></td>";
                                echo "<td><a title='Xóa'
                                    onClick=\"javascript: return confirm('Bạn có muốn xóa tài liệu này không?')\" href='?delTailieu=$idupload'> <img class='iconImg' src='../img/delete.png'></a></td>";
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

                    <!-- Xóa tài liệu -->
                    <?php
                    
                    if (isset($_GET['delTailieu'])) {
                        // id của tài liệu
                        $deleteTailieu =  $_GET['delTailieu'];
                        
                        // lấy tên của tài liệu đó
                        $ketquaTen = mysqli_query($conn,"SELECT tenfile from uploads where id = '$deleteTailieu'");
                        
                        // tiến hành xóa trong csdl
                        $del_query = "DELETE FROM uploads WHERE id='$deleteTailieu'";
                        $run_del_query = mysqli_query($conn, $del_query) or die (mysqli_error($conn));
                        
                        // xóa file trong folder files
                        if(mysqli_affected_rows($conn) > 0 )
                            {
                                while($row = mysqli_fetch_array($ketquaTen))
                                {
                                    $file = $row['tenfile'];
                                    $filename= '../files/'.$file;
                                    unlink($filename);
                                }
                                echo "<script>
                                window.location.href='qltailieu.php';</script>";
                            }
                        }
                    ?>  