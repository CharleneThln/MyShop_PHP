<?php
session_start();
include_once('connect_db.php');

$queryString = "";
if (isset($_GET['tri'])) {
    $queryString .= "tri=".$_GET['tri'];
}
elseif (isset($_GET['id'])) {
    $queryString .= "id=".$_GET['id'];
}
if (!empty($queryString)) {
    $queryString = "&".$queryString;
}



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

    <title>MyShop</title>
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

                    <div class="col-md-9" id="navbar-leftside">
                        <ul class="navbar-nav">
                            <li class="nav-item active">
                                <a class="nav-link" href="index.php">HOME</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">SHOP</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">MAGAZINE</a>
                            </li>
                        </ul>
                    </div>
                    <!--<div class="col-4" id="navbar-invisible-vue-desktop"></div>-->
                    <div class="col-8 col-md-3" id="navbar-rightside">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <?php 
                                    if (isset($_SESSION['name'])) {
                                        
                                        $usersinfos = $pdo->prepare('SELECT admin from users WHERE username ="'.$_SESSION['name'].'";');
                                        $usersinfos->execute();
                                        $req = $usersinfos->fetchColumn();
            
                                        if ($req['admin'] != NULL) {
                                ?>
                                            <a class="nav-link" id="admin" href="admin.php">ADMIN</a>
                                <?php
                                        }
                                        else {
                                ?>
                                            <a class="nav-link" href="#">Hello <?php echo $_SESSION['name'];?>!</a>
                                <?php
                                        }   
                                    }
                                ?>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"><img src="images/Cart Button.png" width="18" height="18"
                                        alt="caddie"></a>
                            </li>
                            <li class="nav-item" id="hamburger">
                                <a class="nav-link" href="#"><img src="images/hamburger.png" width="25" height="25"
                                        alt="menu"></a>
                            </li>
                            <li class="nav-item" id="login">
                                <?php 
                                    if (isset($_SESSION["name"])) {
                                ?>
                                    <a class="nav-link" href="logout.php">LOGOUT</a>
                                <?php
                                    }
                                    else {
                                ?>
                                    <a class="nav-link" href="signup.php">LOGIN</a>
                                <?php
                                    }
                                ?>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!--FIN DU ROW NAVBAR-->

        <div class="row" id="head">
            <!--ROW SEARCHBAR+BESTMATCH-->
            <div class="col-12 col-md-9" id="searchbar-head">
                <!--COL SEARCHBAR-->
                <form action="index.php" method ="get" >
                <!--<input class="loop" type="submit" <i>src="images/Search.png" width="30" height="30" alt="loop"</i> />-->
                <input class="loop" type="image" src="images/Search.png" width="30" height="30" alt="Submit Form" />
                <input name="search" type="text" class="searchbar" placeholder="living room">
                </form>
            </div>
            <div class="col-12 col-md-3" id="bestmatch-head">
                <!--COL BESTMATCH-->
                <div class="dropdown2">
                    <button onclick="myFunction(this)" class="dropbtn-bestmatch">Best Match<i
                            class="arrow down"></i></button>
                    <div id="myDropdown2" class="dropdown-content">
                        <a href="index.php?tri=ASC">Prix croissant</a>
                        <a href="index.php?tri=DESC">Prix décroissant</a>
                        <a href="index.php?id=DESC">Nouveauté</a>
                    </div>
                </div>
            </div>
        </div>
        <!--FIN DU ROW SEARCHBAR+BESTMATCH-->


        <div class="row" id="rowvitrine">
            <!--ROW VITRINE-->
            
            <div class="col-12 col-md-3">
                <!-- colonne des filtres de recherche-->

                <div class="filtermobile">
                    <!-- filtres vue MOBILE-->
                    <button onclick="myFunction(this)" class="dropbtn">Filters<i class="arrow down"></i></button>
                    <div id="myDropdown" class="dropdown-content">
                        <a href="#collection">Collection</a>
                        <a href="#color">Color</a>
                        <a href="#catégories">Catégories</a>
                    </div>
                </div>
                <div class="filterwidescreen">
                    <!-- filtres vue DESKTOP-->
                    <p class="filterby">FILTER BY</p>
                    <div class="dropdown1">
                        <button onclick="myFunction(this)" class="dropbtn">Collection<i class="arrow down"></i></button>
                        <div id="myDropdown" class="dropdown-content">
                            <a href="#collection">Collection Eté</a>
                            <a href="#collection">Collection Hiver</a>
                            <a href="#collection">Collection Printemps</a>
                        </div>
                    </div>
                    <div class="dropdown1">
                        <button onclick="myFunction(this)" class="dropbtn">Color<i class="arrow down"></i></button>
                        <div id="myDropdown1" class="dropdown-content">
                            <a href="#color">Bleu</a>
                            <a href="#color">Noir</a>
                            <a href="#color">Blanc</a>
                        </div>
                    </div>
                    <div class="dropdown1">
                        <button onclick="myFunction(this)" class="dropbtn">Category<i class="arrow down"></i></button>
                        <div id="myDropdown2" class="dropdown-content">
                            <a href="#mobilier">Canapé</a>
                            <a href="#mobilier">Table</a>
                            <a href="#mobilier">Meuble TV</a>
                        </div>
                    </div>
                    <script>
                        /* When the user clicks on the button,
                        toggle between hiding and showing the dropdown content */
                        function myFunction(self) {
                            self.nextElementSibling.classList.toggle("show");
                        }

                        function filterFunction() {
                            var input, filter, ul, li, a, i;
                            input = document.getElementById("myInput");
                            filter = input.value.toUpperCase();
                            div = document.getElementById("myDropdown");
                            a = div.getElementsByTagName("a");
                            for (i = 0; i < a.length; i++) {
                                txtValue = a[i].textContent || a[i].innerText;
                                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                    a[i].style.display = "";
                                } else {
                                    a[i].style.display = "none";
                                }
                            }
                        }
                    </script>
                    <section class="mb-4">
                        <!-- section barre de prix -->
                        <p class="font-weight-bold mb-3" id="pricerange">Price range</p>
                        <div class="slider-price d-flex align-items-center my-4">
                            <span class="font-weight-normal small text-muted mr-2">$0</span>
                            <form class="multi-range-field w-100 mb-1">
                                <input id="multi" class="multi-range" type="range" />
                            </form>
                            <span class="font-weight-normal small text-muted ml-2">$10,000+</span>
                        </div>
                    </section>
                </div>

            </div><!-- fin de la case des filtres de recherche-->

            <?php
            // Number of records to show on each page
            $records_per_page = 3;
            $req = $pdo->query('SELECT COUNT(id) FROM products;');
            $nbrproducts = $req->fetchColumn();
            
            $nbrpages = ceil($nbrproducts / $records_per_page); //ceil() à place de round( avec PHP_HALF_UP)
            /*echo $nbrproducts . " produits sont dans la base";
            echo "il y a ". $nbrpages . " pages avec ".$records_per_page." produits par pages\n";*/
            
            $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
            ?> <!-- fin requête pour gérer la pagination -->

            <?php
            if (isset($_GET['search'])) //"button trier prix croissant à été cliqué " 
            {
                $req = $pdo->query('SELECT name, price, image FROM products WHERE name LIKE "%'.$_GET['search'].'%" LIMIT '.($page - 1) * $records_per_page.','.$records_per_page.';');
                $req = $req->fetchAll();
                foreach ($req as $element) 
                {
                ?>
                <div class="col-12 col-md-3" id="casemeubleetinfos">
                    <!-- début de la case "meuble et infos"-->
                    <div class="row">
                        <img class="img-fluid" id="imagemeuble" src="<?php echo $element['image'] ?>"
                            alt="canape-myshop">
                    </div>
                    <div class="row" id="infosdumeuble">
                        <div class="col-6 col-md-9" id="nomdumeuble-categorie">
                            <p class="nomdumeuble"><a href=#><?php echo $element['name'] ?></a></p>
                            <p class="categorie"><?php echo "CATEGORIE" ?></p>
                            <p><img class="star" src="images/Star - On.png" alt="icone-star">
                                <img class="star" src="images/Star - On.png" alt="icone-star">
                                <img class="star" src="images/Star - On.png" alt="icone-star">
                                <img class="star" src="images/Star.png" alt="icone-star">
                            </p>
                        </div>
                        <div class="col-6 col-md-3" id="prix-caddie">
                            <?php echo $element['price'].'$'?>
                            <a href="#"><img class="caddie" src="images/Cart Button.png" width="18" height="18"
                                    alt="icone-caddie"></a>
                        </div>
                    </div>
                </div><!-- fin de la case "meuble et infos"-->
                <?php
                }
            }
            elseif (isset($_GET['tri'])) //"order by price desc or asc" 
            {
                $req = $pdo->query('SELECT name, price, image FROM products ORDER BY price '.$_GET['tri'].' LIMIT '.($page - 1) * $records_per_page.','.$records_per_page.';');
                $req = $req->fetchAll();
                foreach ($req as $element) 
                {
                ?>
                <div class="col-12 col-md-3" id="casemeubleetinfos">
                    <!-- début de la case "meuble et infos"-->
                    <div class="row">
                        <img class="img-fluid" id="imagemeuble" src="<?php echo $element['image'] ?>"
                            alt="canape-myshop">
                    </div>
                    <div class="row" id="infosdumeuble">
                        <div class="col-6 col-md-9" id="nomdumeuble-categorie">
                            <p class="nomdumeuble"><a href=#><?php echo $element['name'] ?></a></p>
                            <p class="categorie"><?php echo "CATEGORIE" ?></p>
                            <p><img class="star" src="images/Star - On.png" alt="icone-star">
                                <img class="star" src="images/Star - On.png" alt="icone-star">
                                <img class="star" src="images/Star - On.png" alt="icone-star">
                                <img class="star" src="images/Star.png" alt="icone-star">
                            </p>
                        </div>
                        <div class="col-6 col-md-3" id="prix-caddie">
                            <?php echo $element['price'].'$'?>
                            <a href="#"><img class="caddie" src="images/Cart Button.png" width="18" height="18"
                                    alt="icone-caddie"></a>
                        </div>
                    </div>
                </div><!-- fin de la case "meuble et infos"-->
                <?php
                }
            }
            elseif (isset($_GET['id'])) //"order by id desc (nouveaux produits en premier)" 
            {
                $req = $pdo->query('SELECT name, price, image FROM products ORDER BY id DESC LIMIT '.($page - 1) * $records_per_page.','.$records_per_page.';');
                $req = $req->fetchAll();
                foreach ($req as $element) 
                {
                ?>
                <div class="col-12 col-md-3" id="casemeubleetinfos">
                    <!-- début de la case "meuble et infos"-->
                    <div class="row">
                        <img class="img-fluid" id="imagemeuble" src="<?php echo $element['image'] ?>"
                            alt="canape-myshop">
                    </div>
                    <div class="row" id="infosdumeuble">
                        <div class="col-6 col-md-9" id="nomdumeuble-categorie">
                            <p class="nomdumeuble"><a href=#><?php echo $element['name'] ?></a></p>
                            <p class="categorie"><?php echo "CATEGORIE" ?></p>
                            <p><img class="star" src="images/Star - On.png" alt="icone-star">
                                <img class="star" src="images/Star - On.png" alt="icone-star">
                                <img class="star" src="images/Star - On.png" alt="icone-star">
                                <img class="star" src="images/Star.png" alt="icone-star">
                            </p>
                        </div>
                        <div class="col-6 col-md-3" id="prix-caddie">
                            <?php echo $element['price'].'$'?>
                            <a href="#"><img class="caddie" src="images/Cart Button.png" width="18" height="18"
                                    alt="icone-caddie"></a>
                        </div>
                    </div>
                </div><!-- fin de la case "meuble et infos"-->
                <?php
                }
            }
            else {
            
                $req = $pdo->query('SELECT name, price, image FROM products LIMIT '.($page - 1) * $records_per_page.','.$records_per_page.';');
                $req = $req->fetchAll();
                foreach ($req as $element) {
            ?>
            <div class="col-12 col-md-3" id="casemeubleetinfos">
                <!-- début de la case "meuble et infos"-->
                <div class="row">
                    <img class="img-fluid" id="imagemeuble" src="<?php echo $element['image'] ?>"
                        alt="canape-myshop">
                </div>
                <div class="row" id="infosdumeuble">
                    <div class="col-6 col-md-9" id="nomdumeuble-categorie">
                        <p class="nomdumeuble"><a href=#><?php echo $element['name'] ?></a></p>
                        <p class="categorie"><?php echo "CATEGORIE" ?></p>
                        <p><img class="star" src="images/Star - On.png" alt="icone-star">
                            <img class="star" src="images/Star - On.png" alt="icone-star">
                            <img class="star" src="images/Star - On.png" alt="icone-star">
                            <img class="star" src="images/Star.png" alt="icone-star">
                        </p>
                    </div>
                    <div class="col-6 col-md-3" id="prix-caddie">
                        <?php echo $element['price'].'$'?>
                        <a href="#"><img class="caddie" src="images/Cart Button.png" width="18" height="18"
                                alt="icone-caddie"></a>
                    </div>
                </div>
            </div><!-- fin de la case "meuble et infos"-->
            <?php
                }
            }
            ?>
            

        </div>
        <!--FIN DU ROW VITRINE-->


        <div class="row" id="footer">


            <!-- DEBUT DU ROW FOOTER-->
            <div class="col-12">
                <footer id="footer">
                    <div class="contenu-footer">
                        <div class="widescreen">
                            <ul class="pages">
                                <table>
                                    <tr>
                                        <?php 
                                            for ($i = 1; $i <= $nbrpages; $i++) {
                                            ?>
                                                <td><a href="index.php?page=<?=$i.$queryString?>"><?=$i?></a></td>
                                            <?php
                                            }
                                        ?>
                                    </tr>
                                </table>
                            </ul>
                        </div>
                    </div>
                </footer>
            </div>
            <div class="col-12">
                <footer id="footer">
                    <div class="contenu-footer"></div>
                    <div class="mobilescreen">
                        <ul class="pages">
                            <table>
                                <tr>
                                <?php 
                                    for ($i = 1; $i <= $nbrpages; $i++) {
                                    ?>
                                    <td><a href="index.php?page=<?=$i.$queryString?>"><?=$i?></a></td>
                                    <?php
                                    }
                                ?>
                                </tr>
                            </table>
                        </ul>
                    </div>
                </footer>
            </div>
        </div>

    </div>
</body>



</html>