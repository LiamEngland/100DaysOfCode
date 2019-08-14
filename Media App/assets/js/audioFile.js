var audioPlayer = document.getElementById("playFooter");
var isPlaying = false;

function toggleMusic() {
    if (audioPlayer.paused) {
        audioPlayer.play(); 
        $('.pauseButton').show();
        $('.playButton').hide();
    } else {
        audioPlayer.pause(); 
        $('.playButton').show();
        $('.pauseButton').hide();
    }
}