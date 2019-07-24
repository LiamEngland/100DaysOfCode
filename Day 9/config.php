<?php
ini_set('display_error', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$dbHost = new PDO('mysql:host=localhost;dbname=mediaApp', 'root', '');
$statement = $dbHost->prepare('SELECT * FROM :users;');
$statement->execute();

$rows = $statement->fetchAll(PDO::FETCH_ASSOC);

foreach ($rows as $row) {
    echo $row['user_username'];
}

?>