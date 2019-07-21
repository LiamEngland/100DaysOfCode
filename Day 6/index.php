<!DOCTYPE html>
<html>
<head>
    <link rel='stylesheet' href='style.css'>
    <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Day 6</title>
</head>
<body>
    <div class='container-fluid'>
        <div class='row'>
            <div class='col-12'>
                <h1 class='text-center m-3'>Day 6 / 100</h1>
                <hr>
            </div>
            <div class='col-sm-12 col-md-6 mb-4'>
                <h3>File Inclusion</h3>
                <hr>
                <?php include("menu.php"); ?>
            </div>
            <div class='col-sm-12 col-md-6 mb-4'>
                <h3>Files & I/O</h3>
                <hr>
                <h4>File Reading:</h4>
                <?php
                    $fileName = "sample.txt";
                    $file = fopen( $fileName, "r");
                    
                    if ($file == false) {
                        echo ("Error opening file.");
                        exit();
                    }
                    
                    $fileSize = filesize($fileName);
                    $fileText = fread($file, $fileSize);
                    fclose($file);
                    
                    echo ("File size : $fileSize bytes");
                    echo ("<pre>$fileText</pre>");
                ?>
                <h4>File Writing:</h4>
                <?php
                    unset($fileName);
                    unset($file);
                    $fileName = "newText.txt";
                    $file = fopen($fileName, "w");
                    
                    if ($file == false) {
                        echo ("Error in creating new file");
                        exit();
                    }
                    fwrite($file, "This is a test\n");
                    fclose($file);
                    $file = fopen( $fileName, "r");
                    
                    if ($file == false) {
                        echo ("Error opening file.");
                        exit();
                    }
                    
                    $fileSize = filesize($fileName);
                    $fileText = fread($file, $fileSize);
                    fclose($file);
                    
                    echo ("File size : $fileSize bytes");
                    echo ("<pre>$fileText</pre>");
                ?>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>