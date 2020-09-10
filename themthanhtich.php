<?php
    include("header.php");
    include("function.php");
    if(!empty($_SESSION['macanbo'])) {
?>
   
    <div class="containerTailieu containerThanhTich">
        <h2>Thêm thành tích</h2>
        <div class="container" style="display:flex;justify-content: space-around;margin-top:20px">
            <?php 
                 if (isset($_GET['action']) && $_GET['action'] == 'add') {
                    $soquyetdinh = $_POST['soquyetdinh'];
                    $namquyetdinh = $_POST['namquyetdinh'];
                    $noidung = $_POST['noidung'];
                    $ghichu = $_POST['ghichu'];
                    $macanbo = $_SESSION['macanbo'];

                    if (isset($_FILES['file']) && !empty($_FILES['file']['name'][0])) {
                        $uploadedFiles = $_FILES['file'];
                        $result_img = uploadFiles($uploadedFiles);
                        if (!empty($result_img['errors'])) {
                            $error = $result_img['errors'];
                        } else {
                            $image = $result_img['path'];
                        }
                    }
                    if(empty($image) || empty($soquyetdinh) || empty($namquyetdinh) || empty($noidung)) {
                        $error = "<h1>Vui lòng không bỏ trống các trường có dấu *</h1> ";
                    } else {
                        $insertThanhTich = mysqli_query($conn, "INSERT INTO thanhtich (id, macanbo, soquyetdinh, noidung, hinhanh, nam, ghichu) 
                                        VALUES (NULL, '$macanbo', '$soquyetdinh', '$noidung', '$image','$namquyetdinh', '$ghichu');");
                        if (!$insertThanhTich) {
                            $error = "Có lỗi xảy ra trong quá trình thực hiện.";
                        } 
                    } ?>
                    <?= isset($error) ? $error : '
                        <script>
                            window.location.href="thanhtichcanhan.php";
                        </script>' 
                    ?>
                                  
               <?php } else { ?> 
                    <form method="POST" action="?action=add"  enctype="multipart/form-data" class="themthanhtich">
                        <div class="formLeft">
                            <label>Số quyết định *:</label>
                            <input type="text" name="soquyetdinh" placeholder="Nhập số quyết định">
                            <label>Năm quyết định *:</label>
                            <input type="date" name="namquyetdinh" placeholder="Nhập năm quyết định">
                            <label>Nội dung *:</label>
                            <textarea type="text" name="noidung" placeholder="Nhập nội dung"></textarea>
                            <label>Hình ảnh *:</label>
                            <input type="file" name="file"/>
                        </div>
                        <div class="formRight">
                            <label>Ghi chú:</label>
                            <textarea name="ghichu" id="ghichuthanhtich" style="width:100%;height:200px;padding:10px;outline:none"></textarea>
                        </div>
                        <input class="btn_themtt" type="submit" value="Thêm">
                    </form>
                <!-- Thành tích -->
                    <script>
                        var options = {
                            theme: 'snow'
                            };
                        var editor = new Quill('#ghichuthanhtich', options);
                    </script>
             <?php               
                }
            }
        ?>
    </div>
    </div>

<?php 
include("footer.php");
?>