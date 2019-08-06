<?php

include_once('config.php');
$title = 'Audio Library';
include_once('header.php');

function getSongs($result) {
    $rows = array();
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
    return $rows;
}

$ID = $_SESSION['id'];
$statement = "SELECT * FROM audiofiles WHERE user_id = ?";

if ($pre = $connection->prepare($statement)) {
    $id = $ID;
    $pre->bind_param('i', $id);
    $pre->execute();
    $result = $pre->get_result();
    $rows = getSongs($result);
}

$target_dir = "uploads/audio/";
?>

<div class='container'>
    <div class='row text-light'>
        <div class='col-12'>
            <h1 class='text-center m-3'>PLAYLISTS HERE</h1>
            <hr class='hrLight'>
        </div>
        <div class='col-12'>
            <form action="audio-upload.php" method="POST" enctype="multipart/form-data" class='mb-3'>
                <input type="file" name="songToUpload" id="songToUpload">
                <input type="submit" class='float-right'>
            </form>
            <hr class='hrLight'>
        </div>
        <div class='col-12'>
            <table class='w-100'>
                <tr>
                    <th>File Name</th>
                    <th>Song Length</th>
                    <th>Last Updated</th>
                </tr>
                <?php
                    if (isset($rows)) {
                        foreach ($rows as $track) {
                            echo '<tr>';
                            echo '<td>' . $track['originalFileName'] . '</td>';
                            echo '<td>' . '</td>';
                            echo '<td>' . $track['updatedTime'] . '</td>';
                            echo '</tr>';
                        }
                    }
                ?>
            </table>
        </div>
    </div>
</div>

<?php
    include_once('playfooter.php');
?>