<?php
include("header.php");
?>

    <div class="containerTailieu">
        <div class="container">
            <h2>Các tài liệu thuộc khoa 
                <span style="font-weight: bold;color: green;"><?php echo $_SESSION['tenkhoa']?></span>
            </h2>
            <form style="margin-bottom:50px;text-align:center;" action="" method="GET">
                <input style="width:300px;" type="text" placeholder="Tìm theo môn, loại tài liệu, tên giáo viên..." name="chonmon">
                <input class="btnUpload" type="submit" value="Tìm" name="timkiem">
            </form>
            

                        <?php 
                            $tenkhoa = $_SESSION['tenkhoa'];

                            $selectTailieu =
                            "SELECT mon.mamon as mamon,loaitailieu, mon.tenmon, khoa.tenkhoa, user.hoten, ngaydang,tenfile,loaifile,user.macanbo
                            FROM uploads as upload, khoa as khoa,user as user,mon as mon 
                            WHERE khoa.makhoa =upload.makhoa
                            and mon.mamon =upload.mamon
                            and user.macanbo =upload.macanbo
                            and khoa.tenkhoa = '$tenkhoa'
                            order by ngaydang desc ";
                            
                            $query = mysqli_query($conn, $selectTailieu);
                            $num_rows = mysqli_num_rows($query);
                            if($num_rows == 0 )
                            {
                                echo 'Sai truy vấn';
                            }
                            else 
                            {
                                if(isset($_GET['timkiem']))
                                {
                                    $timkiem = $_GET['chonmon'];
                                    $tenkhoa = $_SESSION['tenkhoa'];
                                    $hienDanhsach =false;
                                    // nếu không có từ khóa tìm kiếm thì in ra không có dữ liệu
                                    if($timkiem != "")
                                    {
                                        // truy vấn tìm
                                        $timMon = "SELECT loaitailieu, mon.tenmon, user.hoten, ngaydang,tenfile,tenkhoa,mon.mamon,user.macanbo
                                        FROM uploads as upload, khoa as khoa,user as user,mon as mon 
                                        WHERE khoa.makhoa =upload.makhoa
                                        and mon.mamon =upload.mamon
                                        and user.macanbo =upload.macanbo
                                        and tenkhoa = '$tenkhoa'
                                        and (mon.tenmon like '%$timkiem%' or loaitailieu like '%$timkiem%' or hoten like '%$timkiem%')
                                        order by ngaydang desc ";
                                        $queryTim = mysqli_query($conn,$timMon);
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
                                                        <th scope="col">Loại tài liệu</th>
                                                        <th scope="col">Môn</th>
                                                        <th scope="col">Người đăng</th>
                                                        <th scope="col">Thời gian đăng lên</th>
                                                        <th scope="col">Tên file</th>
                                                        <th scope="col">Tải xuống</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                        <?php
                                            while($row = mysqli_fetch_array($queryTim))
                                            {
                                                $file = $row['tenfile'];
                                                $maMon =$row['mamon'];
                                                $maCanbo =$row['macanbo'];
                    
                                                // chuyển string thành thời gian để định dạng
                                                $time=strtotime($row['ngaydang']);
                                                echo "<tr>";
                                                    echo "<td style='color:green;'>" .$row['loaitailieu']." </td>";
                                                    echo "<td style='color:sienna;'><a title='Xem thư mục' href='xemthumuc.php?thumuc=$maMon'>" .$row['tenmon']. "</a></td>";
                                                    echo "<td style='color:navy;'><a title='Xem thông tin' href='viewprofile.php?macanbo=$maCanbo'>" .$row['hoten']."</a> </td>";
                                                    // dùng date() để định dạng
                                                    echo "<td>" .date('d-m-Y H:i:s',$time) ."</td>";
                                                    echo "<td>" .$row['tenfile']." </td>";
                                                    echo "<td style='text-align:center;'><a title='Tải xuống' href='files/$file' target='_blank'><img class='iconImg' src='img/dow.png'></a></td>";
                                                echo '</tr>';
                                            }

                                        }
                                        if($timthay == false )
                                        {
                                            echo "<h1 style='display:flex;justify-content:center;align-items:center;color:navy;'>Không tìm thấy tài liệu thuộc môn này!</h1>";
                                        }
                                    }
                                    else
                                    {
                                        // trở lại trang ban đầu
                                        echo "<script> 
                                                // alert('Không có từ khóa tìm kiếm');
                                                window.location.href='tailieu.php';
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
                                                        <th scope="col">Loại tài liệu</th>
                                                        <th scope="col">Môn</th>
                                                        <th scope="col">Người đăng</th>
                                                        <th scope="col">Thời gian đăng lên</th>
                                                        <th scope="col">Tên file</th>
                                                        <th scope="col">Tải xuống</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                        <?php 
                                    while($row = mysqli_fetch_array($query))
                                    {
                                        $file = $row['tenfile'];
                                        $maMon = $row['mamon'];
                                        $maCanbo =$row['macanbo'];
                                        // chuyển string thành thời gian để định dạng
                                        $time=strtotime($row['ngaydang']);
                                        echo "<tr>";
                                            echo "<td style='color:green;'>" .$row['loaitailieu']." </td>";
                                            echo "<td style='color:sienna;'> <a title='Xem thư mục' href='xemthumuc.php?thumuc=$maMon'>".$row['tenmon']."</a> </td>";
                                            echo "<td style='color:navy;'><a title='Xem thông tin' href='viewprofile.php?macanbo=$maCanbo'>" .$row['hoten']."</a> </td>";
                                            // dùng date() để định dạng
                                            echo "<td>" .date('d-m-Y H:i:s',$time) ."</td>";
                                            echo "<td>" .$row['tenfile']." </td>";
                                            echo "<td style='text-align:center;'><a title='Tải xuống' href='files/$file' target='_blank'><img class='iconImg' src='img/dow.png'></a></td>";
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