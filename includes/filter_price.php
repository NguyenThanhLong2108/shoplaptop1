<?php 

    require_once('include.php');
    require_once('conn.php');
    require_once('product.php');
    $fill = $_GET['price'];
    switch ($fill) {
        case 'duoi-1000';
            $dau =0;
            $duoi =1000; 
            break;
        
        case 'tu-1000-1500';
            $dau = 1000;
            $duoi = 1500;
            break;

        case 'tu-1500-2000';
            $dau = 1500;
            $duoi = 2000;
            break;    

        case 'tu-2000-2500';
            $dau = 2000;
            $duoi = 2500;
            break;    

        case 'tren-2500'; 
            $dau = 2500;

    }
    
?>

<section id="item" class="item">
    <div class="container">
        <div class="row item-title">
            <h2>Sản phẩm</h2>
        </div>
        <div class="row item-content">
            <div class="row" style="padding: 15px">
                <?php
                if($fill=='tren-2500'){
                    $sql_price = "SELECT * FROM SANPHAM where GIA>$dau";
                }
                else{
                    $sql_price = "SELECT * FROM SANPHAM where GIA>$dau AND GIA<$duoi";
                }
                $res = Check_db($sql_price);
                if(mysqli_num_rows($res) > 0){
                    while ($row = mysqli_fetch_assoc($res)) {
                        $masp = $row['MASP'];
                        $gia = $row['GIA'];
                        $phantram = View_Discount_Of_Product($masp);
                        if ($gia - $gia * $phantram / 100 != $gia) {
                            $giamoi = $gia - $gia * $phantram / 100;
                        } else {
                            $giamoi = "";
                        }
                            $tensp = $row['TENSP'];
                            $gia = $row['GIA'];
                            $res_hinh = Get_image($masp);
                            $row_hinh = mysqli_fetch_assoc($res_hinh);
                            $hinh = $row_hinh['LINK'];
                            $kichthuocmh = $row['KICHTHUOCMH'];
                            $vixuly = $row['VIXULY'];
                            $ram = $row['RAM'];
                            
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
                }else{    
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
