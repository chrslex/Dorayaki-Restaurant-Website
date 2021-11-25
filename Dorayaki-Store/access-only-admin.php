<?php
session_start();
if(!isset($_SESSION["login"])){
    // Bisa ditambah disini penanganan cookie
    header("Location: login.php");
    exit;
} else{
    if(!$_SESSION["is_admin"]){
        header("Location: forbidden.php");
        exit;
    }
}
?>