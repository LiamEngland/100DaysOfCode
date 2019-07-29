<?php

$serverName = 'localhost';
$username = 'root';
$password = '';
$databaseName = 'mediaapp';

$connection = new mysqli($serverName, $username, $password, $databaseName);
 
if ($connection->connect_error) { // Checking connection.
    die('Connection failed: ' . $connection->connect_error);
}
?>