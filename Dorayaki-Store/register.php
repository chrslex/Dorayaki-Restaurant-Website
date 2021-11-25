<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/register.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
    <div class="header">
        <h2>Register</h2>
    </div>
        <form id="form" class="form" method="POST" action = "access_register.php">
            <div class="form-control">
                <label for="username">Username</label>
                <input type="text" placeholder="" id="username" name = "username" />
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small>Error message</small>
            </div>
            <div class="form-control">
                <label for="email">Email</label>
                <input type="email" placeholder="" id="email" name="email"/>
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small>Error message</small>
            </div>
                <div class="form-control">
                <label for="password">Password</label>
                <input type="password" placeholder="" id="password" name="password"/>
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small>Error message</small>
            </div>
                <div class="form-control">
                <label for="password2">Password check</label>
                <input type="password" placeholder="re-enter" id="password2" name="password2"/>
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small>Error message</small>
            </div>
            <button name="submit">Register</button>
        </form>
    </div>
    <script type = "text/javascript" src="js/register.js"></script>
</body>
</html>