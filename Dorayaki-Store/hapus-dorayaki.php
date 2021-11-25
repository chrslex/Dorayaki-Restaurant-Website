<?php 
if(isset($_POST["id"])){
    require "database.php";
    $detaildorayaki = GetVarianDorayakiByID($db, $_POST["id"]);
    if(deleteVarianDorayaki($db, $_POST["id"])){
        unlink($detaildorayaki["gambar"]);
        echo json_encode(array("success" => 1));
    } else{
        echo json_encode(array("success" => 0));
    }
} else{
    echo json_encode(array("success" => 0));
}
?>