<?php

include_once('config.php');
include_once('header.php');
include("getID3-master/getid3/getid3.php");

$target_dir = "uploads/audio/";
$target_file = $target_dir . basename($_FILES["songToUpload"]["name"]);
$uploadOk = 1;
$audioFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$allowedExtentions = array('wav', 'mpeg', 'mp3');

$temp = explode(".", $_FILES["songToUpload"]["name"]);
$time = round(microtime(true));
$newFileName = $target_dir . $time . '.' . end($temp);
$existingName = $_FILES["songToUpload"]["name"];

if (file_exists($newFileName)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

if ($_FILES["songToUpload"]["size"] > 1000000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

if (!isset($_FILES["songToUpload"]["sizename"]) && $_FILES["songToUpload"]["name"] == '') {
    echo "File not set.";
    $uploadOk = 0;
}

if (!in_array($audioFileType, $allowedExtentions)) {
    $uploadOk = 0;
}

$userFile = $time . '.' . end($temp);

if ($uploadOk == 1) {
    if (move_uploaded_file($_FILES["songToUpload"]["tmp_name"], $newFileName)) {
        $getID3 = new getID3;
        $file = $getID3->analyze($newFileName);
        $playtimeSeconds = $file['playtime_seconds'];
        $songLength = gmdate("H:i:s", $playtimeSeconds);
        
        $sql = "INSERT INTO audioFiles SET actualFileName = ?, originalFileName = ?, user_id = ?, songLength = ?";

        $statement = $connection->prepare($sql);

        $statement->bind_param('ssis', $userFile, $existingName, $_SESSION['id'], $songLength);
        $statement->execute();
        header('location: audio.php');
    }
} else {
    header('location: audio.php');
}

?>