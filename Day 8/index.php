<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <link rel='stylesheet' href='style.css'>
    <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Day 7</title>
</head>
<body>
    <div class='container-fluid'>
        <div class='row'>
            <div class='col-12'>
                <h1 class='text-center'>Day 8 / 100</h1>
                <hr>
            </div>
            <div class='col-sm-12 col-md-6'>
                <h3>PHP Sessions:</h3>
                <hr>
                <?php
                    if (isset($_SESSION['counter'])) {
                        $_SESSION['counter'] += 1;
                    } else {
                        $_SESSION['counter'] = 1;
                    }

                    echo '<p class=\'text-muted\'>You\'ve visited this page ' . $_SESSION['counter'] . ' times.</p>';

                    unset($_SESSION['counter']);
                    session_destroy();
                    echo '<p class=\'text-muted\'>Session Destroyed</p>';
                ?>
            </div>
            <div class='col-sm-12 col-md-6'>
                <h3>File Uploading:</h3>
                <hr>
                <?php
                    if (isset($_FILES['image'])) {
                        $errors = array();
                        $fileName = $_FILES['image']['name'];
                        $fileSize = $_FILES['image']['size'];
                        $fileTmp = $_FILES['image']['tmp_name'];
                        $fileType = $_FILES['image']['type'];
                        $tmp = explode('.', $fileName);
                        $fileExtention = end($tmp);
                    }

                    $extentions = array('jpeg', 'jpg', 'png');

                    if (isset($fileExtention) && in_array($fileExtention, $extentions)) {
                        $errors[] = 'Extension not allowed. Please choose a JPEG or PNG file.';
                    }

                    if (isset($fileSize) && $fileSize > 2097152) {
                        $errors[] = 'File must be less than 2MB';
                    }

                    if (isset($fileTmp) && isset($fileName) && empty($errors) == true) {
                        move_uploaded_file($fileTmp, 'uploads/'.$fileName);
                        echo "File uploaded.";
                    }
                ?>
                <form action="" method= "POST" enctype="multipart/form-data">
                    <input type="file" name="image">
                    <input type="submit">
                        
                    <ul>
                        <li>Sent file: <?php echo $_FILES['image']['name']; ?>
                        <li>File size: <?php echo $_FILES['image']['size']; ?>
                        <li>File type: <?php echo $_FILES['image']['type']; ?>
                    </ul>
                        
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>