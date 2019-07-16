<!DOCTYPE html>
<html>
<head>
    <title>Hello World</title>
</head>
<body>
    <?php echo 'Hello World'; ?>
    <?= 'Another markup tag.'; ?>#
    <br>
    <?php
        $variableTest = 'This';
        # This is a comment.
        // This is a comment line.
        /* 
            This is a comment block.
        */
        echo $variableTest . ' is a string Variable.<br>';

        $integer = 1;
        $double = 0.123;
        $boolean = true;
        $null = null;
        $string = 'Hello';
        $array[] = ['Item 1', 'Item 2'];

        class Object {
            public function __construct($test) {
                $this->test = $test;
            }

            public function displayTest() {
                echo 'This is a ' . $this->test;
            }
        }

        $test = new Object(' Test.');
        $test->displayTest();

        define("test", "test2");

        echo '<br>';

        $a = 15;
        $b = 10;

        echo 'Arithmit Operators.<br>';
        echo $a + $b . '<br>';
        echo $a - $b . '<br>';
        echo $a * $b . '<br>';
        echo $a / $b . '<br>';
        echo $a % $b . '<br>';
        echo $a++ . '<br>';
        echo $a-- . '<br>';

        echo 'Comparison Operators<br>';
        echo $a == $b ? 'true <br>' : 'false <br>';
        echo $a != $b ? 'true <br>' : 'false <br>';
        echo $a > $b ? 'true <br>' : 'false <br>';
        echo $a >= $b ? 'true <br>' : 'false <br>';
        echo $a <= $b ? 'true <br>' : 'false <br>';

    ?>
</body>
</html>