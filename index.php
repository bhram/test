<?php
    session_start();
    if(isset($_SESSION['loging'])){
        $login = true;
    }
    if (isset($_POST['login'])){
        $user = $_POST['username'];
        $pass = $_POST['password'];
        if($user === 'admin' && $pass === 'dhia'){
            $login = true;
            $_SESSION['login']= true;
        }else {
            $error = true;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <meta name="theme-color" content="#000000">
    <link rel="manifest" href="/manifest.json">
    <link rel="shortcut icon" href="/favicon.ico">
    <link rel="stylesheet" href="/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <title>Good of Doctor Game</title>
    <link href="/static/css/main.c935c0a9.css" rel="stylesheet">
</head>

<body>

    <?php if(isset($login)){?>
        <noscript>You need to enable JavaScript to run this app.</noscript>
        <div id="root"></div>
        <script type="text/javascript" src="/static/js/main.7be350a0.js"></script>
    <?php }else{ ?>
        <div class="container">
            <div class="wrapp-login" style=" width: 50%; margin: 70px auto; background: white; padding: 28px; border-radius: 10px;">
                <form method="post">
                    <div class="form-group">
                        <label for="u">Username</label>
                        <input name="username" type="text" class="form-control" id="u">
                    </div>
                    <div class="form-group">
                        <label for="pass">Password</label>
                        <input name="password" type="password" class="form-control" id="pass">
                    </div>
                    <button name="login" type="submit" class="btn btn-primary btn-block">Login</button>
                </form>
            </div>
        </div>
    <?php } ?>

    <?php 
        if(isset($error)){
            echo '
            <script>
                alert("error with login try again")
            </script>';
        }
    ?>
</body>

</html>