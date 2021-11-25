<?php
session_start();
session_destroy();
header("Location: login.php");
echo "<script type='text/javascript'>alert('Log Out berhasil');document.location= 'dashboard.php'</script>";
?>