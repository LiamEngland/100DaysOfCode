<div class="push"></div>
</div>
<script src="assets/js/jquery-1.10.2.min.js"></script>

<?php
    $songList = array();
    if (isset($rows)) {
        foreach ($rows as $song) {
            array_push($songList, 'uploads/audio/' . $song['actualFileName']);
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
                <button id="pre" onclick="pre()"><img src="assets/img/Pre.png" height="90%" width="90%"/></button>
                <button id="play" onclick="playOrPauseSong()"><img src="assets/img/Pause.png" height="90%" width="90%"/></button>
                <button id="next" onclick="next()"><img src="assets/img/Next.png" height="90%" width="90%"/></button>
            </div>
            <div class='col-sm-12 col-md-6'>
                <span id='songTitle'></span>
            </div>
        </div>
    </div>
</footer>
<script type='text/javascript'>

    var songs = <?= $jsSongs ?>;
    console.log(songs);
    
    var song = new Audio();
    var currentSong = 0;    // it point to the current song
    
    window.onload = playSong;  // it will call the function playSong when window is load
    
    function playSong() {
        song.src = songs[currentSong];  //set the source of 0th song 
        
        songTitle.textContent = songs[currentSong]; // set the title of song
        
        song.play();    // play the song
    }


    
    song.addEventListener('timeupdate',function(){ 
        
        var position = song.currentTime / song.duration;
        
        fillBar.style.width = position * 100 +'%';
    });
    

    function next(){
        
        currentSong++;
        if(currentSong > 2){
            currentSong = 0;
        }
        playSong();
        $("#play img").attr("src","assets/img/Pause.png");
    }

    function pre(){
        
        currentSong--;
        if(currentSong < 0){
            currentSong = 2;
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