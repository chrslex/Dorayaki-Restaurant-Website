<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:700,600' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="css/login.css">
<script src="js/login.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js" type="text/javascript"></script>



    <div class="box">
        <form action="access.php" method="POST" enctype="multipart/form-data">
            <h1>Dashboard</h1>
            <input type="text" name="username"  placeholder="Username" class="username" required/>
            <input type="password" name="password" placeholder="Password" class="password" required/>

            <button type="submit" class="btn">Login</button> <!-- End Btn -->

            <a href="register.php"><div id="btn2">Sign Up</div></a> <!-- End Btn2 -->
        </form>

    </div> <!-- End Box -->


