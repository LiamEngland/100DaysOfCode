<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'mediaapp');
 
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
if ($link === false) { // Check Database Connection.
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>