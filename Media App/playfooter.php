<div class="push"></div>
</div>
<script src="assets/js/jquery-1.10.2.min.js"></script>

<?php
    $songList = array();
    if (isset($rows)) {
        foreach ($rows as $song) {
            $songList[$song['id']]['id'] = $song['id'];
            $songList[$song['id']]['path'] = 'uploads/audio/' . $song['actualFileName'];
            $songList[$song['id']]['fileName'] = $song['originalFileName'];
        }
    }

    $jsSongs = json_encode(array_values($songList));
?>

<footer class="footer text-center">
    <div class='container-fluid h-100'>
        <div class='row align-items-center h-100'>
            <div class='col-12'>
                <div id="seek-bar">
                    <div id="fill"></div>
                    <div id="handle"></div>
                </div>
            </div>
            <div class='col-sm-12 col-md-6'>
                <button id="pre" onclick="prevSong()"><img src="assets/img/Pre.png" height="90%" width="90%"/></button>
                <button id="play" onclick="playOrPauseSong()"><img src="assets/img/Play.png" height="90%" width="90%"/></button>
                <button id="next" onclick="nextSong()"><img src="assets/img/Next.png" height="90%" width="90%"/></button>
            </div>
            <div class='col-sm-12 col-md-6'>
                <span id='songTitle'></span>
            </div>
        </div>
    </div>
</footer>
<script type='text/javascript'>

    var songs = <?= $jsSongs ?>; // Initialisation of variables.
    var song = new Audio();
    console.log(songs[0]['id']);
    var currentSong = 0;
    var listLength = songs.length - 1;
    var fillBar = document.getElementById("fill");
    
    window.onload = pageLoad; // Calls player initialisation function.
    
    function pageLoad() { // Initialises the player when the page loads
        song.src = songs[currentSong]['path'];
        songTitle.textContent = songs[currentSong]['fileName'];
    }

    function playSong() {
        song.src = songs[currentSong]['path'];  //set the source of 0th song 
        songTitle.textContent = songs[currentSong]['fileName']; // set the title of song
        song.play();    // Plays loaded song.
    }

    function playOrPauseSong() {
        if (song.paused) {
            song.play();
            $("#play img").attr("src","assets/img/Pause.png");
        } else {
            song.pause();
            $("#play img").attr("src","assets/img/Play.png");
        }
    }

    song.addEventListener('timeupdate',function() { 
        var position = song.currentTime / song.duration;
        fillBar.style.width = position * 100 +'%';
    });
    

    function nextSong() {
        currentSong++;
        if (currentSong > listLength) { // Goes to start of array on going over array length.
            currentSong = 0;
        }
        playSong();
        $("#play img").attr("src","assets/img/Pause.png");
    }

    function prevSong() {
        currentSong--;
        if (currentSong < 0) { // Goes to end of array on going lower than index.
            currentSong = listLength; 
        }
        playSong();
        $("#play img").attr("src","assets/img/Pause.png");
    }
</script>
<script src='assets/js/audioFile.js'></script>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>