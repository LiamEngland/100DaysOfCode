<!DOCTYPE html>
<html>
<head>
    <link rel='stylesheet' href='style.css'>
    <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
</head>
<body>
    <?php
        $a = 100;
        $b = 25;
    ?>
    <div class='header'>
        <h1>Day 2 / 100</h1>
    </div>
    <div class='container'>
        <h3>Descision Making</h3>
        <hr>
        <h4>If Else Statement: </h4>
        <?php
            if ($a == $b) {
                echo '<p>' . $a . ' is equal to' . $b . '</p>';
            } else {
                echo '<p>' . $a . ' is not equal to ' . $b . '.</p>';
            }
        ?>
        <h4>Else If Statement: </h4>
        <?php
            if ($a == $b) {
                echo '<p>' . $a . ' is equal to' . $b . '</p>';
            } else if ($a + $b == 125) {
                echo '<p>' . $a . ' + ' . $b . ' equals 125.</p>';
            } else {
                echo 'This won\'t be hit.';
            }
        ?>
        <h4>Switch Statement: </h4>
        <?php
            switch ($a) {
                case 110:
                    echo '<p>$a equals to 110.</p>';
                    break;

                case 100:
                    echo '<p>$a equals to 100.</p>';
                    break;

                default:
                    echo '<p>This won\'t be hit.</p>';
    
            }

        ?>
        <hr>
        <h3>Loop Types</h3>
        <hr>
        <h4>For Loop:</h4>
        <?php
            $forloop[] = [];

            for ($i = 0; $i < 10; $i++) {
                array_push($forloop, $i);
                if ($i == 5) {
                    echo '<p>Loop exited at ' . $i . '</p>';
                    break;
                }
            }

            print_r($forloop);
            unset($i, $forloop);
        ?>
        <h4>While:</h4>
        <?php
            $i = 0;
            $forloop[] = [];

            while ($i < 10) {
                if ($i == 4) {
                    echo 'Loop continued at ' . $i . '<br>';
                    $i++;
                    continue;
                }
                $i++;
                array_push($forloop, $i);
            }

            print_r($forloop);
            unset($i, $forloop);
        ?>
        <h4>Do While:</h4>
        <?php
            $i = 0;
            $forloop[] = [];

            do {
                $i++;
                array_push($forloop, $i);
            } while ($i < 10);

            print_r($forloop);
            unset($i);
        ?>
        <h4>Foreach:</h4>
        <?php
            $i = 0;
            foreach($forloop as $item) {
                echo $item . ' '; 
            }
        ?>
    </div>
</body>
</html>