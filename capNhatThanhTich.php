<?php
include("header.php");
include("function.php");
if(!empty($_SESSION['macanbo'])) {
    $id = $_GET['id'];
    $selectThanhTich = mysqli_query($conn, "SELECT * FROM thanhtich WHERE id = '$id'");
?>
   
    <div class="containerTailieu containerThanhTich">
        <h2>Cập nhật thành tích</h2>
        <div class="container" style="display:flex;justify-content: space-around;margin-top:20px">
            <?php 
                 if (isset($_POST['update'])) {

                    $macanbo = $_SESSION['macanbo'];
                    $soquyetdinh = $_POST['soquyetdinh'];
                    $namquyetdinh = $_POST['namquyetdinh'];
                    $noidung = $_POST['noidung'];
                    $ghichu = $_POST['ghichu'];
                    $idtt = $_POST['idtt'];

                    if (isset($_FILES['file']) && !empty($_FILES['file']['name'][0])) {
                        $uploadedFiles = $_FILES['file'];
                        $result_img = uploadFiles($uploadedFiles);
                        // $result_img = validateUploadFile($file, $uploadPath);
                        if (!empty($result_img['errors'])) 
                            $error =  $result_img['errors'];
                        else {
                            $image = $result_img['path'];
                        }
                    }
                    // $validTypes = array("jpg", "jpeg", "png", "bmp","xlsx","xls", "doc","docx", "pptx");
                    // $fileType = strtolower(substr($file['name'], strrpos($file['name'], ".") + 1));

                    // if ( $_FILES['file']['size'] > 50 * 1024 * 1024) { //max upload is 2 Mb = 2 * 1024 kb * 1024 bite
                    //     $error = "<script>alert('File quá lớn'); window.history.back();</script>";
                    // }
                    // elseif(!in_array($fileType, $validTypes)) {
                    //     $error = "<script>alert('File không hợp lệ'); window.history.back();</script>";
                    // } 
                    if(empty($image) || empty($soquyetdinh) || empty($namquyetdinh) || empty($noidung)) {
                        $error = "<script>alert('Vui lòng không bỏ trống các trường có dấu *');window.history.back();</script> ";
                    } else {
                        $updateThanhTich = mysqli_query($conn, "UPDATE thanhtich SET soquyetdinh = '$soquyetdinh', noidung = '$noidung', 
                        hinhanh = '$image', nam = '$namquyetdinh', ghichu = '$ghichu' WHERE id = ' $idtt'");
                         if (!$updateThanhTich) {
                            $error = "Có lỗi xảy ra trong quá trình thực hiện.";
                        } 
                    } ?>
                        <?= isset($error) ? $error : '
                        <script>
                            window.location.href="thanhtichcanhan.php";
                        </script>' ?>
                    </div>
                <!-- Cập nhật Thành tích -->         
               <?php } else { ?> 
                    <form method="POST" action=""  enctype="multipart/form-data" class="themthanhtich">
                        <?php  while($row = mysqli_fetch_array($selectThanhTich)) { ?>
                            <div class="formLeft">
                                <input type="hidden" name="idtt" value="<?= $row['id']?>">
                                <label>Số quyết định *:</label>
                                <input type="text" name="soquyetdinh" value="<?= $row['soquyetdinh']?>">
                                <label>Năm quyết định *:</label>
                                <input type="text" name="namquyetdinh" value="<?= $row['nam']?>">
                                <label>Nội dung *:</label>
                                <textarea type="text" name="noidung"><?= $row['noidung']?></textarea>
                                <label>Hình ảnh *:</label>
                                <input type="file" name="file"  />
                               
                            </div>
                            <div class="formRight">
                                <label>Ghi chú:</label>
                                <textarea name="ghichu" id="ghichuthanhtich"></textarea>
                            </div>
                            <input class="btn_themtt" type="submit" name="update" value="Cập nhật">
                        </form>
        
                        <script>
                            var options = {
                                theme: 'snow'
                                };
                            var editor = new Quill('#ghichuthanhtich', options);
                        </script>
             <?php
                    }               
                }
            }
        ?>
    </div>
    </div>

<?php 
include("footer.php");
?>