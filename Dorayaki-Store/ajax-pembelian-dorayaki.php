<?php
require "database.php";
if(isset($_GET["id"]) && isset($_GET["value"])){
    $detaildorayaki = GetVarianDorayakiByID($db, $_GET["id"]);
    if($_GET["value"] < 1){
        $value = 1;
    } else if($_GET["value"] > $detaildorayaki["stok"]){
        $value = $detaildorayaki["stok"];
    } else{
        $value = $_GET["value"];
    }
    $harga = $detaildorayaki["harga"] * $value;
    $return_arr = array(
        "getValue" => $_GET["value"],
        "getId" => $_GET["id"],
        "value" => $value,
        "harga" => $harga,
        "stok" => $detaildorayaki["stok"]
    );
    echo json_encode($return_arr);
}
?>