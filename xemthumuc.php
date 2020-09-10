<?php
include("header.php");
?>

<div class="containerTailieu">
        <div class="container">
            <h2>Thư mục môn<span style="color:orangered;font-weight:bold;">
            <?php 
            // lấy GET từ trang upload 
            // thumuc là mamon của môn
            if(isset($_GET['thumuc']) )
            {
                $mamon =  $_GET['thumuc'];
                $query = mysqli_query($conn,"SELECT tenmon from mon where mamon = '$mamon'");
                $row = mysqli_fetch_array($query);
                echo $row['tenmon'];
            }
            
            // $_SESSION['mamon'] = $_GET['thumuc'];
            ?></span></h2>
            <?php 
                $sosanh = mysqli_query($conn,"SELECT upload.mamon as mamon from mon as mon, uploads as upload where upload.mamon = mon.mamon");
                $coMon =false;
                while($row = mysqli_fetch_array($sosanh))
                {
                    if($row['mamon']==$mamon)
                    {
                        $coMon =true;
                    }
                }
                if ($coMon)
                // mở ngoặc 1
                {
            ?>
            <div class="table-responsive-lg">
                <table class="table table-striped table-hover ">
                    <thead>
                        <tr style="text-align: center;align-items: center;">
                            <th scope="col">Loại tài liệu</th>
                            <th scope="col">Người đăng</th>
                            <th scope="col">Thời gian đăng lên</th>
                            <th scope="col">Tên file</th>
                            <th scope="col">Tải xuống</th>
                            <th scope="col">Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
            <?php 
            // đóng ngoặc 1
                }
                else
              // mở ngoặc 2   
                {
                    echo "<h2 style='text-transform:uppercase;color:green;margin-top:50px;'>Hiện tại chưa có file nào trong thư mục môn này!</h2>";
            ?>
                    <!-- dòng này thực hiện trong php nhưng code của html :v -->
                    <form action="" method="POST">
                        <a style="display:block;width:150px;text-align:center;margin:40px auto;" class="btnUpload" href="upload.php">Upload thêm</a>
                        <input style="display:block;width:150px;text-align:center;margin:40px auto;" class="btnUpload btnDelete"  onClick="javascript: return confirm('Bạn có muốn xóa thư mục này?')" type="submit" value="Xóa thư mục" name="btndelThumucrong">
                    </form>
            <?php  
            // đóng ngoặc 2  
                } 
            ?>
                        <?php 
                             $tenkhoa = $_SESSION['tenkhoa'];

                            $selectTailieu =
                            "SELECT mon.mamon,loaitailieu, user.hoten, ngaydang,tenfile,tenmon,upload.id as idTailieu,user.macanbo
                            FROM uploads as upload,user as user,mon as mon,khoa as khoa
                            WHERE  mon.mamon =upload.mamon
                            and user.macanbo =upload.macanbo
                            and khoa.tenkhoa ='$tenkhoa'
                            and khoa.makhoa =upload.makhoa
                            and mon.mamon ='$mamon'
                            order by ngaydang desc ";
                            
                            $query = mysqli_query($conn, $selectTailieu);
                            
                               
                            while($row = mysqli_fetch_array($query))
                            {
                                $file = $row['tenfile'];
                                $idTailieu = $row['idTailieu'];
                                $maCanbo = $row['macanbo'];
                                // chuyển string thành thời gian để định dạng
                                $time=strtotime($row['ngaydang']);
                                echo "<tr>";
                                    echo "<td style='color:green;'>" .$row['loaitailieu']." </td>";
                                    echo "<td style='color:navy;'><a title='Xem thông tin' href='viewprofile.php?macanbo=$maCanbo'>" .$row['hoten']."</a> </td>";
                                    // dùng date() để định dạng
                                    echo "<td>" .date('d-m-Y H:i:s',$time) ."</td>";
                                    echo "<td>" .$row['tenfile']." </td>";
                                    echo "<td style='text-align:center;'><a title='Tải xuống' href='files/$file'>
                                    <img class='iconImg' src='img/dow.png'></a></td>";
                                    echo "<td style='text-align:center;'><a title='Xóa'
                                    onClick=\"javascript: return confirm('Bạn có muốn xóa tài liệu này?')\" href='deleteFile.php?delTailieu=$idTailieu'> <img class='iconImg' src='img/delete.png'></a></td>";
                                echo '</tr>';
                            }
                            
                        ?>

                    </tbody>
                </table>
                <?php 
                // nếu có table upload có file thuộc môn này
                if($coMon)
                    {
                ?>
                    <form action="" method="POST">
                        <a title="Upload" class="btnUpload" href="upload.php">Upload</a>
                        <input title="Xóa thư mục" class="btnUpload btnDelete" 
                        onClick="javascript: return confirm('Trong thư mục còn các tập tài liệu. Bạn có muốn xóa thư mục này?')"  type="submit" value="Xóa thư mục" name="btndelThumuc">
                            <!-- delete cả thư mục môn.Phải xóa các file của môn có trong table upload trước rồi mới xóa dc môn -->
                            <?php 
                            if(isset($_POST['btndelThumuc']))
                            {
                                // lấy biến GET 
                                $mamon = $_GET['thumuc'];
                                // lấy tên file để bên dưới xóa
                                $ketquaTen = mysqli_query($conn,"SELECT tenfile from uploads as upload,mon as mon where upload.mamon='$mamon' and upload.mamon=mon.mamon");
                        ?>
                        <?php      
                                
                                // thực hiện xóa dùng MÃ MÔN
                                $manguoidang = $_SESSION['macanbo'];
                                // xuất ra số người trong upload để so sánh
                                $xoa   = false;
                                $songuoidang = mysqli_query($conn,"SELECT DISTINCT macanbo from uploads where mamon = '$mamon'");
                                $num_rows = mysqli_num_rows($songuoidang);
                                if($num_rows == 0 )
                                {
                                    echo 'Sai truy vấn';
                                }
                                else{
                                    $nhieunguoi = false;
                                    
                                    while($rowNguoidung = mysqli_fetch_array($songuoidang))
                                    {
                                        if( $rowNguoidung['macanbo'] != $manguoidang){
                                            $nhieunguoi = true;
                                        }
                                    }
                                    // chỉ xóa được nếu chỉ có bản thân giáo viên đó đăng tài liệu vào thuộc môn này .Nếu có gv khác thì k thể xóa
                                    if($nhieunguoi == false)
                                    {
                                            $thuchienDelTailieu = mysqli_query($conn,"DELETE from uploads where mamon='$mamon' and macanbo = '$manguoidang'") 
                                                or die (mysqli_error($conn));
                                            $xoa = true;
                                    }  
                                    else
                                    {
                                            echo "<p style='color:red;text-align:center;'>Thư mục này còn tài liệu của giáo viên khác</p>";
                                    }      
                                    if($xoa==true){
                                            // sau khi đã xóa file là khóa ngoại thì tiến hành xóa môn đó lun 
                                            $thuchienDelMon = mysqli_query($conn,"DELETE from mon where mamon='$mamon'") 
                                            or die (mysqli_error($conn)) ;
                                            if(mysqli_affected_rows($conn))
                                            {
                                                while($row = mysqli_fetch_array($ketquaTen))
                                                {
                                                    $file = $row['tenfile'];
                                                    $filename= 'files/'.$file;
                                                    unlink($filename);
                                                }
                                                echo "<script>
                                                window.location.href='upload.php';</script>";
                                            }
                                        }

                                    }
                                
                            }
                            
                        ?>
                    </form>
                <?php } ?>
            </div>
               
        </div>
    </div>
<?php
include("footer.php");
?>

                        



                        <?php 
                        //  xóa thư mục rỗng 
                        if(isset($_POST['btndelThumucrong']))
                        {
                            $thuchienDelMonRong = mysqli_query($conn,"DELETE from mon where mamon='$mamon'");
                            if(mysqli_affected_rows($conn))
                            {
                                echo "<script>
                                window.location.href='upload.php';</script>";
                            }
                        }

                        ?>