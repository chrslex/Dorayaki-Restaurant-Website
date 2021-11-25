<?php
require "access-only-admin.php";

require "database.php";
// Cek apakah for sudah terisi
if(isset($_FILES["fileimg"]) && isset($_POST["namadorayaki"]) && isset($_POST["deskripsidorayaki"]) && isset($_POST["hargadorayaki"]) && isset($_POST["stok"])){
    // Cek apakah harga dan stok berupa numeric dan apakah gambar terupload dengan sukses
    if(is_numeric($_POST["hargadorayaki"]) && is_numeric($_POST["stok"]) && $_FILES["fileimg"]["error"] == 0){
        $nama_varian = htmlspecialchars($_POST["namadorayaki"]);
        $deskripsi = htmlspecialchars($_POST["deskripsidorayaki"]);
        $harga = (int) $_POST["hargadorayaki"];
        $stok = (int) $_POST["stok"];
        // Cek apakah nama varian sudah ada atau belum
        if(!IsDorayakiExist($db, $nama_varian)){
            $target_dir = "img/";
            $gambar = $nama_varian . "." . strtolower(pathinfo($_FILES["fileimg"]["name"], PATHINFO_EXTENSION));
            $target_file = $target_dir . $gambar;
            // Upload + Insert ke database
            if (move_uploaded_file($_FILES["fileimg"]["tmp_name"], $target_file) && InsertDorayaki($db, $nama_varian, $target_file, $deskripsi, $harga, $stok)) {
                echo "<script type='text/javascript'>alert('Dorayaki Berhasil Ditambahkan');</script>";
            }
        } else{
            echo "<script type='text/javascript'>alert('Dorayaki Tidak Berhasil Ditambahkan');</script>";
        }
    } else{
        echo "<script type='text/javascript'>alert('Dorayaki Tidak Berhasil Ditambahkan');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Dorayaki</title>
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
                    <a href="add-dorayaki.php" class="active"><i class="fa fa-plus"></i> Add Dorayaki</a>
                <?php endif;?>
                <a href="login.php"><i class="fa fa-sign-out"></i> Log Out</a>
                <a href=""><i class="fa fa-user"></i><?php echo " ".$_SESSION["username"];?></a>
            </div>
        </div>
        <a href="javascript:void(0);" id="hamburger-menu" onclick="responsiveHeader()">
            <i class="fa fa-bars"></i>
        </a>
    </div>
    <p class="glassmorphism-bg" id="content-title">Tambah Varian Dorayaki</p>
    <div class="container" id="main-content">
        <div class="wrapper glassmorphism-bg" id="wrapper-input">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="wrapper-preview-img">
                    <img src="img/noimg.jpg" alt="Preview Gambar Dorayaki" id="preview-img-input">
                    <label for="fileimg">Tambahkan Gambar Dorayaki</label>
                    <input type="file" name="fileimg" id="fileimg" accept="image/*" onchange="showPreviewImage(event);" hidden>
                </div>
                <table>
                    <tr>
                        <td style="width: 30%;">
                            <label for="namadorayaki">Nama Dorayaki: </label>
                        </td>
                        <td>
                            <input type="text" placeholder="Masukkan Nama Dorayaki .." name="namadorayaki" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="deskripsidorayaki">Deskripsi: </label>
                        </td>
                        <td>
                            <input type="text" placeholder="Masukkan Deskripsi Dorayaki .." name="deskripsidorayaki" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="hargadorayaki">Harga: </label>
                        </td>
                        <td>
                            <input type="text" placeholder="Masukkan Harga Dorayaki .." name="hargadorayaki" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="stok">Stok Awal: </label>
                        </td>
                        <td>
                            <input type="text" placeholder="Masukkan Stok Awal Dorayaki .. " name="stok" required>
                        </td>
                    </tr>
                </table>
                <button type="submit" name="submitbtn">Add Dorayaki</button>
            </form>
        </div>
    </div>
    <script>
        function showPreviewImage(event){
            if(event.target.files.length > 0){
                var src = URL.createObjectURL(event.target.files[0]);
                console.log(event);
                console.log(src);
                var preview = document.getElementById("preview-img-input");
                preview.src = src;
            }
        }
    </script>
</body>
</html>