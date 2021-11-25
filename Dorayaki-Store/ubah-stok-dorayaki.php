<?php
require "access-only-admin.php";
require "database.php";
if(isset($_GET["id"])){
    $detaildorayaki = GetVarianDorayakiByID($db, $_GET["id"]);
    if(isset($_POST["input-quantity"])){
        date_default_timezone_set("Asia/Jakarta");
        $waktu_pengubahan = date('Y-m-d H:i:s');
        $username = $_SESSION["username"];
        $iddorayaki = $detaildorayaki["iddorayaki"];
        $nama_varian = $detaildorayaki["nama_varian"];
        $jumlah_pengubahan = $_POST["input-quantity"];
        // Kalau jumlah pengubahannya 0 gaakan dimasukkan ke database
        if($jumlah_pengubahan != 0){
            if(InsertRiwayatPengubahanStokAdmin($db, $waktu_pengubahan, $username, $iddorayaki, $nama_varian, $jumlah_pengubahan) && UpdateStokAdmin($db, $iddorayaki, $jumlah_pengubahan)){
                echo "<script type='text/javascript'>alert('Pengubahan Stok Berhasil Dilakukan \(^v^)/');</script>";
                header("Location: detail-dorayaki.php?id=".$_GET["id"]);
                exit;
            } else{
                echo "<script type='text/javascript'>alert('Pengubahan Stok Tidak Berhasil Dilakukan (T_T)');</script>";
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Stok Dorayaki</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" src="js/script.js"></script>
</head>
<body>
    <div class="glassmorphism-bg" id="header">
        <a href="dashboard.php" class="navbar-name">Doraemo<span style="color: red;">Nangis</span></a>
        <div class="resHeader">
            <div class="search-container left">
                <form action="" method="get" autocomplete="off">
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
                <a href="logout.php"><i class="fa fa-sign-out"></i> Log Out</a>
                <a href=""><i class="fa fa-user"></i><?php echo " ".$_SESSION["username"];?></a>
            </div>
        </div>
        <a href="javascript:void(0);" id="hamburger-menu" onclick="responsiveHeader()">
            <i class="fa fa-bars"></i>
        </a>
    </div>
    <p class="glassmorphism-bg" id="content-title">Ubah Stok Dorayaki</p>
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
                            <h4>Stok: <span id="jumlah-stok"><?php echo $detaildorayaki["stok"];?></span> dorayaki</h4>
                            <p><?php echo $detaildorayaki["deskripsi"];?></p>
                            <p class="detail-harga">Rp. <span id="total-harga"><?php echo $detaildorayaki["harga"];?></span></p>
                            <form action="" method="post">
                                <div class="wrapper" id="wrapper-quantity">
                                    <div class="quantity">
                                        <div class="btn-increment-decrement" onClick="decrement_quantity_stock(<?php echo $_GET["id"]?>);">-</div>
                                        <input class="input-quantity" id="input-quantity" name="input-quantity" value="0" readonly="true">
                                        <div class="btn-increment-decrement" onClick="increment_quantity_stock(<?php echo $_GET["id"]?>);">+</div>
                                    </div>
                                </div>
                                <button type="submit" name="btnbeli"><i class="fa fa-line-chart"></i> Ubah Stok</button>
                            </form>
                        </div>
                    </div>
                <?php else:?>
                    <h1 style="text-align: center; color: red; padding: 15px;">Dorayaki yang ingin dibeli tidak ada (T_T), mungkin sudah dihapus atau link tidak valid</h1>
                <?php endif;?>
            <?php else:?>
                <h1 style="text-align: center; color: red; padding: 15px;">Dorayaki yang ingin dibeli tidak ada (T_T), mungkin sudah dihapus atau link tidak valid</h1>
            <?php endif;?>
        </div>
    </div>
</body>
</html>