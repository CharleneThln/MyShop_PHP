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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="alexcss.css">
    <link rel="stylesheet" href="frontcharlene.css">
    <link rel="stylesheet" href="frontchadhi.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="admin.css">
    <title>MyShop - Add</title>
</head>
<body>
<?php
//$pdo = new PDO("mysql:host=localhost;dbname=my_shop;charset=utf8", 'root', 'password');
?>
<?php
$msg = '';
if (!empty($_POST['name']) && !empty($_POST['price']) && !empty($_POST['category_id']) && !empty($_POST['image'])) {

    $stmt = $pdo->prepare('INSERT INTO products (/*id,*/ name, price, category_id, image) 
    VALUES (/*'.$_POST['id'].',*/"'.$_POST['name'].'",'.$_POST['price'].','.$_POST['category_id'].',"'.$_POST['image'].'");');
    $stmt->execute();
    $msg = 'Created Successfully!';
}
else {
    $msg = "One or more value(s) missing \n";
}
?>
<div class="container">
    <div class="content update">
        <h2>Add Product</h2>
        <form action="add.php" method="post">
        <!-- <label for="id">ID</label>-->
            <label for="name">Name</label>
            <!--<input type="text" name="id" placeholder="Id" value="auto" id="id">-->
            <label for="price">Price</label>
            <input type="text" name="name" placeholder="Name" id="name">
            <input type="text" name="price" placeholder="Price" id="price">
            <label for="category_id">Category_id</label>
            <label for="image">Image</label>
            <input type="text" name="category_id" placeholder="Category_id" id="category_id">
            <input type="text" name="image" placeholder="Lien vers image" id="image">
            <input type="submit" value="ADD">
            <a href="admin.php" class="content update" type="submit" value="Back home">BACK</a> 
        </form>
        <?php if ($msg): ?>
        <p><?=$msg?></p>
        <?php endif; ?>
    </div>
</div>
</body>
</html>