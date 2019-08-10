<?php
include_once('config.php');
$title = 'Video Library';
include_once('header.php');

function getVideos($result) {
    $rows = array();
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
    return $rows;
}

$ID = $_SESSION['id'];
$statement = "SELECT * FROM videofiles WHERE user_id = ?";

if ($pre = $connection->prepare($statement)) {
    $id = $ID;
    $pre->bind_param('i', $id);
    $pre->execute();
    $result = $pre->get_result();
    $rows = getVideos($result);
}

$target_dir = "uploads/video/";

?>

<div class='container'>
    <div class='row text-light'>
        <div class='col-12'>
            <h1 class='text-center m-3'>VIDEO LIBRARY</h1>
        </div>
        <script>            
            function myFunction() {
                var filename = '';
                document.getElementById("fileSelected").innerHTML = '1 File Selected';
            }
        </script>
        <div class='col-12'>
            <form action="video-upload.php" method="POST" enctype="multipart/form-data" class='mb-5'>
                <label class="customFileUpload">
                    <input type="file" name="videoToUpload" id="videoToUpload" onchange="myFunction(this.value)">
                    <i class="far fa-folder-open"></i> Choose Video
                </label>
                <span class='ml-2' id="fileSelected">No File Selected</span>
                <button type="submit" class='btn btn-outline-primary float-right rounded-0'><i class="fas fa-upload"></i> Upload</button>
            </form>
        </div>
        <div class='col-12'>
            <table class='w-100'>
                <tr class='heading'>
                    <th>File Name</th>
                    <th class='text-center'>Video Length</th>
                    <th class='text-right'>Last Updated</th>
                </tr>
                <?php
                    if (isset($rows)) {
                        foreach ($rows as $track) {
                            echo '<tr  class="songList">';
                            echo '<td>' . $track['originalFileName'] . '</td>';
                            echo '<td class="text-center">' . $track['videoLength'] . '</td>';
                            echo '<td class="text-right">' . $track['updatedTime'] . '</td>';
                            echo '</tr>';
                        }
                    }
                ?>
            </table>
        </div>
    </div>
</div>

<?php
    include_once('footer.php');
?>