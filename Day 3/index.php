<!DOCTYPE html>
<html>
<head>
    <link rel='stylesheet' href='style.css'>
    <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
    <title>Day 3</title>
</head>
<body>
    <div class='header'>
        <h1>Day 3 / 100</h1>
        <hr>
    </div>
    <div class='container'>
        <h2>Arrays</h2>
        <hr>
        <h3>Numeric Array:</h3>
        <?php
        $numbers = array(0, 1, 2, 3, 4);
        foreach($numbers as $number) {
            echo $number;
        }
        echo '<br>';
        ?>
        <h3>Associative Array:</h3>
        <?php
        $wages = array("Daniel" => 1000, "Nathan" => 1200, "Charlie" => 1100);
        echo "Salary of Daniel is " . $wages['Daniel'] . '<br>';
        echo "Salary of Nathan is " . $wages['Nathan'] . '<br>';
        echo "Salary of Charlie is " . $wages['Charlie'] . '<br>';

        $wages['Daniel'] = "Low";
        $wages['Nathan'] = "High";
        $wages['Charlie'] = "Medium";

        echo 'Wage of Daniel is ' . $wages['Daniel'] . '<br>';
        echo 'Wage of Nathan is ' . $wages['Nathan'] . '<br>';
        echo 'Wage of Charlie is ' . $wages['Charlie'] . '<br>';
        ?>
        <h3>Multidimentional Array:</h3>
        <?php
        $skillset = array(
            'Daniel' => array(
                0 => 'Accounting',
                1 => 'Mathematics',
                2 => 'Economics'
            ),
            'Nathan' => array(
                0 => 'Engineering',
                1 => 'Physics',
                2 => 'Mathematics'
            ),
            'Charlie' => array(
                0 => 'Zookeeping',
                1 => 'Biology',
                2 => 'English'
            )
        );
        
        echo 'Daniel\'s skills are: ';
        foreach($skillset['Daniel'] as $skill) {
            echo $skill . ' ';
        }
        ?>
        <hr>
        <h2>String Operations</h2>
        <hr>
        <h3>Single vs Double Quotations:</h3>
        <?php
        $name = 'Liam';
        echo "My name is $name <br>";
        echo 'My name is $name<br>';

        echo 'The value length stored in $name is ' . strlen($name) . '<br>';
        ?>

    </div>
</body>
</html>