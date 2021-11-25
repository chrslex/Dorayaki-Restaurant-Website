<?php
require "access-admin-user.php";
require "database.php";
if(isset($_GET["id"])){
    $detaildorayaki = GetVarianDorayakiByID($db, $_GET["id"]);
    $total_penjualan = getTotalPenjualanDorayaki($db);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Dorayaki</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="js/script.js"></script>
</head>
<body>
    <div class="glassmorphism-bg" id="header">
        <a href="dashboard.php" class="navbar-name">Doraemo<span style="color: red;">Nangis</span></a>
        <div class="resHeader">
            <div class="search-container left">
                <form action="search-result.php" method="get" autocomplete="off">
                    <input type="text" placeholder="Search.." name="search" class="glassmorphism-bg">
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
                <a href="login.php"><i class="fa fa-sign-out"></i> Log Out</a>
                <a href=""><i class="fa fa-user"></i><?php echo " ".$_SESSION["username"];?></a>
            </div>
        </div>
        <a href="javascript:void(0);" id="hamburger-menu" onclick="responsiveHeader()">
            <i class="fa fa-bars"></i>
        </a>
    </div>
    <p class="glassmorphism-bg" id="content-title">Detail Dorayaki</p>
    <div class="container" id="main-content">
        <div class="wrapper glassmorphism-bg" id="wrapper-detail">
            <?php if(isset($_GET["id"])) :?>
                <?php if($detaildorayaki) :?>
                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                        <img src="<?php echo $detaildorayaki["gambar"];?>" alt="">
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                        <div class="detail">
                            <h1 id="detail-name"><?php echo $detaildorayaki["nama_varian"];?></h1>
                            <h4>Stok: <?php echo $detaildorayaki["stok"];?> dorayaki, Total Terjual: <?php echo (isset($total_penjualan[$detaildorayaki["nama_varian"]]) ? $total_penjualan[$detaildorayaki["nama_varian"]]["total_terjual"] : 0);?></h4>
                            <p><?php echo $detaildorayaki["deskripsi"];?></p>
                            <p class="detail-harga">Rp. <?php echo $detaildorayaki["harga"];?></p>
                            <?php if(!$_SESSION["is_admin"]) :?>
                                <?php if($detaildorayaki["stok"] > 0) :?>
                                    <a href="beli-dorayaki.php?id=<?php echo $_GET["id"];?>">
                                        <button type="button" name="btnbeli"><i class="fa fa-shopping-cart"></i> Beli</button>
                                    </a>
                                <?php else :?>
                                    <div class="wrapper" id="wrapper-quantity">
                                        <p style="text-align: center; color: red; padding: 15px;">Maaf, dorayaki kehabisan stok :(</p>
                                    </div>
                                <?php endif ;?>
                            <?php else:?>
                                <a href="ubah-stok-dorayaki.php?id=<?php echo $_GET["id"];?>">
                                    <button type="button" name="btnbeli"><i class="fa fa-line-chart"></i> Ubah Stok</button>
                                </a>
                                <div class="col-xs-12">
                                    <div class="col-xs-6 jarakbtn">
                                        <a href="edit-dorayaki.php?id=<?php echo $_GET["id"];?>">
                                            <button type="button" name="btnedit"><i class="fa fa-edit"></i> Edit</button>
                                        </a>
                                    </div>
                                    <div class="col-xs-6 jarakbtn">
                                        <a onclick="confirmDelete(<?php echo $_GET['id'];?>);">
                                            <button type="button" name="btnhps"><i class="fa fa-trash"></i> Hapus</button>
                                        </a>
                                    </div>
                                </div>
                            <?php endif;?>
                        </div>
                    </div>
                <?php else:?>
                    <h1 style="text-align: center; color: red; padding: 15px;">Tidak terdapat Dorayaki dengan ID <?php echo $_GET["id"];?></h1>
                <?php endif;?>
            <?php else:?>
                <h1 style="text-align: center; color: red; padding: 15px;">Tidak dapat melihat detail dorayaki</h1>
            <?php endif;?>
        </div>
    </div>
</body>
</html>