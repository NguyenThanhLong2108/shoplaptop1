<?php
require_once('./includes/include.php');
require_once('./includes/conn.php');
require_once('./includes/product.php');
?>
<!DOCTYPE html>
<html lang="en">
<?php include('./includes/head.php') ?>

<body>
    <!-- header -->
    <?php include('./includes/header.php') ?>
    <!-- banner -->
    <section class="carousel">
        <div class="container">
            <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner" role="listbox">
                    <div class="carousel-item active">
                        <img src="./FE/image/banner-1143x357-1.jpg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="./FE/image/banner2.jpg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="./FE/image/banner-laptop-800x300.png" class="d-block w-100" alt="...">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- filter -->
    <?php include('includes/filter.php') ?>
    <!-- New Item -->
    <?php
    if (isset($_GET['action'])) {
        $action = $_GET['action'];
        switch ($action) {
            case 'filter_ram';
                include './includes/filter_ram.php';
                break;

            case 'filter_cpu';
                include './includes/filter_cpu.php';
                break;

            case 'filter_producer';
                include './includes/filter_producer.php';
                break;

            case 'filter_price';
                include './includes/filter_price.php';
                break;

            case 'filter_screen';
                include './includes/filter_screen.php';
                break;
        }
    } else {
        include './includes/item.php';
    }
    ?>
    <!-- bestseller  -->
    <section class="bestseller" id="bestseller">
        <div class="container">
            <div class="row bestseller-title">
                <h2>Sản phẩm bán chạy</h2>
            </div>
            <div class="row bestseller-content item-content">
                <!-- <div class="row"> -->
                <div class="row" style="padding: 15px">
                    <?php
                    $sql = "SELECT * , SUM(SOLUONGDAT) FROM sanpham,monhang where sanpham.MASP=monhang.MASP 
                        GROUP BY monhang.MASP ORDER BY SUM(SOLUONGDAT) DESC LIMIT 4";
                    $res = Check_db($sql);
                    while ($row = mysqli_fetch_assoc($res)) {
                        $masp = $row['MASP'];
                        $tensp = $row['TENSP'];
                        $gia = $row['GIA'];
                        $phantram = View_Discount_Of_Product($masp);
                        if ($gia - $gia * $phantram / 100 != $gia) {
                            $giamoi = $gia - $gia * $phantram / 100;
                        } else {
                            $giamoi = "";
                        }
                        $kichthuocmh = $row['KICHTHUOCMH'];
                        $vixuly = $row['VIXULY'];
                        $ram = $row['RAM'];
                        $res_img = Get_image($masp);
                        $row_img = mysqli_fetch_assoc($res_img);
                        $hinh = $row_img['LINK'];
            ?>
                        <div class='card-group col-md-3 col-sm-6'>
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
                    ?>
                </div>
            </div>
        </div>
    </section>
    <!-- sales  -->
    <section id="sales" class="sales">
        <div class="container">
            <div class="row sales-title">
                <h2>Sản phẩm giảm giá</h2>
            </div>
            <div class="row sales-content">
                <div class="row" style="padding: 15px">
                    <?php
                    $sql = "SELECT * FROM sanpham where MAGIAMGIA IS NOT NULL";
                    $res = Check_db($sql);
                    if(mysqli_num_rows($res)){
                        while ($row = mysqli_fetch_assoc($res)) {
                            $masp = $row['MASP'];
                            $tensp = $row['TENSP'];
                            $gia = $row['GIA'];
                            $phantram = View_Discount_Of_Product($masp);
                            if ($gia - $gia * $phantram / 100 != $gia) {
                                $giamoi = $gia - $gia * $phantram / 100;
                            } else {
                                $giamoi = "";
                            }
                            $kichthuocmh = $row['KICHTHUOCMH'];
                            $vixuly = $row['VIXULY'];
                            $ram = $row['RAM'];
                            $res_img = Get_image($masp);
                            $row_img = mysqli_fetch_assoc($res_img);
                            $hinh = isset($row_img['LINK']) ? $row_img['LINK'] : '';
                        ?>
                            <div class='card-group col-md-3 col-sm-6'>
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
                                                        <span>$" . $giamoi . "</span>";
                                            }
                                            ?>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        <?php
                        }
                    }
                    else {
                        ?> <div class="row searchItem-content justify-content-center flex-column align-items-center">
                                <div class="row" style="padding: 15px">
                                    <img src='./hinhanh/Out_of_stock.jpg' width="70%" height="70%">
                                </div>
                                <div>
                                    <h3>Rất tiếc cửa hàng tạm hết mặt hàng này</h3>
                                </div>
                            </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
    <!-- footer -->
    <?php include('./includes/footer.php') ?>
    <!-- script -->
    <?php include('./includes/script.php') ?>
</body>

</html>