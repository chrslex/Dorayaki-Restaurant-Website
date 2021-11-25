<?php
session_start();
require "database.php";
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
}
$current_page = 1;
$content_per_page = 10;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Search</title>
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
    <p class="glassmorphism-bg" id="content-title">Hasil Pencarian</p>
    <div class="container" id="main-content">
        <div class="row" id="list-product">
            <?php 
            $query = $_GET["search"];
            $result = GetVarianFromSearch($db,$query);
            if(count($result) > 0){
                $jumlah = 0;
                foreach($result as $variandorayaki){
                    $page = ceil(count($result)/$content_per_page);
                    if ($jumlah < $current_page*$content_per_page and $jumlah>=($current_page-1)*$content_per_page) {
                        $style = "visible";
                    }
                    else {
                        $style = "none";
                    }
                    echo '<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="display:'. $style.'">
                        <a href="detail-dorayaki.php?id=' . $variandorayaki["iddorayaki"] . '">
                            <div class="dorayaki-card glassmorphism-bg">
                                <div class="dorayaki-img"><img src="' . $variandorayaki["gambar"] . '"></div>
                                <div class="dorayaki-detail">
                                    <p class="dorayaki-name">'. $variandorayaki["nama_varian"] . '</p>
                                    <p class="dorayaki-stok">Stok: '. $variandorayaki["stok"] . ' dorayaki</p>
                                    <p class="dorayaki-description">' . $variandorayaki["deskripsi"] . '</p>
                                    <p class="dorayaki-price">' . $variandorayaki["harga"] .'</p>
                                </div>
                            </div>
                        </a>
                    </div>';
                    $jumlah += 1;
                }
            }
            else {
                $page = 0;
                echo "<h1 style='text-align: center; color: red; padding: 15px;'>Tidak terdapat hasil yang cocok</h1>";
            }
            ?>
        </div>
        <?php
        if($page != 0){
            ?>
            <nav class="center-nav">
                <div class="pagination">
                    <?php
                    for ($i=0; $i < $page; $i++) { 
                        if ($i==0) {
                            echo "<li class='current-page' style='background-color: #4531b8; color: white; border: 1px solid #4531b8'>1</li>";
                        } else{
                            $num = $i+1;
                            echo "<li class='page-link-$num' onclick='change($num)'>$num</li>";
                        }
                    }
                    ?>
                </div>
            </nav> <?php
            }
        ?>
    </div>
    <script>
        function change(page_dest){
            var list = document.getElementsByClassName("col-lg-3 col-md-4 col-sm-6 col-xs-12");
            var content_per_page = <?php echo $content_per_page?>;
            for (let i = 0; i < list.length; i++) {
                if (i < page_dest*content_per_page && i>=(page_dest-1)*content_per_page) {
                    list[i].style.display = "block";
                }
                else {
                    list[i].style.display = "none";
                }
            }
            var old_page = document.getElementsByClassName("current-page")[0];
            console.log(old_page);
            old_page.setAttribute("class","page-link-"+old_page.innerHTML);
            old_page.style.removeProperty("background-color");
            old_page.style.removeProperty("color");
            old_page.style.removeProperty("border");
            old_page.setAttribute("onclick","change("+old_page.innerHTML+")");
            console.log(old_page);
            var new_page = document.getElementsByClassName("page-link-"+page_dest)[0];
            console.log(new_page);
            new_page.setAttribute("class","current-page");
            new_page.style.backgroundColor = "#4531b8";
            new_page.style.color = "white";
            new_page.style.border = "1px solid #4531b8";
            new_page.removeAttribute("onclick");
            console.log(old_page);
        }
    </script>
</body>