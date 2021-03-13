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

    if (!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['email'])) {
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            echo "Email format invalid. \n";
        }
        else {
        $newpasshash = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $stmt = $pdo->prepare('INSERT INTO users (username, password, email) 
        VALUES ("'.$_POST['username'].'","'.$newpasshash.'","'.$_POST['email'].'");');
        $stmt->execute();
        $msg = 'Created Successfully!';
        }
    }
    else {    
        $msg = "Missing one or more value(s) \n";
        }
    

?>
<div class="content update">
	<h2>Add User</h2>
    <form action="adduser.php" method="post">
        <label for="username">Username</label>
        <label for="password">Password provisoire</label>
        <input type="text" name="username" placeholder="Username" id="username">
        <input type="password" name="password" placeholder="Password" id="password">
        <label for="email">Email</label>
        <input type="text" name="email" placeholder="Email" id="email">
        <input type="submit" value="ADD">
    </form>
    <a href="adminuser.php"><button class="back" >BACK</button></a> 
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>
</body>
</html>