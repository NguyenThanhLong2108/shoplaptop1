<?php 
    require_once('include.php');
    require_once('conn.php');
    require_once('product.php');

    $producer = $_GET['producer'];
    $sql_producer = "SELECT * FROM SANPHAM WHERE mansx ='$producer'";
    $res = Check_db($sql_producer);
    
?>

<section id="item" class="item">
    <div class="container">
        <div class="row item-title">
            <h2>Sản phẩm</h2>
        </div>
        <div class="row item-content">
            <div class="row" style="padding: 15px">
                <?php
                if(mysqli_num_rows($res) > 0){
                    while ($row = mysqli_fetch_assoc($res)) {
                        $masp = $row['MASP'];
                        $tensp = $row['TENSP'];
                        $gia = $row['GIA'];
                        $res_hinh = Get_image($masp);
                        $row_hinh = mysqli_fetch_assoc($res_hinh);
                        $hinh = $row_hinh['LINK'];
                        $phantram = View_Discount_Of_Product($masp);
                        if ($gia - $gia * $phantram / 100 != $gia) {
                            $giamoi = $gia - $gia * $phantram / 100;
                        } else {
                            $giamoi = "";
                        }
                        $kichthuocmh = $row['KICHTHUOCMH'];
                        $vixuly = $row['VIXULY'];
                        $ram = $row['RAM']
        
                    
                
                    ?>
                        <div class="card-group col-md-3 col-sm-6">
                            <div class='card card-laptop-item'>
                                <a href='./view_product.php?masp=<?php echo $masp ?>'>
                                    <div class='card-header'>
                                        <img src='./admin/product_images/<?php echo $hinh ?>' class='card-img-top' alt=''>
                                    </div>
                                    <div class='card-body'>
                                        <h4 class='card-title'><?php echo $tensp ?></h4>
                                    </div>
                                    <div class='card-footer'>
                                        <?php
                                        if ($giamoi == "") {
                                            echo " <span>$" . $gia . "</span>";
                                        } else {
                                            echo "<s>
                                                        <span>$" . $gia . "</span>
                                                </s>
                                                <span class='giaMoi'>$" . $giamoi . "</span>";
                                        }
                                        ?>
                                    </div>
                                </a>
                            </div>
                        </div>
                <?php
                    }
            }
                else{
                ?>
                    <div class="row searchItem-content justify-content-center flex-column align-items-center">
                        <div class="row" style="padding: 15px">
                            <img src='./hinhanh/Out_of_stock.jpg' width="70%" height="70%">
                        </div>
                        <h3>Rất tiếc cửa hàng tạm hết mặt hàng này</h3>
                    <div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</section>