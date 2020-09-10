<?php
include("header.php");
?>
<style>
    td{
        padding: 10px 15px;
        border: 1px solid green;
    }

</style>
    <div class="containerProfile containerThanhTich">
        <div class="container">
            <?php
                if(isset($_GET['macanbo']))
                {
                    $macanbo = $_GET['macanbo'];
                    $selectThongtin = "SELECT user.macanbo,khoa.tenkhoa,hoten,ngaysinh,sdt,chucvu,email,gioitinh,hocvi,chuyennganh
                    from user as user, khoa as khoa where user.makhoa =khoa.makhoa and macanbo ='$macanbo'";
                    $query = mysqli_query($conn,$selectThongtin);
                    $numRows = mysqli_num_rows($query);
                    if($numRows == 0)
                        echo "Sai truy vấn";
                    else
                    {
                        while($row = mysqli_fetch_array($query))
                        {
             ?>
                        <div class="leftContent" style="margin-bottom: 20px;">
                            <table class="tb-thanhtich">
                                <tr>
                                    <td class="title" colspan="2">Thông tin giáo viên</td>
                                </tr>
                                <tr>
                                    <td><strong>Họ tên giáo viên:</strong></td>
                                    <td> <?= $row['hoten']?></td>
                                </tr>
                                <tr>
                                    <td><strong>Khoa:</strong> </td>
                                    <td><?=  $row['tenkhoa']?> </td>
                                </tr>
                                <tr>
                                    <td><strong>Chức vụ:</strong> </td>
                                    <td><?php echo $row['chucvu']?> </td>
                                </tr>
                                <tr>
                                    <td><strong>Học vị:</strong> </td>
                                    <td> <?php echo $row['hocvi']?>  </td>
                                </tr>
                                <tr>
                                    <td><strong>Chuyên ngành:</strong> </td>
                                    <td> <?php echo $row['chuyennganh']?>  </td>
                                </tr>
                                <tr>
                                    <td><strong>Giới tính:</strong> </td>
                                    <td> <?php echo $row['gioitinh']?>  </td>
                                </tr>
                                <tr>
                                    <td><strong>Ngày sinh:</strong> </td>
                                    <td> 
                                        <?php 
                                            $time=strtotime($row['ngaysinh']);
                                            echo date('d-m-Y',$time) 
                                        ?> </td>
                                </tr>
                                <tr>
                                    <td><strong>Số điện thoại:</strong></td>
                                    <td><?php echo $row['sdt']?></td>
                                </tr>
                                <tr>
                                    <td><strong>Email:</strong></td>
                                    <td><?php echo $row['email']?></td>
                                </tr>
                            </table>
                        </div>
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
