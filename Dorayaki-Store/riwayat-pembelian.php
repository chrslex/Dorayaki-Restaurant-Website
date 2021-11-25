<?php
require "access-only-user.php";
require "database.php";
$riwayat_pembelian = getAllRiwayatPembelianUser($db, $_SESSION["username"]);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pembelian</title>
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
                    <a href="riwayat-pembelian.php" class="active"><i class="fa fa-history"></i> Riwayat Pembelian</a>
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
    <p class="glassmorphism-bg" id="content-title">Riwayat Pembelian Dorayaki</p>
    <div class="container" id="main-content">
        <div class="wrapper glassmorphism-bg" id="wrapper-detail">
        <table class="table-riwayat">
            <tr>
                <th>Timestamp</th>
                <th>Nama Varian</th>
                <th>Jumlah Pembelian</th>
                <th>Total Harga</th>
            </tr>
            <?php 
                foreach($riwayat_pembelian as $history){
                    echo '<tr>
                        <td>'.$history["waktu_pembelian"].'</td>
                        <td><a href="detail-dorayaki.php?id='.$history["iddorayaki"].'">'.$history["nama_varian"].'</a></td>
                        <td>'.$history["jumlah_pembelian"].'</td>
                        <td>'.$history["harga"].'</td>
                    </tr>';
                }
            ?>
        </table>
        </div>
    </div>
</body>
</html>