<?php
include("header.php");
?>
    <div class="containerTailieu containerThanhTich">
        <h2>Thành tích cá nhân</h2>
        <div class="container" style="display:flex;justify-content:space-around;margin-top:30px;flex-wrap:wrap">
            <div class="table-responsive-lg">
                <table class="table table-striped table-hover ">
                    <tr>
                        <th>Số quyết định</th>
                        <th>Nội dung </th>
                        <th>Năm quyết định</th>
                        <th>File </th>
                        <th>Tải</th>
                        <th>Thao tác</th>
                        <th>Thao tác</th>
                    </tr>                  
            <?php 
                    $macanbo =$_SESSION['macanbo'];
                    $selectTanhtich = "SELECT * FROM thanhtich as tt where macanbo ='$macanbo'";
                    $query = mysqli_query($conn,$selectTanhtich);
                    $numRows = mysqli_num_rows($query);
                    if($numRows == 0)
                        echo "<h1>Hiện tại bạn chưa có Thành tích nào trong đây</h1>";
                    else { 
                        
                        while($row = mysqli_fetch_array($query))
                        {
                            $tenfile = $row['hinhanh'];
             ?>         <tr>
                            <td> <?= $row['soquyetdinh']?></td>
                            <td> <?= $row['noidung']?></td>
                            <td><?=$row['nam']?> </td>
                            <td><?= $row['hinhanh']?></td>
                            <td style='text-align:center;'><a title='Tải xuống' href='uploads/<?= $row['hinhanh']?>' target='_blank'><img class='iconImg' src='img/dow.png'></a></td>
                            <td><a class="link_update" href="capNhatThanhTich.php?id=<?= $row['id']?>">Cập nhật</a></td>
                            <td><a  onClick=" return confirm('Bạn có muốn xóa thành tích này?')" class="link_update" href="?deleteid=<?= $row['id']?>">Xoá</a></td>
                        </tr>  
            <?php               
                        }
                        
                    }
            ?>
                </table>
            </div>
        </div>
        <a class="link_them" href="themthanhtich.php">Thêm thành tích</a> 
    </div>

<?php 
include("footer.php");
?>
    <?php 
        if(isset($_GET['deleteid'])) {
            $id = $_GET['deleteid'];
            mysqli_query($conn,"DELETE FROM thanhtich WHERE id = $id");
            echo "<script>
                window.location.href='thanhtichcanhan.php';
            </script>";
        }
    ?>