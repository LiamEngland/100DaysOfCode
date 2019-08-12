var audioPlayer = document.getElementById("playFooter");
var isPlaying = false;

function togglePlay() {
if (isPlaying) {
    audioPlayer.pause()
} else {
    audioPlayer.play();
}
};
audioPlayer.onplaying = function() {
    isPlaying = true;
};
audioPlayer.onpause = function() {
    isPlaying = false;
};