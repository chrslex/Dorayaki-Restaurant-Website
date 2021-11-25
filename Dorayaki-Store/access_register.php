<?php
    require "database.php";
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $a = CreateAccount($db, $username, $email, $hashed_password);

    if ($a) {
        echo "<script>alert('Akun berhasil dibuat');document.location= 'login.php'</script>";
    }
    else{
        echo "<script>alert('Akun gagal dibuat, username telah digunakan!');document.location= 'register.php'</script>";
    }
?>