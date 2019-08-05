<?php
    include_once('config.php');
    $title = 'Audio Library';
?>

<?php
    include_once('header.php');
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
                    <th>Name</th>
                    <th>Artist</th>
                    <th>Song Length</th>
                    <th>Date Added</th>
                </tr>
                <tr>
                    <td>Used</td>
                    <td>Mistakes</td>
                    <td>4:13</td>
                    <td>04/08/2019</td>
                </tr>
                <tr>
                    <td>Gully</td>
                    <td>My Nu Leng</td>
                    <td>4:34</td>
                    <td>04/08/2019</td>
                </tr>
                <tr>
                    <td>Shapes</td>
                    <td>Mumbai Style</td>
                    <td>4:48</td>
                    <td>04/08/2019</td>
                </tr>
            </table>
        </div>
    </div>
</div>

<?php
    include_once('playfooter.php');
?>