<?php
    class MyDB extends SQLite3 {
        function __construct() {
            $this->open('data/doraemonangis.db');
        }
    }
    $db = new MyDB();

    //  CREATE TABLE 
    $result = $db->exec("CREATE TABLE IF NOT EXISTS varian_dorayaki (iddorayaki INTEGER PRIMARY KEY AUTOINCREMENT, nama_varian TEXT, gambar TEXT, deskripsi TEXT, harga INTEGER, stok INTEGER);");
    $result = $db->exec("CREATE TABLE IF NOT EXISTS account (username TEXT PRIMARY KEY, email TEXT NOT NULL UNIQUE, passwd TEXT NOT NULL, is_admin BOOLEAN NOT NULL CHECK (is_admin IN (0,1)))");
    $result = $db->exec("CREATE TABLE IF NOT EXISTS riwayat_pembelian (waktu_pembelian TIMESTAMP, username TEXT, iddorayaki INTEGER, nama_varian TEXT, jumlah_pembelian INTEGER, harga INTEGER);");
    $result = $db->exec("CREATE TABLE IF NOT EXISTS riwayat_pengubahan_stok_admin (waktu_pengubahan TIMESTAMP, username TEXT, iddorayaki INTEGER, nama_varian TEXT, jumlah_pengubahan INTEGER);");

    // FUNGSI-FUNGSI

    function CreateAccount($db, $username, $email, $passwd){
        if(!IsUsernameExist($db, $username)){
            $result = $db->exec("INSERT INTO account (username, email, passwd, is_admin) VALUES ('$username', '$email', '$passwd', 0)");
            return true;
        }else{
            return false;
        }
    }

    function IsUsernameExist($db, $username){
        $isExist = $db->query("SELECT * FROM account WHERE username LIKE '$username';")->fetchArray();
        return ($isExist ? true : false);
    }

    function InsertDorayaki($db, $nama_varian, $gambar, $deskripsi, $harga, $stok){
        if(!IsDorayakiExist($db, $nama_varian)){
            $result = $db->exec("INSERT INTO varian_dorayaki (nama_varian, gambar, deskripsi, harga, stok) VALUES ('$nama_varian', '$gambar', '$deskripsi', $harga, $stok);");
            return $result;
        } else{
            return false;
        }
    }

    function UpdateDorayaki($db, $id, $nama_varian, $gambar, $deskripsi, $harga, $stok){
        // Asumsi: ID sudah dipastikan ada sehingga tidak perlu dilakukan pengecekan
        $result = $db->exec("UPDATE varian_dorayaki SET nama_varian='$nama_varian', gambar='$gambar', deskripsi='$deskripsi', harga=$harga, stok=$stok WHERE iddorayaki=$id;");
        return $result;
    }

    function InsertRiwayatPembelian($db, $waktu_pembelian, $username, $iddorayaki, $nama_varian, $jumlah_pembelian, $harga){
        $result = $db->exec("INSERT INTO riwayat_pembelian (waktu_pembelian, username, iddorayaki, nama_varian, jumlah_pembelian, harga) VALUES ('$waktu_pembelian', '$username', $iddorayaki, '$nama_varian', $jumlah_pembelian, $harga);");
        return $result;
    }

    function UpdateStokPembelian($db, $id, $jumlah_pembelian){
        // Asumsi: ID sudah dipastikan ada sehingga tidak perlu dilakukan pengecekan
        $result = $db->exec("UPDATE varian_dorayaki SET stok=stok - $jumlah_pembelian WHERE iddorayaki=$id;");
        return $result;
    }

    function InsertRiwayatPengubahanStokAdmin($db, $waktu_pengubahan, $username, $iddorayaki, $nama_varian, $jumlah_pengubahan){
        $result = $db->exec("INSERT INTO riwayat_pengubahan_stok_admin (waktu_pengubahan, username, iddorayaki, nama_varian, jumlah_pengubahan) VALUES ('$waktu_pengubahan', '$username', $iddorayaki, '$nama_varian', $jumlah_pengubahan);");
        return $result;
    }

    function UpdateStokAdmin($db, $id, $jumlah_pengubahan){
        // Asumsi: ID sudah dipastikan ada sehingga tidak perlu dilakukan pengecekan
        $result = $db->exec("UPDATE varian_dorayaki SET stok=stok + $jumlah_pengubahan WHERE iddorayaki=$id;");
        return $result;
    }

    function getAllRiwayatPembelianUser($db, $username){
        $result = $db->query("SELECT * FROM riwayat_pembelian WHERE username LIKE '$username' ORDER BY waktu_pembelian;");
        return GetAllItem($result);
    }

    function getAllRiwayatPembelian($db){
        $result = $db->query("SELECT * FROM riwayat_pembelian ORDER BY waktu_pembelian;");
        return GetAllItem($result);
    }

    function getAllRiwayatPengubahanAdmin($db){
        $result = $db->query("SELECT * FROM riwayat_pengubahan_stok_admin ORDER BY waktu_pengubahan;");
        return GetAllItem($result);
    }

    function getTotalPenjualanDorayaki($db){
        $result = $db->query("SELECT nama_varian, SUM(jumlah_pembelian) AS total_terjual FROM riwayat_pembelian GROUP BY nama_varian ORDER BY total_terjual DESC;");
        $allItem = [];
        while($row = $result->fetchArray()){
            $allItem[$row["nama_varian"]] = $row;
        }
        return $allItem;
    }

    function sortDashboard($db, $limit){
        $result = $db->query("SELECT * FROM varian_dorayaki ORDER BY nama_varian;");
        $allItem = [];
        while($row = $result->fetchArray()){
            $allItem[$row["nama_varian"]] = $row;
        }
        $total_penjualan = getTotalPenjualanDorayaki($db);
        $arreturn = array();
        $i = 0;
        foreach($total_penjualan as $penjualan){
            if($i != $limit){
                $arreturn[] = $allItem[$penjualan["nama_varian"]];
                $i++;
            } else{
                break;
            }
        }
        foreach($allItem as $item){
            if($i != $limit){
                if(!isset($total_penjualan[$item["nama_varian"]])){
                    $arreturn[] = $item;
                    $i++;
                }
            } else{
                break;
            }
        }
        return $arreturn;
    }

    function deleteVarianDorayaki($db, $id){
        $result = $db->exec("DELETE FROM varian_dorayaki WHERE iddorayaki = $id;");
        return $result;
    }

    function GetAllItem($result){
        $allItem = [];
        while($row = $result->fetchArray()){
            $allItem[] = $row;
        }
        return $allItem;
    }

    function GetAllVarianDorayaki($db){
        $result = $db->query("SELECT * FROM varian_dorayaki;");
        return GetAllItem($result);
    }

    function GetVarianFromSearch($db, $query){
        $result = $db->query("SELECT * FROM varian_dorayaki where nama_varian LIKE '%".$query."%';");
        return GetAllItem($result);
    }
    
    function IsDorayakiExist($db, $nama_varian){
        $isExist = $db->query("SELECT * FROM varian_dorayaki WHERE nama_varian LIKE '$nama_varian';")->fetchArray();
        return ($isExist ? true : false);
    }

    function GetVarianDorayaki($db, $nama_varian){
        return $db->query("SELECT * FROM varian_dorayaki WHERE nama_varian LIKE '$nama_varian';")->fetchArray();
    }

    function GetVarianDorayakiByID($db, $id){
        return $db->query("SELECT * FROM varian_dorayaki WHERE iddorayaki = $id;")->fetchArray();
    }
?>