<?php
    setcookie('testCookie', 'testing', time()+3600, '/', '', 0);
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
                <h1 class='text-center m-2'>Day 7 / 100</h1>
                <hr>
            </div>
            <div class='col-sm-12 col-md-6'>
                <h3 class='text-center'>Functions</h3>
                <hr>
                <h4>Function Creation:</h4>
                <?php
                    // Defining the function.
                    function writeMessage() {
                        echo '<p class=\'text-muted\'>I am a function that displays a message.<p>';
                    }
                    writeMessage();
                ?>
                <h4>Functions /w Parameters:</h4>
                <?php
                    // Defining the function.
                    function sumNumbers($number1, $number2) {
                        $sum = $number1 + $number2;
                        echo '<p class=\'text-muted\'>The sum of the two numbers is ' . $sum . '.';
                    }
                    sumNumbers(11, 45);
                ?>
                <h4>Passing Arguments via Reference:</h4>
                <?php
                    function addTen($num) {
                        $num += 10;
                    }

                    function addFive(&$num) {
                        $num += 5;
                    }

                    $originalNumber = 10;
                    addTen($originalNumber);
                    echo '<p class=\'text-muted m-0\'>Original Value is ' . $originalNumber . '.</p><br>';

                    addFive($originalNumber);
                    echo '<p class=\'text-muted\'>Original Value is ' . $originalNumber . '.</p>';
                ?>
                <h4>Value Returning Functions:</h4>
                <?php
                    function sumFunction($number1, $number2) {
                        $sum = $number1 + $number2;
                        return $sum;
                    }

                    $returnedValue = sumFunction(10, 5);
                    echo '<p class=\'text-muted\'>Value returned from function is ' . $returnedValue . '.</p>';
                ?>
                <h4>Setting Default Values:</h4>
                <?php
                    function printMe($parameter = NULL) {
                        print $parameter;
                    }
                    
                    printMe('<p class=\'text-muted\'>This will only display with a set value, like this.</p>');
                    printMe();
                ?>
                <h4>Dynamic Function Calls:</h4>
                <?php
                    function dynamicFunction() {
                        echo "<p class='text-muted'>Hello.</p><br>";
                    }

                    $functionHolder = "dynamicFunction";
                    $functionHolder(); // Function has been set to the variable.
                ?>
            </div>
            <div class='col-sm-12 col-md-6'>
                <h3 class='text-center'>Cookies</h3>
                <hr>
                <h4>Setting Cookies with setcookie() function:</h4>
                <h5 class='d-inline'>Name:</h5>
                <p class='d-inline text-muted'>This sets the name of the cookie.<br></p>
                <h5 class='d-inline'>Value:</h5>
                <p class='d-inline text-muted'>This is the value that is set to the cookie.<br></p>
                <h5 class='d-inline'>Expiry:</h5>
                <p class='d-inline text-muted'>This is when the cookie will expire - if not set, will expire on browser close.<br></p>
                <h5 class='d-inline'>Path:</h5>
                <p class='d-inline text-muted'>This is where the directories the cookie will apply to.<br></p>
                <h5 class='d-inline'>Domain:</h5>
                <p class='d-inline text-muted'>Specifies the domain name.<br></p>
                <h5 class='d-inline'>Security: </h5>
                <p class='d-inline text-muted'>Specifies the the cookie can either only be set to secure HTTPS sites or not.<br></p>
                <?php
                    if (isset($_COOKIE['testCookie'])) {
                        echo "Welcome " . $_COOKIE['testCookie'];
                        setcookie('testCookie', '', time()-60, '/', '', 0);
                        // Echoing then deleting cookie.
                    }
                ?>
                <p class='text-muted'>Cookie Deleted.</p>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>