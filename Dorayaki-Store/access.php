<?php
    require "database.php";
    $db = new MyDB();
    $id = 999;
    function checkCred($db,$username,$pass){
        $account = $db->query("SELECT `username`, `passwd`, `is_admin` FROM `account` WHERE `username`= '$username'");
        $row = $account->fetchArray();
        //var_dump($row);
        if($row){
            if(password_verify($pass, $row["passwd"])){
                return $row;
            }
            $_SESSION["error"] = "Password salah";
            return False;      
        }
        else{
            $_SESSION["error"] = "Username tidak ditemukan";
            return False;
        }
    }
    // buat debug di console
    // function debug_to_console($data) {
    //     $output = $data;
    //     if (is_array($output))
    //         $output = implode(',', $output);
    
    //     echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
    // }
    $username = $_POST["username"];
    $pass = $_POST["password"];
    $data = checkCred($db, $_POST["username"], $_POST["password"]);
    // debug_to_console($username);

    if($data){
        session_start();
        // $_SESSION['id'] = $id;
        $_SESSION['username'] = $username;
        $_SESSION['is_admin'] = $data["is_admin"];
        $_SESSION['login'] = true;
        echo "<script type='text/javascript'>alert('Log In berhasil');document.location= 'dashboard.php'</script>";
        exit();
    }else{
        echo "<script type='text/javascript'>alert('Invalid username or password !');document.location= 'login.php'</script>";
        // header("location: login.php");
        // exit();
    }
?>
