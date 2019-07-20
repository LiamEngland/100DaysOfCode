<!DOCTYPE html>
<html>
<head>
    <link rel='stylesheet' href='style.css'>
    <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Day 4</title>
</head>
<body>
    <div class='container-fluid'>
        <div class='row'>
            <div class='col-12'>
                <h1 class='text-center m-2'>Day 4 / 100</h1>
                <hr>
            </div>
            <div class='col-sm-12 col-md-6'>
                <h3 class='text-center'>Platform & Browser Identification</h3>
                <hr>
                    <h5 class='text-muted'>Using HTTP_USER_AGENT for identifying machine platform and browser.</h5>
                <?php
                    function getBrowser() {
                        $userAgent = $_SERVER['HTTP_USER_AGENT'];
                        $browserName = 'Unknown';
                        $platformName = 'Unknown';
                        $versionNumber = '';

                        // Gather Platform Name.
                        if (preg_match('/linux/i', $userAgent)) {
                            $platformName = 'Linux';
                        } else if (preg_match('/macintosh|mac os x/i', $userAgent)) {
                            $platformName = 'Mac';
                        } else if (preg_match('/windows|win32/i', $userAgent)) {
                            $platformName = 'Windows';
                        }

                        // Gather Browser Name.
                        if (preg_match('/MSIE/i', $userAgent) && !preg_match('/Opera/i', $userAgent)) {
                            $browserName = 'Internet Explorer';
                            $ub = 'MSIE';
                        } else if (preg_match('/Firefox/i', $userAgent)) {
                            $browserName = 'Firefox';
                            $ub = 'Firefox';
                        } else if (preg_match('/Chrome/i', $userAgent)) {
                            $browserName = 'Chrome';
                            $ub = 'Chrome';
                        } else if (preg_match('/Safari/i', $userAgent)) {
                            $browserName = 'Safari';
                            $ub = 'Safari';
                        } else if (preg_match('/Opera/i', $userAgent)) {
                            $browserName = 'Opera';
                            $ub = 'Opera';
                        } else if (preg_match('/Netscape/i', $userAgent)) { // Who uses this?
                            $browserName = 'Netscape';
                            $ub = 'Netscape';
                        }

                        // Gather Version Number.
                        $known = array('Version', $ub, 'other');
                        $pattern = '#(?<browser>' . join('|', $known) . ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';

                        if (!preg_match_all($pattern, $userAgent, $matches)) {
                            // No matches, continue.
                        }

                        $i = count($matches["browser"]);

                        if ($i != 1) {
                            // Checking if version before or after name.
                            if (stripos($userAgent, "Version") < stripos($userAgent, $ub)) {
                                $version = $matches['browser'][0];
                            } else {
                                $version = $matches['browser'][1];
                            }
                        } else {
                            $version = $matches['version'][0];
                        }

                        // Check if we have a number.
                        if ($version == null || $version == '') {
                            $version = '?';
                        }

                        return array(
                            'userAgent' => $userAgent,
                            'name' => $browserName,
                            'version' => $version,
                            'platform' => $platformName,
                            'pattern' => $pattern
                        );  
                    }

                    // Try now.
                    $ua = getBrowser();
                    $userBrowser = "Your browser is: " . $ua['name'] . ' Version: ' . $ua['version']
                    . ' on a ' . $ua['platform'] . ' machine reports: <br>' .$ua['userAgent'];

                    print_r($userBrowser);
                ?>
            </div>
            <div class='col-sm-12 col-md-6'>
                <h3 class='text-center'>Randomisation</h3>
                <hr>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>