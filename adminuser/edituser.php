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
$msg = '';

if (isset($_GET['id'])) {
    //echo "j'ai trouvé un get[id]";
    
    if (!empty($_POST['id']) && !empty($_POST['username']) 
    && empty($_POST['password']) // PAS DE MODIFICATION DU PASSWORD DE L'USER
    && !empty($_POST['email']) && !empty($_POST['admin'])) {

        //echo "les champs sont remplis excepté le mdp";
        /*if ($_POST['admin'] == "YES") {
            $admin = 0;
        }
        elseif ($_POST['admin'] == "NO") {
            $admin = NULL;
        }*/

        try {
            $stmt = $pdo->prepare('UPDATE users 
            SET id =' .$_POST['id']. ', username = "' .$_POST['username']. '", email ="' .$_POST['email']. '", 
            admin ='. $_POST['admin'] .' WHERE id =' .$_POST['id'].';');
            $stmt->execute(); 
            $msg = 'Updated Successfully!';
        }
        catch (Exception $e) {

            echo $e->getMessage();

        }   
    }

    if (!empty($_POST['id']) && !empty($_POST['username']) 
    && !empty($_POST['password']) // MODIFICATION DU PASSWORD DE L'USER, le POST est "not empty"
    && !empty($_POST['email']) && !empty($_POST['admin'])) {

        //echo "tous les champs sont remplis";
        
        if ($_POST['admin'] == "YES") {
            $admin = 0;
        }
        elseif ($_POST['admin'] == "NO") {
            $admin = NULL;
        }

        $newpassword = password_hash($_POST['password'], PASSWORD_BCRYPT); //hachage d'un nouveau password

        try {
            $stmt = $pdo->prepare('UPDATE users 
            SET id =' .$_POST['id']. ', username = "'.$_POST['username'].'", password ="'.$newpassword.'", 
            email ="'.$_POST['email'].'", admin ='.$_POST['admin'].' WHERE id ='.$_POST['id'].';');
            $stmt->execute(); 
            $msg = 'Updated Successfully!';
        }
        catch (Exception $e) {

            echo $e->getMessage();

        }   
    }
    //echo "j'ai trouvé un ID et je prépare une requête \n";
    $stmt = $pdo->prepare('SELECT * FROM users WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $users = $stmt->fetch(PDO::FETCH_ASSOC);

    /*if ($_users['admin'] != NULL) {
        $_users['admin'] = "YES";
    }
    if ($_users['admin'] === NULL) {
        $_users['admin'] = "NO";
    }*/
    
    if (!$users) {
        exit('User doesn\'t exist with that ID!');
    }
}
else {
    exit('No ID specified!');
}



?>
<div class="content update">
	<h2>Update User #<?=$users['id']?></h2>
    <form action="edituser.php?id=<?=$users['id']?>" method="post">
        <label for="id">ID</label>
        <label for="username">Username</label>
        <input type="text" name="id" placeholder="ID" value="<?=$users['id']?>" id="id">
        <input type="text" name="username" placeholder="Username" value="<?=$users['username']?>" id="username">
        <label for="email">Email</label>
        <label for="admin">Password</label>
        <input type="text" name="email" placeholder="email" value="<?=$users['email']?>" id="email">
        <input type="password" name="password" placeholder="password" value="" id="password"> <!--$users['password']-->
        <label for="admin">Admin Status (if admin, write "1" / if not, write "NULL")</label>
        <input type="text" name="admin" placeholder="write 1 or NULL" value="<?=$users['admin']?>" id="admin">
        <input type="submit" value="Update">
    </form>
    <a href="adminuser.php"><button class="back" >BACK</button></a> 
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>
</body>
</html>