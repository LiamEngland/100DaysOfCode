<div class="push"></div>
</div>

<audio id='playFooter' src='uploads/audio/1.mp3'>

</audio>

<footer class="footer text-center">
    <div class='container-fluid h-100'>
        <div class='row align-items-center h-100'>
            <div class='col-12'>
                <span id="seek-obj-container">
                    <progress class='w-100' id="seek-obj" value="0" max="1"></progress>
                </span>
            </div>
            <div class='col-sm-12 col-md-6'>
                <span class='backButton' onClick="prevSong()"><i class="fas fa-backward"></i></span>
                <span class='playButton' onClick="toggleMusic()"><i class="far fa-play-circle"></i></span>
                <span class='pauseButton' onClick="toggleMusic()"><i class="far fa-pause-circle"></i></span>
                <span class='forwardButton' onClick="nextSong()"><i class="fas fa-forward"></i></span>
            </div>
            <div class='col-sm-12 col-md-6'>
                <span class='timing float-left'></span>
                <span>Song Name Here</span>
            </div>
        </div>
    </div>
</footer>
<script src='assets/js/audioFile.js'></script>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>