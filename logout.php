<?php
session_start();
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

    <title>Log out</title>
</head>
<body>
<div class="container">
    <!-- DEBUT DU CONTAINER-->
    <div class="row">
        <div class="col">
            <!--ROW NAVBAR-->
            <nav class="navbar navbar-expand" id="barredenavigation">

                <a class="navbar-brand" href="#"><img src="images/Logo.png" width="40" height="40"
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
        session_unset();
        session_reset();
        session_destroy();
        header( "refresh:5;url=index.php" );
    ?>
    <p style="text-align:center;margin-top:200px">Thank you for you visit !</br>
    <a class=link style="text-decoration:underline;" href="signin.php">Click here to login.</a></p>

</body>
</html>