<?php
session_start();
include_once('connect_db.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="admin.css">

    <title>Sign Up</title>
</head>
<body>
<div class="container">
    <!-- DEBUT DU CONTAINER-->
    <div class="row">
        <div class="col">
            <!--ROW NAVBAR-->
            <nav class="navbar navbar-expand" id="barredenavigation">

                <a class="navbar-brand" href="index.php"><img src="images/Logo.png" width="40" height="40"
                        alt="logo-navbar"></a>

                <div class="col-12" id="navbar-leftside">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php">HOME</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</div>

    <?php

        //$pdo = new PDO("mysql:host=localhost;dbname=my_shop;charset=utf8", 'root', 'password');

        function validate_username($str) 
        {
            return preg_match('/^[A-Za-z][A-Za-z0-9]*(?:_[A-Za-z0-9]+)*$/',$str);
        }
        
        if (!empty($_POST)) {

            $username = $_POST["username"];

            if (!isset($_POST["username"]) OR strlen($_POST["username"]) < 3 OR strlen($_POST["username"]) > 10 OR !validate_username($_POST["username"])) {
                echo "Invalid username";
            }
            elseif (!isset($_POST["email"]) OR !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                echo "Invalid email";
            }
            elseif (
                !isset($_POST["password"])
                OR !isset($_POST["password_confirmation"]) 
                OR $_POST["password"] != $_POST["password_confirmation"]
                OR strlen($_POST["password"]) < 3
                OR strlen($_POST["password"]) > 10
            ) {
                echo "Invalid password or password confirmation";
            }
            else {
                
                //condition trop complexe pour être dans un if d'où le découpage délicat entre if/elseif/else et encore des if...
                
                $mailverif = $pdo->prepare('SELECT * FROM users WHERE email="'.$_POST["email"].'" LIMIT 1;');
                $mailverif->execute();
                $resemail = $mailverif->fetchColumn();
            
                if ($resemail > 0 ){
                    echo "This email is already in use.\n";
                }
                else {
                    $usernameverif = $pdo->prepare('SELECT * FROM users WHERE username="'.$_POST["username"].'" LIMIT 1;');
                    $usernameverif->execute();
                    $resusername = $usernameverif->fetchColumn();
                
                    if ($resusername > 0 ){
                        echo "This username is already in use.\n";
                    }
                    else {
                        
                        $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
                        $newuser = $pdo->prepare('INSERT INTO users (username ,email ,password, admin) 
                        VALUES ("'.$_POST["username"].'", "'.$_POST["email"].'", "'.$password.'", NULL);');
                        $newuser->execute();
                        //echo "User created";
                        $_SESSION['name'] = $_POST["username"];
                        header("Location: index.php");
                        }
                    }
                }
            }
    
        ?>

    <form class="form" action="" method="post">
        <h1 class="login-title">Registration</h1>
        <p class="link">Already have an account ?<br/><a href="signin.php">Login here !</a></p>
        <input type="text" class="login-input" name="username" placeholder="Username" required />
        <input type="text" class="login-input" name="email" placeholder="Email Adress">
        <input type="password" class="login-input" name="password" placeholder="Password">
        <input type="password" class="login-input" name="password_confirmation" placeholder="Password confirmation">
        <input type="submit" name="submit" value="Sign up" class="login-button">
        
    </form>

    
</body>
</html>
