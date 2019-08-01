<?php

include_once('config.php');
include_once('header.php');

$target_dir = "uploads/profile-picture/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

$temp = explode(".", $_FILES["fileToUpload"]["name"]);
$time = round(microtime(true));
$newfilename = $target_dir . $time . '.' . end($temp); 

if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

if (file_exists($newfilename)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
} else {
    $userImage = $time . '.' . end($temp);

    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $newfilename)) {
        $sql = "UPDATE user SET actualFileName = ? WHERE id = ?";

        $statement = $connection->prepare($sql);

        $statement->bind_param('si', $userImage, $_SESSION['id']);
        $statement->execute();
        header('location: user.php');
        // Add flash.
    } else {
        header('location: user.php');
        // Add flash.
    }
}
?>