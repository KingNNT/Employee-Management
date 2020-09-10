<?php
include("header.php");
?>


<div class="containerTailieu">
        <div class="container">
            <h2>Các tài liệu của tôi</h2>
            <form style="margin-bottom:50px;text-align:center;" action="" method="GET">
                <input style="width:300px;" type="text" placeholder="Tìm theo môn, loại tài liệu..." name="chonmon">
                <input class="btnUpload" type="submit" value="Tìm" name="timkiem">
            </form>
        <?php 
            if(isset($_GET['timkiem']))
            {
                $timkiem = $_GET['chonmon'];
                $tenkhoa = $_SESSION['tenkhoa'];
                $hienDanhsach =false;
                $nguoidang = $_SESSION['macanbo'];
                // nếu không có từ khóa tìm kiếm thì in ra không có dữ liệu
                if($timkiem != "")
                {
                    // truy vấn tìm
                    $timMon = "SELECT loaitailieu, mon.tenmon, user.hoten, ngaydang,tenfile,tenkhoa,mon.mamon as mamon,upload.id
                    FROM uploads as upload, khoa as khoa,user as user,mon as mon 
                    WHERE khoa.makhoa =upload.makhoa
                    and mon.mamon =upload.mamon
                    and user.macanbo =upload.macanbo
                    and tenkhoa = '$tenkhoa'
                    and user.macanbo = '$nguoidang'
                    and (mon.tenmon like '%$timkiem%' or loaitailieu like '%$timkiem%')
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
                                        <th scope="col">Thời gian đăng lên</th>
                                        <th scope="col">Tên file</th>
                                        <th scope="col">Tải xuống</th>
                                        <th scope="col">Xoa</th>
                                    </tr>
                                </thead>
                                <tbody>
            
        <?php
                        while($row = mysqli_fetch_array($queryTim))
                        {
                            $file = $row['tenfile'];
                            $mamon =$row['mamon'];
                            $idUpload = $row['id'];
                            // chuyển string thành thời gian để định dạng
                            $time=strtotime($row['ngaydang']);
                            echo "<tr>";
                                echo "<td style='color:green;'>" .$row['loaitailieu']." </td>";
                                echo "<td style='color:sienna;'><a title='Xem thư mục' href='xemthumuc.php?thumuc=$mamon'>" .$row['tenmon']. "</a></td>";
                                // dùng date() để định dạng
                                echo "<td>" .date('d-m-Y H:i:s',$time) ."</td>";
                                echo "<td>" .$row['tenfile']." </td>";
                                echo "<td style='text-align:center;'><a title='Tải xuống' href='files/$file' target='_blank'><img class='iconImg' src='img/dow.png'></a></td>";
                                echo "<td style='text-align:center;'><a title='Xóa'
                                onClick=\"javascript: return confirm('Bạn có muốn xóa tài liệu này?')\" href='?del=$idUpload'> <img class='iconImg' src='img/delete.png'></a></td>";
                            echo '</tr>';
                        }
                    }
                    if($timthay == false )
                    {
                        echo "<h1 style='display:flex;justify-content:center;align-items:center;color:navy;'>Không tìm thấy tài liệu thuộc môn này!</h1>";
                    }
                }
                else
                // trở lại trang ban đầu
                    echo "<script> 
                            // alert('Không có từ khóa tìm kiếm');
                            window.location.href='myupload.php';
                        </script>";
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
                                <th scope="col">Thời gian đăng lên</th>
                                <th scope="col">Tên file</th>
                                <th scope="col">Tải xuống</th>
                                <th scope="col">Xóa</th>
                            
                            </tr>
                        </thead>
                        <tbody>

        <?php 
                $hoten = $_SESSION['hoten'];

                $selectTailieu =
                "SELECT mon.mamon as mamon,upload.id,loaitailieu, mon.tenmon, ngaydang,tenfile,loaifile
                FROM uploads as upload, khoa as khoa,user as user,mon as mon 
                WHERE khoa.makhoa =upload.makhoa
                and mon.mamon =upload.mamon
                and user.macanbo =upload.macanbo
                and user.hoten = '$hoten'
                order by ngaydang desc 
                ";
                $query = mysqli_query($conn, $selectTailieu);
                $num_rows = mysqli_num_rows($query);
                if($num_rows == 0 )
                {
                    echo '<h3>Hiện tại chưa có tài liệu trong thư mục này';
                }
                else 
                {

                    while($row = mysqli_fetch_array($query))
                    {
                        $maMon = $row['mamon'];
                        $file = $row['tenfile'];
                        $idUpload = $row['id'];
                        // chuyển string thành thời gian để định dạng
                        $time=strtotime($row['ngaydang']);
                        echo "<tr>";
                            echo "<td style='color:green;'>" .$row['loaitailieu']." </td>";
                            echo "<td style='color:sienna;'> 
                            <a title='Xem thư mục' href='xemthumuc.php?thumuc=$maMon'>".$row['tenmon']."</a></td>";
                            // dùng date() để định dạng
                            echo "<td>" .date('d-m-Y H:i:s',$time) ."</td>";
                            echo "<td>" .$row['tenfile']." </td>";
                            echo "<td style='text-align:center;'><a title='Tải xuống' href='files/$file' target='_blank' style='color:blue'><img class='iconImg' src='img/dow.png'></a></td>";
                            
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
                            $selectTenfile ="SELECT tenfile from uploads where id='$deleteUpload'";
                            $ketquaTen = mysqli_query($conn,$selectTenfile);
                            $num_rows = mysqli_num_rows($ketquaTen);
                                
                                if($num_rows == 0 )
                                {
                                    echo "<script>alert('Sai truy vấn!');</script>";  
                                }
                                else
                                {
                                    $row = mysqli_fetch_array($ketquaTen);
                                    $file = $row['tenfile'];
                                        
                                }


                            
                            $Delete = "DELETE FROM uploads WHERE id='$deleteUpload' ";
                            $query = mysqli_query($conn, $Delete) or die (mysqli_error($conn));
                            // affected rows là cho biết biến conn làm ảnh hưởng bao nhiêu dòng (= 0 là k có dòng ảnh hưởng)

                            if (mysqli_affected_rows($conn) > 0) {
                                    $filename= 'files/'.$file;

                                    if(file_exists( $filename))
                                    {
                                        unlink($filename);
                                        echo "<script>alert('Tài liệu đã được xóa thành công!!!');
                                        window.location.href='myupload.php';</script>";
                                        
                                    }
                                    else
                                    echo "<script>alert('Không tồn tại file!');</script>";   
                            }
                            else {
                                echo "<script>alert('Tài liệu không xóa được!');</script>";   
                            }
                        }
                        ?>


