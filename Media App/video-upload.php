<?php

include_once('config.php');
include_once('header.php');
include("getID3-master/getid3/getid3.php");

$target_dir = "uploads/video/";
$target_file = $target_dir . basename($_FILES["videoToUpload"]["name"]);
$uploadOk = 1;
$videoFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$allowedExtentions = array('mp4', 'webm', 'ogg');

$temp = explode(".", $_FILES["videoToUpload"]["name"]);
$time = round(microtime(true));
$newFileName = $target_dir . $time . '.' . end($temp);
$existingName = $_FILES["videoToUpload"]["name"];

if (file_exists($newFileName)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

if ($_FILES["videoToUpload"]["size"] > 100000000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

if (!isset($_FILES["videoToUpload"]["sizename"]) && $_FILES["videoToUpload"]["name"] == '') {
    echo "File not set.";
    $uploadOk = 0;
}

if (!in_array($videoFileType, $allowedExtentions)) {
    $uploadOk = 0;
}

if (((!$_FILES["videoToUpload"]["type"] == "video/mp4") || (!$_FILES["videoToUpload"]["type"] == "video/webm") || (!$_FILES["videoToUpload"]["type"] == "video/ogg"))) {
    $uploadOk = 0;
} 

$userFile = $time . '.' . end($temp);

if ($uploadOk == 1) {
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
    }
} else {
    header('location: video.php');
}

?>