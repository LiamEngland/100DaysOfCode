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
            <h1 class='text-center m-3'>AUDIO LIBRARY</h1>
        </div>
        <script>            
            function myFunction() {
                var filename = '';
                document.getElementById("fileSelected").innerHTML = '1 File Selected';
            }
        </script>
        <div class='col-12'>
            <form action="audio-upload.php" method="POST" enctype="multipart/form-data" class='mb-5'>
                <label class="customFileUpload">
                    <input type="file" name="songToUpload" id="songToUpload" onchange="myFunction(this.value)">
                    <i class="fas fa-upload"></i> Custom Upload
                </label>
                <span class='ml-2' id="fileSelected">No File Selected</span>
                <input type="submit" class='btn btn-outline-primary float-right'>
            </form>
        </div>
        <div class='col-12'>
            <table class='w-100'>
                <tr class='heading'>
                    <th>File Name</th>
                    <th class='text-center'>Song Length</th>
                    <th class='text-right'>Last Updated</th>
                </tr>
                <?php
                    if (isset($rows)) {
                        foreach ($rows as $track) {
                            echo '<tr  class="songList">';
                            echo '<td>' . $track['originalFileName'] . '</td>';
                            echo '<td class="text-center">' . $track['songLength'] . '</td>';
                            echo '<td class="text-right">' . $track['updatedTime'] . '</td>';
                            echo '<td><button class="float-right btn btn-sm btn-outline-danger rounded-0"><i class="fas fa-times"></i></button></td>';
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