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
    <title>Admin</title>
</head>
<body>
    <!--<p>faire attention++ à la sécurity : doublecheck des droits d'admin / connection ok </br>
    gestion des erreurs (throw nex Exception) </br>
    gestion des CRUD users et CRUD products</p>-->

    <div class="container">
        <!-- DEBUT DU CONTAINER-->
        <div class="row">
            <div class="col">
                <!--ROW NAVBAR-->
                <nav class="navbar navbar-expand" id="barredenavigation">

                    <a class="navbar-brand" href="index.php"><img src="../images/Logo.png" width="40" height="40"
                            alt="logo-navbar"></a>

                    <div class="col-12" id="navbar-leftside">
                        <ul class="navbar-nav">
                            <li class="nav-item active">
                                <a class="nav-link" href="index.php">HOME</a>
                            </li>
                            <li>
                                <a class="nav-link" href="admin.php">ADMIN</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-3"></div>
            <div class="col-12 col-md-3">
                <p><a href="adminuser/adminuser.php" class="admin-button">ADMIN USERS</a></p>
            </div>
            <div class="col-12 col-md-3">
                <a href="adminproducts/adminpro.php" class="admin-button">ADMIN PRODUCTS</a></p>
            </div>
            <div class="col-12 col-md-3"></div>
            </div>
        </div>
    </div>


    </body>
</html>