<?php
require "access-only-admin.php";

require "database.php";
if(isset($_GET["id"])){
    $detaildorayaki = GetVarianDorayakiByID($db, $_GET["id"]);
    if($detaildorayaki){
        // Cek apakah for sudah terisi
        if(isset($_FILES["fileimg"]) && isset($_POST["namadorayaki"]) && isset($_POST["deskripsidorayaki"]) && isset($_POST["hargadorayaki"]) && isset($_POST["stok"])){
            // Cek apakah harga dan stok berupa numeric dan apakah gambar terupload dengan sukses
            if(is_numeric($_POST["hargadorayaki"]) && is_numeric($_POST["stok"])){
                date_default_timezone_set("Asia/Jakarta");
                $waktu_pengubahan = date('Y-m-d H:i:s');
                $username = $_SESSION["username"];
                $iddorayaki = $_GET["id"];
                $nama_varian = htmlspecialchars($_POST["namadorayaki"]);
                $deskripsi = htmlspecialchars($_POST["deskripsidorayaki"]);
                $harga = (int) htmlspecialchars($_POST["hargadorayaki"]);
                $stok = (int) htmlspecialchars($_POST["stok"]);
                $jumlah_pengubahan = $stok - $detaildorayaki["stok"];
                // Cek apakah nama varian sudah ada atau belum
                if($harga >= 0 && $stok >= 0 && (!IsDorayakiExist($db, $nama_varian) || (IsDorayakiExist($db, $nama_varian) && GetVarianDorayaki($db, $nama_varian)["iddorayaki"] == $_GET["id"]))){
                    // Jika ada gambar yang di upload maka upload terlebih dahulu
                    if($_FILES["fileimg"]["error"] == 0){
                        $target_dir = "img/";
                        $gambar = $nama_varian . "." . strtolower(pathinfo($_FILES["fileimg"]["name"], PATHINFO_EXTENSION));
                        $target_file = $target_dir . $gambar;
                        unlink($detaildorayaki["gambar"]); // Hapus gambar dorayaki agar bisa diganti dengan gambar hasil upload
                        if(file_exists($target_file)) unlink($target_file); // Jika ada file dengan nama sama maka akan di rewrite
                        move_uploaded_file($_FILES["fileimg"]["tmp_name"], $target_file);
                    } else{
                        $target_dir = "img/";
                        $gambar = $nama_varian . "." . strtolower(pathinfo($detaildorayaki["gambar"], PATHINFO_EXTENSION));
                        $target_file = $target_dir . $gambar;
                        rename($detaildorayaki["gambar"], $target_file);
                    }
                    // Update ke database
                    if (UpdateDorayaki($db, $_GET["id"], $nama_varian, $target_file, $deskripsi, $harga, $stok) && InsertRiwayatPengubahanStokAdmin($db, $waktu_pengubahan, $username, $iddorayaki, $nama_varian, $jumlah_pengubahan)) {
                        header("Location: detail-dorayaki.php?id=".$_GET["id"]);
                        echo "<script type='text/javascript'>alert('Dorayaki Berhasil Diedit');</script>";
                        exit;
                    }
                } else{
                    echo "<script type='text/javascript'>alert('Dorayaki Tidak Berhasil Diedit');</script>";
                }
            } else{
                echo "<script type='text/javascript'>alert('Dorayaki Tidak Berhasil Diedit');</script>";
            }
        }
    } else{
        $error = True;
    }
} else{
    $error = True;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Dorayaki</title>
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
    <p class="glassmorphism-bg" id="content-title">Edit Varian Dorayaki</p>
    <div class="container" id="main-content">
        <div class="wrapper glassmorphism-bg" id="wrapper-input">
            <?php if(isset($error)) :?>
                <h1 style="text-align: center; color: red; padding: 15px;">Tidak dapat mengedit dorayaki</h1>
            <?php else:?>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="wrapper-preview-img">
                        <img src="<?php echo $detaildorayaki["gambar"];?>" alt="Preview Gambar Dorayaki" id="preview-img-input">
                        <label for="fileimg">Tambahkan Gambar Dorayaki</label>
                        <input type="file" name="fileimg" id="fileimg" accept="image/*" onchange="showPreviewImage(event);" hidden>
                    </div>
                    <table>
                        <tr>
                            <td style="width: 30%;">
                                <label for="namadorayaki">Nama Dorayaki: </label>
                            </td>
                            <td>
                                <input type="text" placeholder="Masukkan Nama Dorayaki .." name="namadorayaki" value="<?php echo $detaildorayaki["nama_varian"];?>" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="deskripsidorayaki">Deskripsi: </label>
                            </td>
                            <td>
                                <input type="text" placeholder="Masukkan Deskripsi Dorayaki .." name="deskripsidorayaki" value="<?php echo $detaildorayaki["deskripsi"];?>" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="hargadorayaki">Harga: </label>
                            </td>
                            <td>
                                <input type="text" placeholder="Masukkan Harga Dorayaki .." name="hargadorayaki" value="<?php echo $detaildorayaki["harga"];?>" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="stok">Stok: </label>
                            </td>
                            <td>
                                <input type="text" placeholder="Masukkan Stok Awal Dorayaki .. " name="stok" value="<?php echo $detaildorayaki["stok"];?>" required>
                            </td>
                        </tr>
                    </table>
                    <button type="submit" name="submitbtn">Edit Dorayaki</button>
                </form>
            <?php endif;?>
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