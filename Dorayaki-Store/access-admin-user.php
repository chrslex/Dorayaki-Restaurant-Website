<?php
session_start();
if(!isset($_SESSION["login"])){
    // Bisa ditambah disini penanganan cookie
    header("Location: login.php");
    exit;
}
?>