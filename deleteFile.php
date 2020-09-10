<?php
include("header.php");
?>

<?php
include("footer.php");
?>
                        <?php 

                            // biến delTailieu là biến id của table Uploads                            
                            if(isset($_GET['delTailieu']))
                            {
                                // lấy biến GET
                                $idtailieuDel =$_GET['delTailieu'];

                                $ketquaTen = mysqli_query($conn,"SELECT tenfile from uploads where id='$idtailieuDel'");
                                $row = mysqli_fetch_array($ketquaTen);
                                $file = $row['tenfile'];
                           
                               
                        ?>
                        <?php 
                                // lấy mã cán bộ để so sánh vs người đăng trong Upload. Nếu cùng là 1 người thì cho xóa
                                $manguoidang = $_SESSION['macanbo'];
                                // thực hiện xóa dùng id của table upload
                                $thuchienDelTailieu = mysqli_query($conn,"DELETE from uploads where id='$idtailieuDel' and macanbo = '$manguoidang'") 
                                    or die (mysqli_error($conn)) ;
                                // affected rows là cho biết biến conn làm ảnh hưởng bao nhiêu dòng (= 0 là k có dòng ảnh hưởng)
                                if(mysqli_affected_rows($conn))
                                {
                                    $filename= 'files/'.$file;

                                    if(file_exists( $filename))
                                    {
                                        unlink($filename);
                                        echo "<script>
                                        window.history.back();</script>";
                                        
                                    }
                                    else
                                        echo "<script>alert('Không tồn tại file!');</script>"; 
                                }
                                else
                                {
                                    echo "<script>
                                    window.history.back();</script>";
                                }
                            }

                        ?>




