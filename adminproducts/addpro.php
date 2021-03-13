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
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../admin.css">
    <title>My shop</title>
</head>
<body>
<?php
//$pdo = new PDO("mysql:host=localhost;dbname=my_shop;charset=utf8", 'root', 'password');

$msg = '';
if (!empty($_POST['name']) && !empty($_POST['price']) && !empty($_POST['category_id'])) {
    $stmt = $pdo->prepare('INSERT INTO products (name, price, category_id) 
    VALUES ("'.$_POST['name'].'",'.$_POST['price'].','.$_POST['category_id'].');');
    $stmt->execute();
    $msg = 'Created Successfully!';
    }
else{
    $msg = "Missing one or more value(s) \n";
    }
?>
<div class="content update">
	<h2>Add Product</h2>
    <form action="addpro.php" method="post">
        <label for="name">Name</label>
        <input type="text" name="name" placeholder="Name" id="name">
        <label for="price">Price</label>
        <label for="category_id">Category_id</label>
        <input type="text" name="price" placeholder="Price" id="price">
        <input type="text" name="category_id" placeholder="Category_id" id="category_id">
        <input type="submit" value="ADD">
    </form>
    <a href="adminpro.php"><button class="back" >BACK</button></a> 
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>
</body>
</html>