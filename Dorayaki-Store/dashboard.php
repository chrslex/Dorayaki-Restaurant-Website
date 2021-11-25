<?php
require "access-admin-user.php";
require "database.php";
$alldorayaki = sortDashboard($db, 12); // Maksimal ditampilkan 12 dorayaki
$total_penjualan = getTotalPenjualanDorayaki($db);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="js/script.js"></script>
</head>
<body>
    <div class="glassmorphism-bg" id="header">
        <a href="" class="navbar-name">Doraemo<span style="color: red;">Nangis</span></a>
        <div class="resHeader">
            <div class="search-container left">
                <form action="search-result.php" method="get" autocomplete="off">
                    <input type="text" id="search" placeholder="Search.." name="search" class="glassmorphism-bg">
                    <button type="submit"><i class="fa fa-search"></i></button>
                </form>
            </div>
            <div class="right">
                <?php if(!$_SESSION["is_admin"]) :?>
                    <a href="riwayat-pembelian.php" class=""><i class="fa fa-history"></i> Riwayat Pembelian</a>
                <?php else:?>
                    <a href="riwayat-ubah-stok.php" class=""><i class="fa fa-history"></i> Riwayat Pengubahan</a>
                    <a href="add-dorayaki.php" class=""><i class="fa fa-plus"></i> Add Dorayaki</a>
                <?php endif;?>
                <a href="logout.php"><i class="fa fa-sign-out"></i> Log Out</a>
                <a href=""><i class="fa fa-user"></i><?php echo " ".$_SESSION["username"];?></a>
            </div>
        </div>
        <a href="javascript:void(0);" id="hamburger-menu" onclick="responsiveHeader()">
            <i class="fa fa-bars"></i>
        </a>
    </div>
    <p class="glassmorphism-bg" id="content-title">Daftar Varian Dorayaki</p>
    <div class="container" id="main-content">
        <div class="row" id="list-product">
            <?php 
            if(count($alldorayaki) > 0){
                foreach($alldorayaki as $variandorayaki){
                    $total_terjual = isset($total_penjualan[$variandorayaki["nama_varian"]]) ? $total_penjualan[$variandorayaki["nama_varian"]]["total_terjual"] : 0;
                    echo '<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                    <a href="detail-dorayaki.php?id=' . $variandorayaki["iddorayaki"] . '">
                        <div class="dorayaki-card glassmorphism-bg">
                            <div class="dorayaki-img"><img src="' . $variandorayaki["gambar"] . '"></div>
                            <div class="dorayaki-detail">
                                <p class="dorayaki-name">'. $variandorayaki["nama_varian"] . '</p>
                                <p class="dorayaki-stok">Stok: '. $variandorayaki["stok"] . ' dorayaki, Total Terjual: '.$total_terjual.'</p>
                                <p class="dorayaki-description">' . $variandorayaki["deskripsi"] . '</p>
                                <p class="dorayaki-price">' . $variandorayaki["harga"] .'</p>
                            </div>
                        </div>
                    </a>
                </div>';
                }
            }
            ?>
        </div>
    </div>
</body>
</html>