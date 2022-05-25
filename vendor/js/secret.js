var canvas;
var context;
var ctx;
var xaxis = 10;
var yaxis = 10;
var obstacle = [];
var relative;

window.onload = function () {
  canvas = document.getElementById("canvas");
  context = canvas.getContext("2d");
  ctx = canvas.getContext("2d");

  drawCanv();
};

var chad = {
  height: 50,
  width: 50,
  x: 100,
  y: 100,
};

var player = {
  height: 10,
  width: 10,
};

function drawCanv() {
  context.beginPath();
  context.fillStyle = "#ffffff";
  context.fillRect(0, 0, canvas.clientWidth, canvas.clientHeight);

  context.beginPath();
  context.fillStyle = "black";
  context.fillRect(xaxis, yaxis, player.width, player.height);

  var ndx =
    obstacle.push({
      x: chad.x,
      y: chad.y,
      width: chad.width,
      height: chad.height,
    }) - 1;
  ctx.beginPath();
  ctx.fillStyle = "pink";
  ctx.fillRect(
    obstacle[ndx].x,
    obstacle[ndx].y,
    obstacle[ndx].width,
    obstacle[ndx].height
  );

  document.getElementById("souradx").innerHTML = xaxis;
  document.getElementById("sourady").innerHTML = yaxis;
}

function hitObsta(player, array) {
  for (var value of array) {
    if (
      player.x + player.width > value.x &&
      player.x < value.x + value.width &&
      player.y + player.height > value.y &&
      player.y < value.y + value.height
    ) {
      return true;
    }
  }

  return false;
}

function onkeydown(e) {
  if (e.keyCode == 68 && xaxis + 10 < canvas.width) {
    xaxis++;
    document.getElementById("souradx").innerHTML = xaxis;

    var updatedCoords = Object.assign(
      {
        x: xaxis,
        y: yaxis,
      },
      player
    );
    if (hitObsta(updatedCoords, obstacle)) {
      xaxis--;
      alert("I am an alert box!");
    }
  } else if (e.keyCode == 65 && xaxis > 0) {
    xaxis--;
    document.getElementById("souradx").innerHTML = xaxis;
    var updatedCoords = Object.assign(
      {
        x: xaxis,
        y: yaxis,
      },
      player
    );
    if (hitObsta(updatedCoords, obstacle)) {
      xaxis++;
      alert("Narazili jste do boxu!");
    }
  } else if (e.keyCode == 87 && yaxis > 0) {
    yaxis--;
    document.getElementById("sourady").innerHTML = yaxis;
    var updatedCoords = Object.assign(
      {
        x: xaxis,
        y: yaxis,
      },
      player
    );
    if (hitObsta(updatedCoords, obstacle)) {
      yaxis++;
      alert("Narazili jste do boxu!");
    }
  } else if (e.keyCode == 83 && yaxis + 10 < canvas.height) {
    yaxis++;
    document.getElementById("sourady").innerHTML = yaxis;
    var updatedCoords = Object.assign(
      {
        x: xaxis,
        y: yaxis,
      },
      player
    );
    if (hitObsta(updatedCoords, obstacle)) {
      yaxis--;
      alert("Narazili jste do boxu!");
    }
  }
  drawCanv();
}

window.addEventListener("keydown", onkeydown);
