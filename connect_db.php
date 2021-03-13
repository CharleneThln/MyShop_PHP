<?php

function connect_db($host, $username, $passwd, $port, $db) {

        try {

            if (!isset($host) OR !isset($username) OR !isset($passwd) OR !isset($port) OR !isset($db)) {
                echo "Bad params! Usage: php connect_db.php host username password port db\n";
                error_log('Bad params! Usage: php connect_db.php host username password port db', 3, "errors.log");
                return;
            }
        
            $var = "mysql:host=".$host.";dbname=".$db.";port=".$port;
            $pdo = new PDO($var, $username, $passwd);
            //echo "Connection DB successful\n";
            return $pdo;
        }
        catch (PDOException $e) {

            echo "Error connection to DB\n";
            error_log("PDO ERROR: ".$e->getMessage()."storage in errors.log\n", 3, "errors.log");
            return;
        }

}

$pdo = connect_db('localhost', 'root', 'Passw0rd!', 3306, 'my_shop');