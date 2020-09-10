<?php
include("header.php");
?>
    <div class="containerUpload">
        <div class="container">
            <h2 style="text-align: center;font-weight: bold;color: sienna;text-transform: uppercase;">Upload tài liệu</h2>
            <div class="formUpload">
                <form action="" method = "POST" enctype = "multipart/form-data">
                    <h3 style="font-style: italic;color:teal;">Upload</h3>
                    Hãy chọn loại tài liệu:
                    <div style="width:200px;" class="input-group mb-3">
                        <select name="chontailieu"  class="custom-select" id="inputGroupSelect02">
                            <option selected value="">Tài liệu...</option>
                            <option value="Bài giảng">Bài giảng</option>
                            <option value="Giáo trình">Giáo trình</option>
                            <option value="Đề cương">Đề cương</option>
                            <option value="Lịch giảng dạy">Lịch giảng dạy</option>
                            <option value="Đề tài NCKH">Đề tài NCKH</option>
                        </select>
                    </div>
                    Hãy chọn môn:
                    <div style="width:200px;" class="input-group mb-3">
                        <select name="chonmon"  class="custom-select" id="inputGroupSelect02">
                            
                            <?php 
                            //lấy tên khoa của người dùng
                            $tenkhoa = $_SESSION['tenkhoa'];
                            $selectMon = "SELECT mamon, tenmon 
                            FROM mon as mon, khoa as khoa 
                            WHERE mon.makhoa = khoa.makhoa 
                            and khoa.tenkhoa = '$tenkhoa'";
                            $query = mysqli_query($conn, $selectMon);
                            $num_rows = mysqli_num_rows($query);
                            if($num_rows == 0 )
                            {
                                echo 'Sai truy vấn';
                            }
                            else
                            {
                                echo '<option selected value="">Môn...</option>';
                                while($row = mysqli_fetch_array($query))
                                {
                                echo '<option value='.$row['mamon'].'>' .$row['tenmon'].'</option>';
                                }
                            }

                            ?>
                        </select>
                       
                    </div>
                    <p><strong>Lưu ý:</strong> file phải thuộc định dạng <span style="color:red;">.docx, .pptx, .pfd, .xlsx</span> và kích thước không quá <span style="color:red;">50MB</span></p>
                    <input type="file" name="upload">
                    <br>
                    <input class="btnUpload" type="submit" value="Upload" name="Upload">
                    <?php
                // Kiểm tra nếu form đã submit
                if(isset($_POST['Upload'])){
                    // Kiểm tra xem file đã tải lên mà không có lỗi
                    if(isset($_FILES["upload"]) && $_FILES["upload"]["error"] == 0)
                    {
                        
                        $chonloai = $_POST['chontailieu'];
                        $chonmon = $_POST['chonmon'];
                        $filename = $_FILES["upload"]["name"];
                        $filetype = $_FILES["upload"]["type"];
                        $filesize = $_FILES["upload"]["size"];

                        // Xác nhận phần mở rộng của file
                        $ext = pathinfo($filename, PATHINFO_EXTENSION);
                        $validExt = array ('pdf', 'doc', 'docx', 'pptx' , 'xlsx');
                        // kích thước không quá 50mb
                        $maxsize = 50 * 1024 * 1024;

                        if($chonloai=="")
                            echo "<p style='color:red;text-align:center;'>Loại tài liệu chưa được chọn</p>";
                        else if($chonmon=="")
                            echo "<p style='color:red;text-align:center;'>Môn chưa được chọn</p>";
                        else if(!in_array($ext, $validExt))
                            echo "<p style='color:red;text-align:center;'>Định dạng file không đúng</p>";
                        else if($filesize > $maxsize)
                            echo "<p style='color:red;text-align:center;'>Kích thước File quá lớn</p>";
                        else if(file_exists("files/" . $filename))
                            echo "<p style='color:red;text-align:center;'>Đã tồn tại file này</p>";
                        else
                        {
                            $makhoa = $_SESSION['makhoa'];
                            $macanbo = $_SESSION['macanbo'];
                            $mamon  = $chonmon;
                            $loaitailieu = $chonloai;

                            move_uploaded_file($_FILES["upload"]["tmp_name"], "files/" . $filename);
                            //thêm tt file vào db upload
                            $insertFile = 
                            "INSERT INTO uploads(makhoa,macanbo,mamon,ngaydang,loaitailieu,tenfile,loaifile) 
                            values('$makhoa' ,'$macanbo','$mamon',now(),'$loaitailieu','$filename','$ext')";
                            $query = mysqli_query($conn,$insertFile);
                            if ($query!=0) {
                                echo "<p style='color:green;text-align:center;'>File đã được upload thành công</p>";

                            }
                            else 
                                echo '<script> alert ("Sai truy vấn"); </script>';
                        
                        }
                    }
                    else
                         echo "<p style='color:red;text-align:center;'>Chưa có file upload</p>";
                }   
            ?>
                </form>
                <div class="contentRight">
                    <h3 style="font-style: italic;color:teal;">Danh sách môn</h3>
                    <!-- table -->
                    <table class="table table-bordered table-hover">
                      <thead>
                        <tr>
                          <th style="background-color: #ccc;" scope="col">Tên môn</th>
                          <th style="background-color: #ccc;" scope="col">Thư mục</th>
                        </tr>
                      </thead>
                      <tbody>
                            <?php
                                $makhoa = $_SESSION['makhoa'];
                                $dsMon = "SELECT mon.mamon,tenmon from mon as mon,khoa as khoa
                                where khoa.makhoa = mon.makhoa 
                                and khoa.makhoa = '$makhoa'";
                                $ketquaDS = mysqli_query($conn,$dsMon);
                                $num_rows = mysqli_num_rows($ketquaDS);
                                if ($num_rows == 0) {
                                    echo 'Lỗi truy vấn';
                                }
                                else
                                {
                                    while ($cot = mysqli_fetch_array($ketquaDS)) 
                                    {
                                        $mamon = $cot['mamon'];
                                        echo "<tr>";
                                        echo "<td style='color:blue;'>" .$cot['tenmon']. "</td>";
                                        // ?thumuc là biến GET và đem qua trang xemthumuc
                                        echo "<td style='text-align:center;'><a title='Xem thư mục' href='xemthumuc.php?thumuc=$mamon'><img class='iconImg' src='img/folder.png'></a></td>";
                                        echo "</tr>";
                                    }
                                    
                                }
                            ?>
                      </tbody>
                    </table>

                    <form method="post">
                        <!-- Thêm môn -->
            <?php
            if (isset($_POST['themmonmoi'])) {
                $tenmonmoi = $_POST['monmoi'];
                $makhoa = $_SESSION['makhoa'];

                if ($tenmonmoi=="") {
                    echo "<p style='color:red;text-align:center;'>Chưa nhập tên môn</p>";
                }
                else if(is_numeric($tenmonmoi))
                    echo "<p style='color:red;text-align:center;'>Tên môn sai</p>";
                else
                {
                    // lấy tên môn để so sánh
                    $selectMon = "SELECT tenmon from mon";
                    $kqselectMon = mysqli_query($conn,$selectMon);
                    $num_rows = mysqli_num_rows($kqselectMon);
                    if($num_rows == 0 )
                    {
                        echo 'Sai truy vấn';
                    }
                    else
                    {
                        $chapnhan =true;
                        while ($rowMon = mysqli_fetch_array($kqselectMon)) {
                            if ($rowMon['tenmon'] == $tenmonmoi) {
                                // nếu có 1 tên môn giống trong csdl thì $chapnhan bằng false
                                $chapnhan=false;
                            }
                        }
                        // nếu chấp nhận bằng true thì cho phép thêm môn
                        if ($chapnhan) {
                            // nếu k trùng tên môn thì thêm vào
                            $insertMon = "INSERT INTO mon(tenmon,makhoa) values('$tenmonmoi','$makhoa')";
                            $kqinsertMon = mysqli_query($conn,$insertMon);
                            echo '<script> 
                            // reload lại trang
                                window.location.href="upload.php";
                            </script>';

                        }
                        else 
                             echo "<p style='color:red;text-align:center;'>Môn này đã tồn tại</p>";
                    }
                }
            }
            ?>
                        <h5 style="color:green;margin: 0 !important;">Thêm thư mục môn mới</h5>
                        <input type="text" name="monmoi" placeholder="Tên môn">
                        <input class="btnUpload" type="submit" name="themmonmoi" value="Thêm">
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php 
include("footer.php");
?>  
            
   
            
