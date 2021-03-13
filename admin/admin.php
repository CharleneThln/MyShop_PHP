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
    <title>MyShop - ADMIN</title>
</head>
<body>
    <div class="container">
        <div class="content">
            <h2>Admin</h2>
            <p>Welcome to the admin page!</p>
        <?php
            // Number of records to show on each page
            $records_per_page = 10;
            
            $req = $pdo->query('SELECT COUNT(id) FROM products;');
            $nbrproducts = $req->fetchColumn();
            $nbrpages = round($nbrproducts / $records_per_page);
            //echo $nbrproducts . " produits sont dans la base";
            //echo "\n";
            //echo "il y a ". $nbrpages . " pages avec ".$records_per_page." produits par pages\n";
            
            $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
            
            // Prepare the SQL statement and get records from our contacts table, LIMIT will determine the page
            $stmt = $pdo->prepare('SELECT * FROM products ORDER BY id LIMIT :current_page, :record_per_page');
            $stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
            $stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
            $stmt->execute();
            // Fetch the records so we can display them in our template.
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>
        </div>
    </div>
    <div class="container">
        <a href="add.php" class="create-contact">Add Product</a>
        <table>
            <thead>
                <tr>
                    <td>id</td>
                    <td>name</td>
                    <td>price</td>
                    <td>category_id</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                <tr>
                    <td><?=$product['id']?></td>
                    <td><?=$product['name']?></td>
                    <td><?=$product['price']?></td>
                    <td><?=$product['category_id']?></td>
                    <td class="actions">                  
                    <a href="edit.php?id=<?=$product['id']?>" class="edit" >EDIT</a> 
                    <a href="delete.php?id=<?=$product['id']?>" class="trash">TRASH</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>


    <div class="row" id="footer">
        <div class="col-12">
            <ul class="pages">
                <table>
                    <tr>
                        <?php 
                        for ($i = 1; $i <= $nbrpages; $i++) {
                        ?>
                        <td><a href="admin.php?page=<?=$i?>"><?=$i?></a></td>
                        <?php
                        }
                        ?>
                    </tr>
                </table>
            </ul>
        </div>
    </div>

</body>
</html>