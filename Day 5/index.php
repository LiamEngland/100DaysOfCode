<!DOCTYPE html>
<html>
<head>
    <link rel='stylesheet' href='style.css'>
    <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Day 5</title>
</head>
<body>
    <div class='container-fluid'>
        <div class='row'>
            <div class='col-12'>
                <h1 class='text-center m-3'>Day 5 / 100</h1>
            </div>
            <div class='col-sm-12 col-md-6 mb-4'>
                <h3 class='text-center'>Randomisation</h3>
                <hr>
                <?php
                    srand((float)microtime() * 1000000 );
                    $num = rand( 1, 4 );

                    switch ($num) {
                        case 1: $imageRoute = '1.png';
                        break;

                        case 2: $imageRoute = '2.png';
                        break;

                        case 3: $imageRoute = '3.png';
                        break;

                        case 4: $imageRoute = '4.png';
                        break;
                    }

                    echo 'Random Image: <br><img src=\'' . $imageRoute . '\'>';
                ?>
            </div>
            <div class='col-sm-12 col-md-6 mb-4'>
                <h3 class='text-center'>Using HTML Forms</h3>
                <hr>
                <form action='<?php $_PHP_SELF ?>' method='POST'>
                    <div class='form-group'>
                        <label for='firstName'>First Name: </label>
                        <input type='text' class='form-control' id='firstName' name='firstName'>
                    </div>
                    <div class='form-group'>
                        <label for='age'>Age: </label>
                        <input type='number' class='form-control' id='age' name='age'>
                    </div>
                    <button type='submit' class='btn btn-success'>Submit</button>
                </form>
                <?php
                    if (isset($_POST['firstName']) || isset($_POST['age'])) {
                        if (preg_match("/[^[A-Za-z'-]/", $_POST['firstName'])) {
                            die ('Invalid Name & Name should be alpha.');
                        }
                        echo 'Welcome ' . $_POST['firstName'] . '<br>';
                        echo 'You\'re ' . $_POST['age'] . ' years old.';

                    }
                ?>
            </div>
            <div class='col-sm-12 col-md-6 mb-2'>
                <h3 class='text-center'>Browser Redirection</h3>
                <hr>
                <?php
                    if (isset($_POST['location'])) {
                        $location = $_POST['location'];
                        header("Location:$location");
                    }
                ?>
                <form action = "<?php $_SERVER['PHP_SELF'] ?>" method='POST'>
                    <select name ='location' class='form-control mb-2'>
                        <option value='https://www.google.co.uk'>Google</option>
                    </select>
                    <button type='submit' class='btn btn-success'>Submit</button>
                </form>
            </div>
            <div class='col-sm-12 col-md-6 mb-2'>
                <h3 class='text-center'>Get & Post Data</h3>
                <hr>
                <?php
                    if (isset($_GET)) {
                        echo 'GET data set.<br>';
                    } else {
                        echo 'No GET data set.<br>';
                    }

                    if (isset($_POST)) {
                        echo 'POST data set.<br>';
                    } else {
                        echo 'No POST data set.<br>';
                    }
                    
                    echo '<br> $_REQUEST stores $_GET, $_POST and  $_COOKIE. It can be used to get results from both GET and POST.';

                ?>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>