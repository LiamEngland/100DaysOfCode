var c = document.getElementById('canvas1');
var ctx = c.getContext('2d');
ctx.moveTo(0, 0);
ctx.lineTo(200, 100);
ctx.stroke();

var d = document.getElementById('canvas2');
var dtx = d.getContext('2d');
dtx.beginPath();
dtx.arc(150, 100, 40, 0, 2 * Math.PI);
dtx.stroke();

var e = document.getElementById('canvas3');
var etx = e.getContext('2d');
etx.font = '30px Arial';
etx.fillText('This is a test', 10, 50);

var f = document.getElementById('canvas4');
var ftx = c.getContext('2d');
ftx.font = '30px Arial';
ftx.strokeText('Hello World', 10, 50);

var g = document.getElementById('canvas5');
var gtx = g.getContext("2d");

// Create gradient
var grd = gtx.createLinearGradient(0, 0, 200, 0);
grd.addColorStop(0, 'red');
grd.addColorStop(1, 'white');

// Fill with gradient
gtx.fillStyle = grd;
gtx.fillRect(10, 10, 280, 180);

var h = document.getElementById('canvas6');
var htx = h.getContext('2d');

var hrd = htx.createRadialGradient(75, 50, 5, 90, 60, 100);
hrd.addColorStop(0, 'red');
hrd.addColorStop(1, 'white');

htx.fillStyle = hrd;
htx.fillRect(10, 10, 280, 180);

// No image, just demo code.
var x = document.getElementById('test');
var xtx = c.getContext('2d');
var img = document.getElementById('scream');
xtx.drawImage(img, 10, 10);