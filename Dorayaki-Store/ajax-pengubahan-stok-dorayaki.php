<?php
require "database.php";
if(isset($_GET["id"]) && isset($_GET["value"])){
    $detaildorayaki = GetVarianDorayakiByID($db, $_GET["id"]);
    if($_GET["value"] + $detaildorayaki["stok"] < 0){
        $value = $detaildorayaki["stok"] * -1;
    } else{
        $value = $_GET["value"];
    }
    $return_arr = array(
        "value" => $value,
        "stok" => $detaildorayaki["stok"]
    );
    echo json_encode($return_arr);
}
?>