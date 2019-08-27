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

<div class="modal fade" id="deleteConfirm" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content rounded-0">
            <div class="modal-body">
                <h5 class="modal-title text-center" id="deleteConfirmLabel">Delete Song?</h5>
            </div>
            <div class="modal-footer border-top-0">
                <button type="button" class="btn btn-secondary rounded-0 mr-auto" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger rounded-0">Delete</button>
            </div>
        </div>
    </div>
</div>

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
                    <i class="far fa-folder-open"></i> Choose Audio
                </label>
                <span class='ml-2' id="fileSelected">No File Selected</span>
                <button type="submit" class='btn btn-outline-primary float-right rounded-0'><i class="fas fa-upload"></i> Upload</button>
            </form>
        </div>
        <div class='col-12'>
            <div class='table-responsive'>
                <table class='table text-light'>
                    <tr class='heading'>
                        <th>File Name</th>
                        <th class='text-center'>Song Length</th>
                        <th class='text-center'>Last Updated</th>
                        <th class='text-center'>Options</th>

                    </tr>
                    <?php
                        if (isset($rows)) {
                            foreach ($rows as $track) {
                                echo '<tr class="songList align-middle">';
                                echo '<td>' . $track['originalFileName'] . '</td>';
                                echo '<td class="text-center">' . $track['songLength'] . '</td>';
                                echo '<td class="text-center">' . $track['updatedTime'] . '</td>';
                                echo '<td class="text-center p-1"><div class="btn-group p-0" role="group"><button class="btn btn-danger rounded-0" data-toggle="modal" data-target="#deleteConfirm" data-id="' . $track['id'] . '"><i class="fas fa-times fa-fw"></i></button><button class="btn btn-primary rounded-0"><i class="fas fa-pencil-alt fa-fw"></i></button></div></td>';
                                echo '</tr>';
                            }
                        }
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
    include_once('playfooter.php');
?>