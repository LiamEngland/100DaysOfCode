<?php

include_once('config.php');
include_once('header.php');

$target_dir = "uploads/audio/";
$target_file = $target_dir . basename($_FILES["songToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

$temp = explode(".", $_FILES["songToUpload"]["name"]);
$time = round(microtime(true));
$newfilename = $target_dir . $time . '.' . end($temp);

if (file_exists($newfilename)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

if ($_FILES["songToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

//var_dump($_FILES['songToUpload']);
//exit;

$userFile = $time . '.' . end($temp);

if (move_uploaded_file($_FILES["songToUpload"]["tmp_name"], $newfilename)) {
    $sql = "UPDATE audioFiles SET actualFileName = ? WHERE id = ?";

    $statement = $connection->prepare($sql);

    $statement->bind_param('si', $userFile, $_SESSION['id']);
    $statement->execute();
    header('location: audio.php');
    // Add flash.
} else {
    header('location: audio.php');
}

?>