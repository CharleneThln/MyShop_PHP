<?php
session_start();
include_once('../connect_db.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="alexcss.css">
    <link rel="stylesheet" href="frontcharlene.css">
    <link rel="stylesheet" href="frontchadhi.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="admin.css">
    <title>MyShop - Delete</title>
</head>

<body>
    <?php
    //$pdo = new PDO("mysql:host=localhost;dbname=my_shop;charset=utf8", 'root', 'password');

    $msg = '';
    if (isset($_GET['id'])) {
        $stmt = $pdo->prepare('SELECT * FROM products WHERE id = ?');
        $stmt->execute([$_GET['id']]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$product) {
            exit('Product doesn\'t exist with that ID!');
        }
        if (isset($_GET['confirm'])) {
            if ($_GET['confirm'] == 'yes') {
                $stmt = $pdo->prepare('DELETE FROM products WHERE id = ?');
                $stmt->execute([$_GET['id']]);
                $msg = 'You have deleted the product!';
            } else {
                header('Location: admin.php');
                exit;
            }
        }
    } else {
        exit('No ID specified!');
    }
    ?>
    <div class="content delete">
        <h2>Delete Product #<?= $product['id'] ?></h2>
        <?php if ($msg) : ?>
            <p><?= $msg ?></p>
        <?php else : ?>
            <p>Are you sure you want to delete product #<?= $product['id'] ?>?</p>
            <div class="yesno">
                <a href="delete.php?id=<?= $product['id'] ?>&confirm=yes">Yes</a>
                <a href="delete.php?id=<?= $product['id'] ?>&confirm=no">No</a>
            </div>
        <?php endif; ?>
        <a href="admin.php" class="content update" type="submit" value="Back home" >BACK </a> 

    </div>
</body>

</html>