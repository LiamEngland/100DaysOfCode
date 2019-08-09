<?php

include_once('config.php');
include_once('header.php');
include("getID3-master/getid3/getid3.php");

$target_dir = "uploads/video/";
$target_file = $target_dir . basename($_FILES["videoToUpload"]["name"]);
$uploadOk = 1;
$videoFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

$temp = explode(".", $_FILES["videoToUpload"]["name"]);
$time = round(microtime(true));
$newFileName = $target_dir . $time . '.' . end($temp);
$existingName = $_FILES["videoToUpload"]["name"];

if (file_exists($newFileName)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

if ($_FILES["videoToUpload"]["size"] > 1000000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

if (!isset($_FILES["videoToUpload"]["sizename"]) && $_FILES["videoToUpload"]["name"] == '') {
    echo "File not set.";
    // add flash for file name not set.
    $uploadOk = 0;
}


$userFile = $time . '.' . end($temp);

if (move_uploaded_file($_FILES["videoToUpload"]["tmp_name"], $newFileName)) {

    $getID3 = new getID3;
    $file = $getID3->analyze($newFileName);
    $playtimeSeconds = $file['playtime_seconds'];
    $videoLength = gmdate("H:i:s", $playtimeSeconds);
    
    $sql = "INSERT INTO videoFiles SET actualFileName = ?, originalFileName = ?, user_id = ?, videoLength = ?";

    $statement = $connection->prepare($sql);

    $statement->bind_param('ssis', $userFile, $existingName, $_SESSION['id'], $videoLength);
    $statement->execute();
    header('location: video.php');
    // Add flash.
} else {
    header('location: video.php');
}

?>