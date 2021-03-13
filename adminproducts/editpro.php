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

if (isset($_GET['id'])) {
    if (!empty($_POST['name']) && !empty($_POST['price']) && !empty($_POST['category_id'])) {

        /*$id = isset($_POST['id']);
        $name = isset($_POST['name']);
        $price = isset($_POST['price']);
        $category_id = isset($_POST['category_id']);*/
        $stmt = $pdo->prepare('UPDATE products 
        SET id =' .$_POST['id']. ',name ="' .$_POST['name']. '",price =' .$_POST['price']. ',category_id =' .$_POST['category_id']. ' 
        WHERE id =' .$_POST['id'].';');
        $stmt->execute();
        $msg = 'Updated Successfully!';
        
    }
    $stmt = $pdo->prepare('SELECT * FROM products WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$product) {
        exit('Product doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specified!');
}

?>
<div class="content update">
	<h2>Update Product #<?=$product['id']?></h2>
    <form action="editpro.php?id=<?=$product['id']?>" method="post">
        <label for="id">ID</label>
        <label for="name">Name</label>
        <input type="text" name="id" placeholder="ID" value="<?=$product['id']?>" id="id">
        <input type="text" name="name" placeholder="Name" value="<?=$product['name']?>" id="name">
        <label for="price">Price</label>
        <label for="category_id">Category_id</label>
        <input type="text" name="price" placeholder="price" value="<?=$product['price']?>" id="price">
        <input type="text" name="category_id" placeholder="category_id" value="<?=$product['category_id']?>" id="category_id">
        <input type="submit" value="Update">
    </form>
    <a href="adminpro.php"><button class="back" >BACK</button></a> 
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>
</body>
</html>