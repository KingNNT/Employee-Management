<?php
include("header.php");
?>

<div class="containerTailieu">
        <div class="container">
            <h2>
                <span style="font-weight: bold;color: green;">Đề cương</span>
            </h2>
            <form style="margin-bottom:50px;text-align:center;" action="" method="GET">
                <input style="width:300px;" type="text" placeholder="Tìm theo môn, mã cán bộ, tên giáo viên..." name="chonmon">
                <input class="btnUpload" type="submit" value="Tìm" name="timkiem">
            </form>
            

                        <?php 
                            $tenkhoa = $_SESSION['tenkhoa'];

                            $selectTailieu =
                            "SELECT mon.mamon as mamon,loaitailieu, mon.tenmon, khoa.tenkhoa, user.hoten, ngaydang,tenfile,loaifile,user.macanbo,upload.id
                            FROM uploads as upload, khoa as khoa,user as user,mon as mon 
                            WHERE khoa.makhoa =upload.makhoa
                            and mon.mamon =upload.mamon
                            and user.macanbo =upload.macanbo
                            and khoa.tenkhoa = '$tenkhoa'
                            and loaitailieu ='Đề cương'
                            order by ngaydang desc ";
                            
                            $query = mysqli_query($conn, $selectTailieu);
                            $num_rows = mysqli_num_rows($query);
                            if($num_rows == 0 )
                            {
                                echo "<h2 style='text-transform:uppercase;color:green;margin-top:50px;'>Hiện tại chưa có file nào trong thư mục này!</h2>";
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
                                        $timMon = "SELECT loaitailieu, mon.tenmon, user.hoten, ngaydang,tenfile,tenkhoa,mon.mamon,user.macanbo,upload.id
                                        FROM uploads as upload, khoa as khoa,user as user,mon as mon 
                                        WHERE khoa.makhoa =upload.makhoa
                                        and mon.mamon =upload.mamon
                                        and user.macanbo =upload.macanbo
                                        and tenkhoa = '$tenkhoa'
                                        and loaitailieu ='Đề cương'
                                        and (mon.tenmon like '%$timkiem%' or user.macanbo like '%$timkiem%' or hoten like '%$timkiem%')
                                        order by ngaydang desc ";
                                        $queryTim = mysqli_query($conn,$timMon);
                                        $num_rows = mysqli_num_rows($queryTim);
                                        if($num_rows == 0)
                                        echo "<h2 style='text-transform:uppercase;color:green;margin-top:50px;'>Không tìm thấy tài liệu!</h2>"; 
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
                                                        <th scope="col">Xóa</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                        <?php
                                            while($row = mysqli_fetch_array($queryTim))
                                            {
                                                $file = $row['tenfile'];
                                                $maMon =$row['mamon'];
                                                $maCanbo =$row['macanbo'];
                                                $idUpload = $row['id'];
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
                                                    echo "<td style='text-align:center;'><a title='Xóa'
                                                    onClick=\"javascript: return confirm('Bạn có muốn xóa tài liệu này?')\" href='?del=$idUpload'> <img class='iconImg' src='img/delete.png'></a></td>";
                                                echo '</tr>';
                                            }

                                        }
                                    }
                                    else
                                    {
                                        // trở lại trang ban đầu
                                        echo "<script> 
                                                // alert('Không có từ khóa tìm kiếm');
                                                window.location.href='decuong.php';
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
                                                        <th scope="col">Xóa</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                        <?php 
                                    while($row = mysqli_fetch_array($query))
                                    {
                                        $file = $row['tenfile'];
                                        $maMon = $row['mamon'];
                                        $maCanbo =$row['macanbo'];
                                        $idUpload = $row['id'];
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
                                            echo "<td style='text-align:center;'><a title='Xóa'
                                                    onClick=\"javascript: return confirm('Bạn có muốn xóa tài liệu này?')\" href='?del=$idUpload'> <img class='iconImg' src='img/delete.png'></a></td>";
                                        echo '</tr>';
                                    }
                                }
                            } 
                        ?>

                    </tbody>
                </table>
                <a class="btnUpload" href="upload.php">Upload tài liệu</a>
            </div>
        </div>
    </div>

<?php
include("footer.php");
?>



<?php
                        
                        if (isset($_GET['del'])) {
                            $deleteUpload =$_GET['del'];
                            $maCanbo = $_SESSION['macanbo'];
                            $selectTenfile ="SELECT tenfile from uploads where id='$deleteUpload' ";
                            $ketquaTen = mysqli_query($conn,$selectTenfile);
                            $num_rows = mysqli_num_rows($ketquaTen);
                                
                                if($num_rows == 0 )
                                    echo "<script>alert('Sai truy vấn!');</script>";  
                                else
                                {
                                    $row = mysqli_fetch_array($ketquaTen);
                                    $file = $row['tenfile'];
                                        
                                }


                            
                            $Delete = "DELETE FROM uploads WHERE id='$deleteUpload' and macanbo='$maCanbo' ";
                            $query = mysqli_query($conn, $Delete) or die (mysqli_error($conn));
                            // affected rows là cho biết biến conn làm ảnh hưởng bao nhiêu dòng (= 0 là k có dòng ảnh hưởng)

                            if (mysqli_affected_rows($conn) > 0) {
                                    $filename= 'files/'.$file;

                                    if(file_exists( $filename))
                                    {
                                        unlink($filename);
                                        echo "<script>alert('Tài liệu đã được xóa thành công!!!');
                                        window.location.href='decuong.php';</script>";
                                        
                                    }
                                    else
                                    echo "<script>alert('Không tồn tại file!'); window.location.href='decuong.php';</script>";   
                            }
                            else {
                                echo "<script>alert('Tài liệu này thuộc quyền của giáo viên khác!'); window.location.href='decuong.php';</script>";   
                            }
                        }
                        ?>